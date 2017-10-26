<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //

    protected $redirectTo = '/home';

    protected function validator($data)
    {
        return Validator::make($data,
            [
                'username'=>'required|string',
                'password'=>'required|string',
               // 'veritycode'=>'required|string'
            ]);
    }

    public function username()
    {
        return 'username';
    }
    public function rules()
    {

    }

    public function index()
    {
        return view('Auth/index');
    }

    public function login(Request $request)
    {
           Validator::make($request->all(),
            [
                'username'=>'required|string|min:5|max:20',
                'password'=>'required|string|min:5',
                // 'veritycode'=>'required|string'
            ])->validate();
    }

}
