<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Models\Verify;
use App\Models\LoginInfo;
use Session;
use Cookie;
use Hash;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'username'      => 'required|string|max:255',
                'password'      => 'required|max:255'
            ]);

            if($validator->fails()){
                return Response()->json(['errors'=>$validator->errors()->all()]);
            }

            $admin = Admin::select('id','username','password','verify','status')->where('username',$request->username)->get()->first();

            if(isset($admin)){
                if(Hash::check($request->password,$admin->password)){
                    if($admin->verify == 1){
                        if($admin->status == 1){
                            Cookie::queue(Cookie::make('client',$admin->id,time()+31104000));
                            return Response()->json(['success'=>'You are successfully logged in. Please wait! you are automatically redirect dashboard.']);
                        }else{
                            return Response()->json(['error'=>'You are suspended. Please contact your administrator']);
                        }
                    }else{
                        return Response()->json(['error'=>'You are not verified user.']);
                    }
                }else{
                    return Response()->json(['error'=>'Username or Password not match.']);
                }
            }else{
                return Response()->json(['error'=>'Username or Password not match.']);
            }
            
        }else{
            return view('backend.auth.login');
        }
        
    }

    protected function AdminHasData($columnName,$data)
    {
        return Admin::select($columnName)->where($columnName,$data)->get()->first();
    }

    protected function admin_id()
    {
        return Cookie::get('client') ?? Session::get('admin_id');
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }


    public function setup(Request $request)
    {
        if(count(Admin::select('id')->get()) >= 1){
            return abort(404);
        }
        if($request->ajax()){
            $validator = Validator::make($request->all(),[
                'username'      => 'required|string|max:255',
                'email'         => 'required|string|email|max:255',
                'password'      => 'required'
            ]);

            if($validator->fails()){
                return Response()->json(['failed'=>$validator->errors()->all()]);
            }

            
            if(!$this->AdminHasData('username',$request->username)){
                if(!$this->AdminHasData('email',$request->email)){
                    $admin = new Admin();

                    $admin->email       = $request->email;
                    $admin->username    = $request->username;
                    $admin->password    = Hash::make($request->password);

                    if($admin->save()){
                        // $admin_id = $admin->id;
                        // Cookie::queue(Cookie::make('client',$admin_id,time()+31104000));
                        // $location = Location::get($this->getIp());
                        // $agent = new Agent();
                        // $login_info = new LoginInfo();

                        // $login_info->admin_id       = $this->admin_id();
                        // $login_info->country        = $location ? $location->countryName : null;
                        // $login_info->city           = $location ? $location->cityName : null;
                        // $login_info->browser        = $agent->browser();
                        // $login_info->platform       = $agent->platform() . ' ' . $agent->version($agent->platform());
                        // $login_info->last_login     = date('d m Y');
                        // if($login_info->save()){
                        //     return Response()->json(['success'=>'Your information submited. Please Verify your account.']);
                        // }else{
                        //     return Response()->json(['error'=>'Something went wrong. Please try again.']);
                        // }

                        return Response()->json(['success'=>'Your information submited. Please Verify your account.']);





                        

                        // $token = hash('sha512',uniqid(),false);
                        // $verify = new Verify();
                        // $verify->admin_id   = $admin_id;
                        // $verify->token      = $token;
                        // $verify->expire     = time();



                    }else{
                        return Response()->json(['error'=>'Something went wrong. Please try again.']);
                    }
                }else{
                    return Response()->json(['error'=>'Email allready exist.']);
                }
            }else{
                return response()->json(['error'=>'Username allready exist.']);
            }
        }else{
            return view('backend.auth.setup');
        }

        
    }
}
