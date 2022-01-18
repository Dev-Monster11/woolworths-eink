<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

	private function ProcessNMAP()
	{
		// nmap
		//declare(strict_types=1);
		//@mkdir("errors"); // create the 'errors' directory
		//@touch("errors/errors.txt"); // nmap errors will go to this error file

		// $dataDirectory = __DIR__ . "\\errors\\";
		//$outFile = sys_get_temp_dir();
		$found = false;

		// the parameter 192.168.1.1/24 translates to start at IP address 192.168.1.1 and
		// work right through all IP addresses up to and including 192.168.1.255
		$scan = "192.168.1.2/24"; // scan url
		
		$dataDirectory = `\\errors\\`;
        $outFile = public_path("\\errors\\nmap_out.xml");
		
		// $outFile = __DIR__ . "\\errors\\nmap_out.xml";
		
		// specify process
		$descriptors = array(
			0 => array('pipe', 'r'), // stdin
			1 => array('pipe', 'w'), // stdout
			2 => array("file", "C:\\Webs\\woolworths-eink\\MASTER-SEVER\\public\\errors\\errors.txt", "a") // stderr is a file to write to
		);

		// attempt to scan 4 times
		for($i=0; $i<4; $i++)
		{
			$debug = 0;
			$process = proc_open("nmap -sn -oX \"$outFile\" $scan", $descriptors, $pipes, "C:\\Program Files (x86)\\NMap"); // handle nmap process
			proc_close($process); // close the process
			
			$GLOBALS['$data'] = json_decode(json_encode(simplexml_load_file($outFile)), true); // parse nmap output
			if($debug >= 1) echo 'i = ' . $i . '<br />'; // debugging
			
			$temp = $GLOBALS['$data'];
			
			foreach($temp["host"] as $host)
			{
				if(!empty(getMACAddress($host)["vendor"]))
				{
					if(getMACAddress($host)["vendor"] === "Espressif")
					{
						if($debug >= 1) echo 'Found'; // debugging
						$found = true; // yep, we got one
						
						break;
					}
				}
			}
			
			if($found == true) break; // stop the loop
		}
		
		// handle hosts for print (debugging)
		/*foreach ($data["host"] as $host)
		{
			echo "IP Address: " . $host["address"]["@attributes"]["addr"] . "<br>";
			echo "IP Address: " . getIPAddress($host) . "<br>";
			
			echo sprintf("<pre>%s</pre>", json_encode($host, JSON_PRETTY_PRINT)) . PHP_EOL . "<hr>";
		}*/
		
		//@unlink($outFile); // remove the nmap output
	}


    public function index(){

        return view('add', ['status' => 'searching']);
    }

    
}
