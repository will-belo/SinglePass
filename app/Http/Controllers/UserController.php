<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserRepositoryInterface $userRepository
    ){}

    public function signin(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
            $token = $this->userRepository->signin($request);

            return response()->json($token, 200);
        }catch(Exception $error){
            return response()->json($error->getMessage(), 401);
        }
    }

    public function create(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $token = $this->userRepository->store($request);

            return response($token, 201);
        }catch(Exception $error){
            return response($error->getMessage(), 500);
        }
    }

    public function verify(Request $request)
    {
        $claims = $request->attributes->get('claims');

        return response([
            'name' => $claims['name'],
            'role' => $claims['role'],
        ], 200);
    }
}
