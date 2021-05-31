<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class userController extends Controller
{
    public function login(request $request) {
    	$credentials = $request->only('email', 'password');
    	try {
    		if (! $token = JWTAuth::attempt($credentials)) {
    			return response()->json(['error' => 'invalid_credentials'], 400);
    		}
    	} catch (JWTException $e) {
    		return response()->json(['error' => 'could_not_create_token'], 500);
    	}
        $level=Auth::user()->level;
        $name=Auth::user()->name;
    	return response()->json(compact('token','level','name'));
    }

    public function register(request $request) {
    	$validator = Validator::make($request->all(), [
    		'name' => 'required|string|max:255',
    		'email' => 'required|string|email|max:255|unique:user',
    		'password' => 'required|string|min:6|confirmed',
    		'level' => 'required',
    	]);
    	if($validator->fails()) {
    		$data['status']=false;
            $data['message']=$validator->errors();
            return response()->json($data);
    	}
    	$user = User::create ([
    		'name' => $request->get('name'),
    		'email' => $request->get('email'),
    		'password' => Hash::make($request->get('password')),
    		'level' => $request->get('level'),
    	]);
        if($user){
            $data['status']=true;
            $data['message']="Sukses Menambahkan User";
        }else{
            $data['status']=false;
            $data['message']=['error'=>["Gagal Menambahkan User"]];
        }
        return response()->json($data);
    	$token = JWTAuth::fromUser($user);
    	return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser() {
    	try {
    		if (! $user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['user_not_found'], 404);
    		}
    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    		return response()->json(['token_expired'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
       		return response()->json(['token_absent'], $e->getStatusCode());
    	}
    	return response()->json(compact('user'));
    }
}
