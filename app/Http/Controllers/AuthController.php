<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    /**login
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'redirectToGoogle',
                'handleGoogleCallback',
                'redirectToFacebook',
                'handleFacebookCallback',
                'login',
                'signup',
            ]]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or password does\'t exist'], 401);
        }
        $credentials['etat'] = true;
        if (!auth()->validate($credentials)) {
            auth()->logout();
            return response()->json(['error' => 'votre compte est desactivé'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
//            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $this->me(),
            'roles' => auth()->user()->getRoleNames()

        ]);
    }

    public function signup(SignUpRequest $request)
    {
        /** @var User $user */
        $user = User::create($request->all());
//        $user->givePermissionTo(['api'=>'show users']);
        $user->assignRole('utilisateur');
        return $this->login($request);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
//        return 'here';
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        return $this->signupOrLoginSocialite($user);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        return $this->signupOrLoginSocialite($user);
    }

    public function signupOrLoginSocialite($data)
    {
        /** @var User $user */
        $user = User::where('email', '=', $data->email)->first();
//        var_dump($data);
        if (!$user) {
            $user = new User();
            $user->nom = $data->name;
            $user->prenom = "test";
            $user->telephone = "12345678";
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->avatar = $data->avatar;
            $user->save();
            $user->assignRole('utilisateur');
        }
        if (!$token = auth()->login($user)) {
            return response()->json(['error' => 'Email does\'t exist'], 401);
        }
        if (!auth()->user()->getEtat()) {
            auth()->logout();
            return response()->json(['error' => 'votre compte est desactivé'], 401);
        }
        return $this->respondWithToken($token);

    }

}
