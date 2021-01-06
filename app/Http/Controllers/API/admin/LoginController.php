<?php

namespace App\Http\Controllers\API\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class LoginController extends Controller
{
    use GeneralTrait ;
    public function login(Request $request)
    {
        try {

            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                $this->returnValidationError($code, $validator);
            }


            $credential = $request->only(['email','password']);
            $token = Auth::guard('Admin-api')->attempt($credential);
            if (!$token)
            {
                return $this->returnError('E001' ,"invalid Data");
            }
            $admin = Auth::guard('Admin-api')->user();
            $admin->api_token = $token;
            return $this->returnData('users' , $admin,'success');

        }
        catch (\Exception $ex)
        {
            return  $this->returnError($ex->getCode() , $ex->getMessage());
        }
    }
}
