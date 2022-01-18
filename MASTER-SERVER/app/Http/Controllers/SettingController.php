<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Notice;
use App\Models\RepeatOnLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = $request->user();
        $systemSettings = Settings::where('id', 1)->get()->first();
        $data = array();
        if(!empty($systemSettings)){
            $data = array(
                'current_user'      => $user->email,
                'server_address'    => $systemSettings['server_address'],
                'ip_from'           => $systemSettings['ip_from'],
                'ip_to'             => $systemSettings['ip_to'],
                //'cidr_range'        => $systemSettings['cidr_range'],
                'store_location'    => $systemSettings['store_location'],
                'system_id'         => $systemSettings['system_id'],
                'system_ver'        => $systemSettings['system_ver'],
            );
        }
        else {
            $data = array(
                'current_user'      => $user->email,
                'server_address'    => '',
                'ip_from'           => '',
                'ip_to'             => '',
                //'cidr_range'        => '',
                'store_location'    => '',
                'system_id'         => '',
                'system_ver'        => '',
            );
        }

        return view('setting', compact('data'));
    }

    public function saveSettings(Request $request){

        $data = $request->all(); 
        $result = array();

        try {
            $check = User::where([['email', '=', $data['cur_user']], ['name', '=', 'Administrator']])->get()->first();  

            if(!empty($check)){

                //non-repeat when login
                if($data['address'] != null && $data['system_id'] != null ) {
                    RepeatOnLogin::where('id',1)
                        ->update(array('id' => 1, 'flag' => 0, 'updated_at' => Carbon::now()->timezone('AEST')->toDateTimeString()));
                }

                Settings::where('id', 1)
                        ->update(array(
                            'store_location'    => $data['address'],
                            'server_address'    => $data['ms_ip'],
                            'ip_to'             => $data['ip_to'],
                            'ip_from'           => $data['ip_from'],
							//'cidr_range'        => $data['cidr_range'],
                            'system_id'         => $data['system_id'],
                            'system_ver'        => $data['system_ver'],
                            'updated_at'        => Carbon::now()->timezone('AEST')->toDateTimeString(),
                        ));

                $result = [
                    'status' => 'success',
                    'message' => 'Settings Successfully Updated'
                ];
            }
            else {
                $result = [
                    'status' => 'error',
                    'message' => 'Only the Administrator can change settings.'
                ];
            }
        } 
        catch (\Illuminate\Database\QueryException $e) {
           return   $result = [
                        'status' => 'error',
                        'message' => 'Update Failed'
                    ]; 
        }

        return($result);
    }
}
