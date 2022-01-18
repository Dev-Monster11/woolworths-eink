<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Settings;
use App\Models\Notice;
use App\Models\ErrorList;
use App\Models\ErrorType;
use App\Models\RepeatOnLogin;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd('here');
        $systemSettings = Settings::where('id', 1)->get()->first();
        $repeatFlag = RepeatOnLogin::where('id',1)->get()->first();

        if($repeatFlag['flag'] == 1) {

            if($systemSettings['store_location'] == null || $systemSettings['system_id'] == null) {  

                //serverity of notice
                $occur_err_id = 2;

                $notice = array(
                    'tag_id'            => null,
                    'serverity'         => $occur_err_id,
                    'error'             => "The System Identification is required in order to use this software. Please contact your system Administrator immediately.",
                    'show'              => 0,
                    'discover_date'     => Carbon::now()->timezone('AEST')->toDateTimeString(),
                );

                // exist error?
                $errorList = ErrorList::where('user', $data['email'])->get()->first();

                $errorTypeName = array();
                
                if(!empty($errorList)){

                    // error kind name
                    $errorTypeName = ErrorType::where('id', $errorList['err_type_id'])->get()->first();

                    //update error list
                    ErrorList::where('user', $data['email'])->update(['account' => 1]);

                    if(!empty($errorTypeName)) {
                        $notice['error'] = $errorTypeName['description'];
                    }
                }
                else {
                    $eldata = array(
                        'tag_id'           => null,
                        'account'          => 0,
                        'err_type_id'      => $occur_err_id,
                        'user'             => $data['email'],
                        'updated_at'       => Carbon::now()->timezone('AEST')->toDateTimeString()
                    );

                    ErrorList::insert($eldata);
                }
            }

            //adding notice
            if(!empty($notice)){

                $alreay_exist = Notice::where([['serverity', '=', $notice['serverity']], ['error', '=', $notice['error']]])->get()->first();

                if(empty($alreay_exist)){
                    Notice::insert($notice);
                }
            }
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
