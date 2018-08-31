<?php

namespace App\Http\Controllers;
use Illuminate\Http\request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
   public function login(Request $request)
   {
    $rules = [
        'email' => 'required',
        'password' => 'required'
        ];
$CustomMessages = [
'required' =>':attribute'
    ];
$this->validate($request, $rules, $CustomMessages);
$email = $request->input('email');
try
{
    $login = User::where ('email', $email) ->first();
    if($login)
{
    if($login->count() > 0)
    {
        if(Hash::check($request->input('password'), $login->password)){
            try{
                $api_token = sha1($login->id_user.time());
                $create_token = user::where('id', $login->id)->update(['api_token' => $api_token]);
                $res['status'] = true;
                $res['message'] = 'success login';
                $res['data'] = $login;
                $res['api_token']= $api_token;
                return response($res, 200);
            }
            catch (\Illuminate\database\QueryException $ex){
                $res['status'] = false;
                $res['message'] = $ex->getMessage();
                return response($res,500);
            }
        }
        else
        {
            $res['status'] = false;
            $res['message'] = 'Username / email / password not found';
            return response($res, 401);
        }
    } 
    else
    {
        $res['status'] = false;
        $res['message'] = 'Username / email / Password not found';
         return response($res, 401);
    }
        }
        else{
            $res['status'] = false;
            $res['message'] = 'Username / email / password not found';
            return response($res,401);

        }
    }

catch (\Illuminate\database\QueryException $ex)
{
    $res['status'] = false;
    $res['message'] = $ex->getMessage();
    return response($res,500);
}
 }
}
