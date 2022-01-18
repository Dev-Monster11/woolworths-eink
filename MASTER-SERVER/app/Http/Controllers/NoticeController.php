<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

use App\Models\Settings;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
		$systemSettings = Settings::get()->first();
        $ip_from 	= $systemSettings['ip_from'];
        $ip_to 		= $systemSettings['ip_to'];
        if($ip_from == '' || $ip_to == ''){
        	Notice::updateOrInsert(['tag_id'=>'-100'],['tag_id'=>'-100','serverity'=>2,'error'=>'No IP Address Range has been defined in the Settings.','discover_date'=>date('Y-m-d H:m:s')]);
        }
        return view('notice');
    }
    public function dataTable()
    {
        $data = Notice::leftJoin('eink_tags','eink_tags.id','=','notice.tag_id')->select('notice.*','eink_tags.product_name as tag_name')->get();
        // $data = Notice::query();
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('serverity',function($model){
                return $model->serverity;
            })
            ->addColumn('time', function($model){
                $ntime =  $model->discover_date;
                $ntime = date("H:i:s A d/M/Y", strtotime($ntime));
                return $ntime;
            })
            // ->removeColumn('tag_id')
            ->addColumn('action', function($model){
                return view('layouts._datatable_notice_action', [
                    'url_destroy'   => route('notice.destroy', $model->id)
                ]);
            })            
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * 
     * 
    */
    public function add_notice(Request $request)
    {
        //echo $request['notice_add_data'];
        // print_r($request->all());
        //   exit;
        if(isset($request['notice_add_data'])) {
            $newData = array(
                'tag_id'        => $request['tag_id'],
                'serverity'     => $request['serverity'],
                'error_txt'     => $request['error_txt'],
                'show'          => $request['show_flag'],
            );

            Notice::insert($newData);
            return view('notice');
        }
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Notice::findOrFail($id);
        $model->delete();

    }
    /**
     * Remove all resource from storage.
     */
    public function clearall()
    {
        $model = Notice::truncate();

    }
}
