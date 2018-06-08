<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use \Call;
use JWTAuth;
use App\Helpers\AjaxHelper;

class CalculatorController extends Controller
{
    public function index($date = null)
    {
        if ($date == null) 
        {
            $date = Carbon::today()->toDateString();
        }

    	$response = Call::get('/calculator/index', ['date' => $date]);

        if ($response->status == 'success') 
        {
           $categories = $response->data->categories;
    	   $userFoods = collect($response->data->userFoods);
    	   return view('calculator.indexv2', compact('categories', 'userFoods', 'date')) ;
    	} else {
            return redirect('/')->with('error', $response->message);
        }
    }

    public function add(Request $request)  
    {
        $response = Call::post('/calculator/add', ['form_params' => $request->all()]);
        
        if ($response->status == 'success') 
        {
            return AjaxHelper::success($response->data, 'Item successfully added!');        
        } elseif ($response->message == 'validation') {
            return redirect()->back()->withErrors($response->data);
        } else {
            return AjaxHelper::error([] , 'Error!');     
        }
    }

    public function delete($id)
    {
        $response = Call::post('/calculator/delete/', ['form_params' => ['id' => $id]]);
        if ($response->status == 'success') 
        {
            return AjaxHelper::success($response->data, 'Item successfully deleted!');        
        } elseif ($response->message == 'validation') {
            return redirect()->back()->withErrors($response->data);
        } else {
            return AjaxHelper::error([] , 'Error!');     
        }
    }

    public function statistics($startDate = null, $endDate = null)
    {
        if ($startDate == null) 
        {
            $startDate = Carbon::today()->subMonth();
        }
        else
        {
            $startDate = Carbon::parse($startDate);
        }

        if ($endDate == null) 
        {
            $endDate = Carbon::today()->addDay();
        }
        else
        {
            $endDate = Carbon::parse($endDate)->addDay();
        }

        $response = Call::post('/calculator/statistics', ['form_params' => ['startDate' => $startDate->toDateString(), 'endDate' => $endDate->toDateString()]]);

        if ($response->status == 'success') 
        {
            $userFoods = $response->data->userFoods;
            $userCategories = $response->data->userCategories;
            
            return view('calculator.statistics', compact('userFoods', 'userCategories', 'startDate', 'endDate')) ;
        } else {
            return redirect('/')->with('error', $response->message);
        }
    }

    public function filter(Request $request)
    {
        if ($request->start_date == null) 
        {
            $startDate = Carbon::today()->subMonth();
        }
        else
        {
            $startDate = Carbon::parse($request->start_date);
        }

        if ($request->end_date == null) 
        {
            $endDate = Carbon::today()->addDay();
        }
        else
        {
            $endDate = Carbon::parse($request->end_date)->addDay();
        }
        return redirect(route('statistics', ['startDate' => $startDate->toDateString(), 'endDate' => $endDate->toDateString()]));
    }
}
