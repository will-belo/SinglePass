<?php


namespace App\Http\Controllers\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        $allUser = User::all();

        return $allUser;
    }

    public function signin(Request $data): string|Exception
    {
        $credentials = $data->only('email', 'password');

        if(! $token = JWTAuth::attempt($credentials)){
            throw new Exception('Credenciais de login inválidas.');
        }

        return $token;
    }

    public function store(Request $data): string|Exception
    {
        $userModel = User::create([
            'name'     => $data->name,
            'email'    => $data->email,
            'password' => $data->password,
        ]);

        if (! $userModel) {
            throw new Exception('Erro ao cadastrar o usuário.');
        }

        $userToken = $userModel->createToken('firstToken', ['access:common'])->plainTextToken;

        return $userToken;
    }
}