<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use App\Models\Notice;
use DataTables;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dataTable()
    {

        $data = Notice::leftJoin('eink_tags','eink_tags.id','=','notice.tag_id')->select('notice.*','eink_tags.product_name as tag_name')->limit(3)->get();
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //current user

        $user = $request->user();

        //current server status
        $all_notices = Notice::select('serverity')->get();
        $all_notices = $all_notices->map(function ($item, $key) {
            return $item->serverity;
        });
        $all_notices = $all_notices->toArray();

        $cur_sys_status = 0;

        if(in_array(1, $all_notices)) {
            $cur_sys_status = 1;
        }
        else if(in_array(2, $all_notices)) {
            $cur_sys_status = 2;
        }
        //tag total count
        $tag_total_cnt = Tag::all()->count();
        
        //latest added tag
        $la_tag = Tag::orderBy('created_at', 'desc')->get()->first();
        if(empty($la_tag))
            $la_tag = array('product_name'=>'','unit_quantity'=>'','unit_of_measurement'=>'','breakdown_price'=>'','breakdown_divisor'=>'','breakdown_quantity'=>'','breakdown_unit'=>'','barcode_data'=>'','product_price'=>'');
        //lastest updated tag
        $lu_tag = Tag::orderBy('updated_at', 'desc')->get()->first();
        if(empty($lu_tag))
            $lu_tag = array('product_name'=>'','unit_quantity'=>'','unit_of_measurement'=>'','breakdown_price'=>'','breakdown_divisor'=>'','breakdown_quantity'=>'','breakdown_unit'=>'','barcode_data'=>'','product_price'=>'');

        return view('home', ['cur_sys_status' => $cur_sys_status, 'tagcount' => $tag_total_cnt, 'user' => $user, 'la_tag' => $la_tag, 'lu_tag' => $lu_tag]);
    }
}
