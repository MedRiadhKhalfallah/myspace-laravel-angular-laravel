<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request)
    {
        return $this->getPasswordResetTableRow($request)->count() > 0 ? $this->changePassword($this->getPasswordResetTableRow($request)->first(), $request) : $this->tokenNotFoundResponse();

    }

    private function getPasswordResetTableRow($request)
    {
        return DB::table('password_resets')->where(['token' => $request->token]);
    }

    private function changePassword($dataTableReset, $request)
    {
        $email = $dataTableReset->email;
        $user = User::where('email', $email)->first();
        $user->update(['password' => $request->password]);
        $this->getPasswordResetTableRow($request)->delete();
        return \response()->json(['data' => 'password Successfully changed'], Response::HTTP_CREATED);
    }

    private function tokenNotFoundResponse()
    {
        return response()->json(['error' => 'Token is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
