<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
            $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return $this->user;
        $roles = $this->user->roles()->get()->toArray();
        return $roles;
    }

    public function getData()
    {
        return User::with('roles')->get();
    }
}
