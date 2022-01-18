<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Settings;
use App\Models\Notice;
use App\Models\ErrorList;
use App\Models\ErrorType;
use App\Models\RepeatOnLogin;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
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
                $errorList = ErrorList::where('user', $user->email)->get()->first();

                $errorTypeName = array();
                
                if(!empty($errorList)){

                    // error kind name
                    $errorTypeName = ErrorType::where('id', $errorList['err_type_id'])->get()->first();

                    //update error list
                    ErrorList::where('user', $user->email)->update(['account' => 1]);

                    if(!empty($errorTypeName)) {
                        $notice['error'] = $errorTypeName['description'];
                    }
                }
                else {
                    $eldata = array(
                        'tag_id'           => null,
                        'account'          => 0,
                        'err_type_id'      => $occur_err_id,
                        'user'             => $user->email,
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
        $now = Carbon::now()->timezone('AEST')->toDateTimeString();
        $notice = array(
            'tag_id'            => null,
            'serverity'         => 0,
            'error'             => 'The user "'.$user->email.'" logged into system',
            'show'              => 0,
            'discover_date'     => $now,
        );
        Notice::insert($notice);
        return redirect('/home');
    }
}