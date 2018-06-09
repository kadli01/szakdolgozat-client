<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Call;

class AuthController extends Controller
{
    public function loginForm()
    {
    	if (session('user_token')) {
    		return redirect(route('calculator'));
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

            return redirect(route('calculator'))->withSuccess($response->message);
        }
    }


    public function registerForm()
    {
        if (session('user_token')) {
            return redirect(route('calculator'));
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Call::post('/auth/register', ['form_params' => $request->all()]);

        if($response->status == 'error')
        {
            if($response->message == 'validation')
                return redirect()->back()->withErrors($response->data)->withInput();
    
            return redirect()->back()->withErrors($response->message)->withInput();
        }
        elseif($response->status == 'success')
        {
            // session(['user_token' => $response->data->user_token]);

            return redirect(route('login'))->withSuccess($response->message);
        }
    }

    public function logout()
    {
        // $token = session('user_token');
        // $response = Call::get('/auth/logout', ['headers' => ['Authorization' => 'bearer' . $token]]);
        $response = Call::get('/auth/logout');
        session()->flush();

        if ($response->status == 'success') {
            return redirect(route('login'))->withSuccess($response->message);
        } else {
            return redirect(route('login'))->with('error', $response->message);
        }
    }

    public function passwordForm()
    {
        return view('auth.password');
    }

    public function passwordResetMail(Request $request)
    {
        $response = Call::post('/auth/password', ['form_params' => $request->all()]);

        if($response->status == 'error')
        {
            if($response->message == 'validation')
                return redirect()->back()->withErrors($response->data)->withInput();

            return redirect()->back()->withError($response->message)->withInput();
        }
        elseif($response->status == 'success')
        {
            return redirect(route('login'))->withSuccess($response->message);
        }
    }

    public function resetForm($token)
    {
        return view('auth.reset', compact('token'));
    }

    public function passwordReset(Request $request)
    {
        $response = Call::post('/auth/password/reset', ['form_params' => $request->all()]);

        if($response->status == 'error')
        {
            if($response->message == 'validation')
                return redirect()->back()->withErrors($response->data)->withInput();

            return redirect()->back()->withError($response->message)->withInput();
        }
        elseif($response->status == 'success')
        {
            return redirect(route('login'))->withSuccess($response->message);
        }   
    }

    public function verifyEmail($token)
    {
        $response = Call::get('/auth/verify/' . $token);

        if ($response->status == 'success') 
        {
            return redirect(route('login'))->withSuccess($response->message);
        } else {
            return redirect(route('login'))->withError($response->message);
        }
    }
}
