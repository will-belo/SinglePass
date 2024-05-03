<?php


namespace App\Interfaces;

use Error;
use Exception;
use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;

interface UserRepositoryInterface
{
    public function getAll();

    public function signin(Request $data): string|Exception;

    public function store(Request $data): string|Exception;
}