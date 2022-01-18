<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Weekschedule;
use App\Models\Notice;
use App\Models\TaskName;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return: get all rows and return formated array that group and order by weekday
    */
    private function getTableData(){
        $alldata = Weekschedule::leftJoin('task_name','task_name.id','=','week_schedule.itaskid')->select('week_schedule.*','task_name.name')->orderBy('strweekday','asc')->orderBy('ihalfday','asc')->orderBy('ihour','asc')->orderBy('iminute','asc')->get();
        $color_arr = array('#007bff', '#28a745', '#fd7e14', '#6c757d', '#dc3545', '#ffc107');
        $weekdayname = array('Mon'=>'Monday','Tue'=>'Tuesday','Wed'=>'Wednesday','Thu'=>'Thusday','Fri'=>'Friday','Sat'=>'Saturday','Sun'=>'Sunday');
        $weekday = array('Mon'=>array(),'Tue'=>array(),'Wed'=>array(),'Thu'=>array(),'Fri'=>array(),'Sat'=>array(),'Sun'=>array());
        $corordata = array();
        foreach ($alldata as $key => $value) {
            $weekday[$value['strweekday']][$value['id']] = $value;
            $weekday[$value['strweekday']][$value['id']]['strtask'] = $value['name'];
            $weekday[$value['strweekday']][$value['id']]['strweek'] = $weekdayname[$value['strweekday']];
            $weekday[$value['strweekday']][$value['id']]['strcolor'] = $color_arr[$value['strcolor']];
            $weekday[$value['strweekday']][$value['id']]['strhalf'] = $value['ihalfday'] == 0?'AM':'PM';
        }
        array_merge(array_flip(array('Mon','Tue','Wed','Thu','Fri','Sat','Sun')), $weekday);
        return $weekday;
    }
    /**
     * @purpose: when access the schedule page display the initial page
    */
    public function index(){
        $schedule_arr = TaskName::get();
        $weekdayname = array('Mon'=>'Monday','Tue'=>'Tuesday','Wed'=>'Wednesday','Thu'=>'Thusday','Fri'=>'Friday','Sat'=>'Saturday','Sun'=>'Sunday');
        return view('schedule')->with(['weekdata'=>$this->getTableData(),'schedule_arr'=>$schedule_arr,'week_arr'=>$weekdayname]);
    }
    /**
     * @purpose: return one row the id is equal with request
    */
    public function getdata(Request $request){
        $param = $request->all();
        $data = Weekschedule::where('id',$param['id'])->get();
        exit(json_encode($data));
    }
    /**
     * @purpose: save data
    */
    public function save(Request $request){
        $param = $request->all();
        $id = ($param['id']=='new')?NULL:$param['id'];
        if($param['id'] == 'new'){
            if(Weekschedule::where('strweekday',$param['strweekday'])->where('ihour',$param['ihour'])->where('iminute',$param['iminute'])->where('ihalfday',$param['ihalfday'])->exists())
                exit('exist');
            if(Weekschedule::where('strweekday',$param['strweekday'])->count() == 4)
                exit('over4');            
        }
        //if there is same task the color is selected that color, or not select the first color in color index that not in database
        $prev = Weekschedule::where('itaskid',$param['itaskid'])->where('ihour',$param['ihour'])->where('iminute',$param['iminute'])->where('ihalfday',$param['ihalfday'])->first();
        if($prev)
            $prevcolor = $prev->strcolor;
        else{
            $prev = Weekschedule::distinct('itaskid,ihour,iminute,ihalfday')->whereNotIn('id',array($param['id']))->get();
            $num_arr = array();
            foreach($prev as $value)
                array_push($num_arr,$value['strcolor']);
            for ($i = 0; $i < 6; $i++) { 
                if(!in_array($i,$num_arr)){
                    $prevcolor = $i;
                    break;
                }
            }            
        }
        //-------insert or update data
        try {
            if($param['itaskid'] == 3){
                if($param['command_type'] == 0){
                    $descriptors = array(
                        0 => array('pipe', 'r'), // stdin
                        1 => array('pipe', 'w'), // stdout
                        2 => array("file", public_path("\\errors\\error.txt"), "a") // stderr is a file to write to
                    );
                    $process = proc_open($param['strcommand'], $descriptors, $pipes); // handle nmap process
                    proc_close($process); // close the process
                }else{
                    $output=null;
                    $retval=null;
                    exec($param['strcommand'], $output, $retval);
                }
            }
            $data = array('itaskid'=>$param['itaskid'],'strweekday'=>$param['strweekday'],'ihour'=>$param['ihour'],'iminute'=>$param['iminute'],'ihalfday'=>$param['ihalfday'],'strcolor'=>$prevcolor,'command_type'=>$param['command_type'],'strcommand'=>$param['strcommand']);
            if($param['id'] == 'new'){
                $id = Weekschedule::insertGetId($data);
                
                // //adding new notice
                // $notice_data = array(
                //     'id'        => null,
                //     'serverity' => 0,
                //     'error'     => 'New Schedule Added!',
                //     'show'      => 1
                // )
                // $tse = Notice::insertGetId($notice_data);

            }else{
                Weekschedule::updateOrInsert(
                    ['id'=>$id],
                    $data
                );
            }
            $data = $this->getTableData();
            $data['id'] = $id;
            $data = json_encode($data);
            exit($data);
        } catch (Exception $e) {
            exit('failed');
        }
    }
    /**
     * @purpose: delete data by id
    */
    public function delete(Request $request){
        $param = $request->all();
        try {
            Weekschedule::where('id',$param['id'])->delete();
            $data = json_encode($this->getTableData());
            exit($data);
        } catch (Exception $e) {
            exit('failed');
        }
    }
}
