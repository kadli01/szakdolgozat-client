<?php 
namespace App\Helpers;
use Response;
use \Illuminate\Http\Response as Res;

class AjaxHelper{

	public function respond($data)
	{
		return Response::json($data);
	}

	public static function success($data, $message)
	{
		return Response::json([
			'status' => 'success',
			'status_code' => Res::HTTP_OK,
			'message' => $message,
			'data' => $data
		]);
	}

	public static function error($data, $message)
	{
		return Response::json([
			'status' => 'error',
			'status_code' => Res::HTTP_UNAUTHORIZED,
			'message' => $message,
			'data' => $data
		]);
	}

	public static function validation($errors)
	{
		return Response::json([
			'status' => 'error',
			'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
			'message' => 'validation',
			'data' => $errors
		]);
	}

}