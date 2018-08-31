<?php

namespace App\Http\Controllers;
use Illuminate\http\Request;
use Illuminate\Validation\ValidationException;
use App\user;
class UserController extends Controller
{
  public function register(Request $request)
  {
$rules = [
'username' => 'required',
'email' => 'required',
'password' => 'required',
];

$CustomMessages = [
'required' => 'please fill attribute:attribute'
];

$this->validate($request, $rules, $CustomMessages);

try 
{
    $hasher = app()->make('hash');
    $username = $request->input('username');
    $email = $request->input('email');
    $password = $hasher->make($request->input('password'));

    $save = user::create([
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'api_token' => ''
         ]);

    $res['status'] = true;
    $res['message'] = 'registration success';
    return response($res,200);
}

catch(\illuminate\database\queryexception $ex) {
    $res['status'] = false;
    $res['message'] = $ex->getMessage();
    return response($res, 500);
}
}
public function get_user()
{
    $user = user::all();
    if($user){
$res['status']= true;
$res['message'] = $user;
return response($res);
    }
else
{
    $res['status'] = false;
    $res['message'] = 'cannot find user';
return response($res);
}

}

}  
  

