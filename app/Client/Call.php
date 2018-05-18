<?php

namespace App\Client;

class Call{
	
	public static function get($path, $params = [])
	{
		$apiKey = env('API_KEY');

		$client = new \GuzzleHttp\Client();

		$params['api_key'] = $apiKey;

		if (session('user_token')) {
			// $params['user_token'] = session('user_token');
			$params['headers'] = ['Authorization' => 'bearer ' . session('user_token')];
 		}


		$url = env('API_URL') . $path . '?' . http_build_query($params);
		// $params['headers'] = $headers;
		try
		{
			$response = $client->request('GET', $url, $params);
			$responseData = json_decode($response->getBody());

			if($response->getHeaders()){
				$headers = $response->getHeaders();
				if(array_key_exists("Authorization", $headers)){
					session(['user_token' => explode(" ", $headers["Authorization"][0])[1]]);	
				}
			}
			// if(isset($response_data->statusCode) && $response_data->statusCode == 401){
			// 	session()->flush();
			// }
			
		}
		catch (\Exception $e)
		{
			// \App::abort(404);
			dd($e);
		}
		
		return $responseData;
	}

	public static function post($path, $params = [], $headers = [])
	{
		$apiKey = env('API_KEY');

		$client = new \GuzzleHttp\Client();
		
		$params['api_key'] = $apiKey;

		$url = env('API_URL') . $path;

		// if(session('user_token') && isset($params['form_params']))
		// {
		// 	$params['form_params']['user_token'] = session('user_token');
		// }

		// if(session('user_token') && isset($params['multipart']))
		// {
		// 	$url .= '?user_token=' . session('user_token');
		// }

		if (session('user_token')) {
			// $params['user_token'] = session('user_token');
			$params['headers'] = ['Authorization' => 'bearer ' . session('user_token')];
 		}

		// $params['headers'] = $headers;

		try
		{
			$response = $client->request('POST', $url, $params);

			if($response->getHeaders()){
				$headers = $response->getHeaders();
				if(array_key_exists("Authorization", $headers)){
					session(['user_token' => explode(" ", $headers["Authorization"][0])[1]]);	
				}
			}
			$responseData = json_decode($response->getBody());
		}
		catch (\Exception $e)
		{	
			dd($e);
			\App::abort(404);
		}
		
		return $responseData;
	}
}