<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DataTables;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\User;
use App\Models\Settings;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    private function ping($ip_addr)
	{
		$result = shell_exec("ping $ip_addr");

		/*if($debug >= 1)
		{
			echo $result;
			echo '<br />';
			echo '<br />';
		}*/
		return $result;
		if (strpos($result, 'Request timed out') !== false) return false; // failed
		else return true; // success
	}
	private function getIPAddress(array $data) : string
	{
		$ip = "";
		$data = $data["address"];
		
		if (isset($data["@attributes"]))
		{
			if ($data["@attributes"]["addrtype"] === "ipv4")
			{
				$ip = $data["@attributes"]["addr"];
			}
		}
		else
		{
			foreach ($data as $address)
			{
				$attr = $address["@attributes"];
				
				if ($attr["addrtype"] === "ipv4")
				{
					$ip .= $attr["addr"] . " / ";
				}
			}
			
			$ip = substr($ip, 0, -3);
		}
		
		return $ip;
	}

	private function getMACAddress(array $data) : array
	{
		$mac = [];
		
		$data = array_values(
			array_filter($data["address"], function (array $address): bool
			{
				return isset($address["@attributes"]) && $address["@attributes"]["addrtype"] === "mac";
			})
		);
		
		if (isset($data[0]))
		{
			$mac = $data[0]["@attributes"];
		}
		
		return $mac;
	}

    public function search(Request $request)
    {
        /* $user = $request->user();
        // $systemSettings = User::where('email', $user->email)->get()->first();
		// if($systemSettings['name'] != 'Administrator'){
        // 	$data = array(
        // 		'msg' => 'You have not permission.'
    	// 	);
			
        	return view('findresult')->with('search_data', $data);
		}*/
		
		$systemSettings = Settings::get()->first();
        $ip_from 	= $systemSettings['ip_from'];
        $ip_to 		= $systemSettings['ip_to'];

        //getting final ip address
        $exploded = explode('.', $ip_to);
        $to = end($exploded);

		$tags = array();
		// $scan = "192.168.1.2/24"; // scan url
		$scan = $ip_from."-".$to;// scan url
        $outFile = public_path("\\NMAP\\nmap_out.xml");

        if($ip_from == '' || $ip_to == ''){
        	$data = array(
        		'msg' => 'ERROR: No IP Address Range has been defined in the Settings.',
				'msg2' => 'Please go to the Settings and define a valid range.'
    		);

        	return view('findresult')->with('search_data', $data);
        }

		// $outFile = __DIR__ . "\\errors\\nmap_out.xml";
		
		// specify process
		$descriptors = array(
			0 => array('pipe', 'r'), // stdin
			1 => array('pipe', 'w'), // stdout
			2 => array("file", public_path("\\errors\\error.txt"), "a") // stderr is a file to write to
		);

		for($i=0; $i<4; $i++)
		{
			$process = proc_open("nmap -sn -oX \"$outFile\" $scan", $descriptors, $pipes, "C:\\Program Files (x86)\\NMap"); // handle nmap process
			proc_close($process); // close the process
			
			$data = json_decode(json_encode(simplexml_load_file($outFile)), true); // parse nmap output
			// return response()->json(['a' => $data]);
			// $count = 0;
			foreach($data["host"] as $host)
			{
				if(!empty($this->getMACAddress($host)["vendor"]))
				{
					if($this->getMACAddress($host)["vendor"] === "Espressif")
					// if($this->getMACAddress($host)["vendor"] === "Dell")
					{
						// $count++;
						$ip_address = $this->getIPAddress($host, "ipv4");
						$mac_address = $this->getMACAddress($host)["addr"];
						$c = Tag::where('mac_address', $mac_address)->count();
						if (intval($c) > 0){
							$tag = Tag::where('mac_address', $mac_address)->first();
							array_push($tags, array('vendor' => 'Espressif', 'ip_address' => $ip_address, 'mac_address' => $mac_address, 'id' => $tag->ID,'value' => json_encode($tag)));
						}
						else{
							array_push($tags, array('vendor' => 'Espressif', 'ip_address' => $ip_address, 'mac_address' => $mac_address, 'id' => 0, 'value' => ''));
						}
						
						// array_push($tags, ['no' => $count, 'ip_address' => $this->getIPAddress($host, "ipv4"), 'mac_address' => $this->getMACAddress($host)["addr"], 'vendor' => "Espressif"]);
						// array_push($tags, $this->getIPAddress($host));
						// echo $host['address']."\n";			
					}
				}
			}
			// compact()
			// return var_dump($tags);
			// return view('a')->with('tags', $tags);
			return view('findresult')->with('tags', $tags);
			// return view('a')->with('tags', $tags);
			// return response()->json(['a' => $tags]);
			// $GLOBALS['data'] = $data;
		}
		
		// return view('findresult', ['tags' => preg_replace("/&#?[a-z0-9]+;/i",'',json_encode($tags))]);
		
		
		// return response()->json(['tags' => $tags]);
		// $token = strtok($output, '.');
		// while($token !== false){
		// 	echo $token."\n\n\n";
		// 	$token=strtok('.');
		// }
    }

	public function detail(Request $request, $id, $ip, $mac){
		
		// $id = $request->input('id');
		if ($id == 0){
			$tag = new Tag;

			// $tag->ip_address = $request->input('ip_address');
			// $tag->mac_address = $request->input('mac_address');

			$tag->ip_address = $ip;
			$tag->mac_address = $mac;
			$tag->save();
		}else{
			$tag = Tag::where('ID', $id)->first();
		}
		// return json_encode($tag);
		return view('detail_tag', compact('tag'));
		// ->with('tag', $tag);
	}


	// public function checkConnection($id){
	// 	if ($this->ping($tag->ip_address)){
	// 		return Redirect::route('tag.detail', ['id' => $tag->ID, 'ip_address' => $tag->ip_address, 'mac_address' => $tag->mac_address]);
	// 	}
	// }
    public function dataTable()
    {
        $data = Tag::query();
        
        return Datatables::of($data)
            ->addIndexColumn()

            // ->addColumn('action', function($row){
            //     $actionBtn = '<div style="width:100px"><a href="/tag/edit/'. $row->ID .'" class="edit btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a><a href="/tag/destroy/'.$row->ID.'" class="delete btn btn-success btn-sm"><i class="fas fa-trash"></i></a></div>';
            //     return $actionBtn;
            // })
            ->addColumn('action', function($model){
                return view('layouts._datatable_action', [
                    'model'         => $model,
                    // 'url_edit'      => route('tag.edit', $model->ID),
                    'url_edit'      => 'http://' . $model->ip_address,
					// 'url_edit'      => route('tag.checkConnection', $model->ID),
                    'url_destroy'   => route('tag.destroy', $model->ID)
                ]);
            })            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index(Request $request)
    {
        return view('tag');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // print_r($request->all());exit;
        if(isset($request['product_name'])) {
	        $tagData = array(
	            'product_name'      	=> $request['product_name'],
	            'unit_quantity'     	=> $request['product_weight'],
	            'unit_of_measurement'   => $request['product_unit'],
	            'product_price'   		=> "$".$request['product_price'].'.'.$request['product_price_decimal'],
	            'breakdown_price'    	=> "$".$request['product_breakdown_price'].'.'.$request['product_breakdown_price_decimal'],
	            'breakdown_divisor'     => $request['product_breakdown_divisor'],
	            'breakdown_quantity'  	=> $request['product_breakdown_weight'],
	            'breakdown_unit'  		=> $request['product_breakdown_unit'],
	            'barcode_data'  		=> $request['barcode_data'],
	            'sub_barcode_id'  		=> $request['sub_barcode_id'],
	            'qr_code_data'  		=> $request['qr_code_data'],	
	            'sale_mode'  			=> $request['sale']=='on'?'true':'false',	
	            'product_sale_price'  	=> $request['product_sale_price'],
	            'half_price_mode'  		=> $request['half']=='on'?'true':'false',

	            'ip_address'      		=> $request['ip_address'],	
	            'mac_address'      		=> $request['mac_address'],	
	            'created_at' 			=> Carbon::now()
	        );
			Tag::updateOrInsert(['mac_address'=>$request['mac_address']],$tagData);

			// Tag::insert($tagData);
			return Redirect::to('/tag');
	    }

   }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$tag = Tag::where('id', $request->input('id'))->first();
		$tag->product_name = $request->input('product_name');
		$tag->unit_quantity = $request->input('unit_quantity');
		$tag->unit_of_measurement = $request->input('unit_of_measurement');
		$tag->breakdown_unit = $request->input('breakdown_unit');
		$tag->breakdown_quantity = $request->input('breakdown_quantity');
		$tag->breakdown_divisor = $request->input('breakdown_divisor');
		$tag->sale_mode = $request->input('sale_mode');
		$tag->save();
        return response()->json(['a' => $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $model = Tag::findOrFail($id);
        $model->delete();

    }
}
