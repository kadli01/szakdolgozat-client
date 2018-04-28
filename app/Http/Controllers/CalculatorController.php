<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
    	$response = Call::get('/foods');

    	dd($response);
    }
}
