<?php

namespace App\Http\Controllers;

use App\Mail\MailVerificationMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class MailVerificationController extends Controller
{
    public function sendEmailVerification(Request $request)
    {
        if (!$this->validateEmail($request->email)) {
            return $this->failedResponse();
        }
        $this->sendEmail($request->email);
        $this->successResponse();
    }

    public function validateEmail($email)
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'Email doesn\'t exist'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'error' => 'Email sent.plz check your in box'
        ], Response::HTTP_OK);
    }

    public function sendEmail($email)
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new MailVerificationMail($token));
    }

    public function createToken($email)
    {
        $oldToken = DB::table('mail_verifications')->where('email', $email)->first();
        if ($oldToken) {
            return $oldToken->token;
        } else {
            $token = Str::random(60);
            $this->saveToken($token, $email);
            return $token;
        }
    }

    public function saveToken($token, $email)
    {
        DB::table('mail_verifications')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    /** reponse verification compte */
    public function verificationMail(Request $request)
    {
        return $this->getMailVerificationTableRow($request)->count() > 0 ? $this->valideMail($this->getMailVerificationTableRow($request)->first(), $request) : $this->tokenNotFoundResponse();
    }

    private function getMailVerificationTableRow($request)
    {
        return DB::table('mail_verifications')->where(['token' => $request->token]);
    }

    private function valideMail($dataTableReset, $request)
    {
        $email = $dataTableReset->email;
        $user = User::where('email', $email)->first();
        $user->update(['email_verified_at' => '2020-12-17 00:00:00.000000']);
        $this->getMailVerificationTableRow($request)->delete();
        return \response()->json(['data' => 'compte Successfully verifed'], Response::HTTP_CREATED);
    }

    private function tokenNotFoundResponse()
    {
        return response()->json(['error' => 'Token is incorrect'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
