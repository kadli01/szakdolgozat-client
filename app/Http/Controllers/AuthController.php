<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Call;

class AuthController extends Controller
{
    public function loginForm()
    {
    	if (session('user_token')) {
    		return redirect('/');
    	}
    	return view('auth.login');
    }

    public function login(Request $request)
    {
    	$response = Call::post('/auth/login', ['form_params' => $request->all()]);

        if($response->status == 'error')
        {
            if($response->message == 'validation')
            {
                return redirect()->back()->withErrors($response->data)->withInput();
            } else {

                return redirect()->back()->with('error', $response->message)->withInput();
            }
        }
        elseif($response->status == 'success')
        {
            session(['user_token' => $response->data->token]);

            return redirect('/')->withSuccess($response->message);
        }
    }


    public function registerForm()
    {
        if (session('user_token')) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Call::post('/auth/register', ['form_params' => $request->all()]);
        dd($response);
    }

    public function logout()
    {
        $token = session('user_token');
        $response = Call::get('/auth/logout', ['headers' => ['Authorization' => 'bearer' . $token]]);

        session()->flush();

        if ($response->status == 'success') {
            return redirect('/')->withSuccess($response->message);
        } else {
            return redirect('/')->with('error', $response->message);
        }
        
    }
}
