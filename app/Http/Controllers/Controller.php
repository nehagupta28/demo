<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;
class Controller extends BaseController
{
	protected function BuildFailedValidationResponse(Request $request, array $errors)
{
		return response(["success" => false, "message" =>$errors], 401);
}
}
