<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        if(JWTAuth::getToken()){
            $this->user = JWTAuth::parseToken()->authenticate();
        }

    }

    public function index()
    {
        return $this->user;
        $roles = $this->user->roles()->get()->toArray();
        return $roles;
    }

    public function getData()
    {
//        return User::role('admin')->get();
        return User::with('roles')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function addEntity(UserRequest $request)
    {
        $res = User::create($request->all());
        if ($res) {
            return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation utilisateur'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function getEntity(User $user)
    {
        return $user;

    }
    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $res = $user->update($request->all());
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        // delete foreign entity
        $user->roles->each->delete();

        $res = $user->delete();
        if ($res) {
            return response()->json(['message' => 'Utilisateur supprimer avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec supprission utilisateur'], 400);
        }

    }


}
