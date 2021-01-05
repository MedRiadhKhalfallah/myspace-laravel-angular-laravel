<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
        $this->middleware('auth:api', ['except' => ['login', 'signup', 'signupOrLoginSocialite']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
//        connection avec google
        $data = request(['email', 'password', 'nom', 'prenom', 'provider_id', 'photoUrl']);
        if ($data['password'] == "jvrdsogrjoi&kjsdflmsdf45sdfsdf3q7834sqf5sd4f3sdq4g8fd4g2fd24gh8f5dh44fgd58h"){
        $user = User::where('email', '=', $data['email'])->where('provider_id', '=', $data['provider_id'])->first();
        if (!$user) {
            $user = new User();
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
            $user->telephone = "12345678";
            $user->email = $data['email'];
            $user->provider_id = $data['provider_id'];
            $user->avatar = $data['photoUrl'];
            $user->password = "jvrdsogrjoi&kjsdflmsdf45sdfsdf3q7834sqf5sd4f3sdq4g8fd4g2fd24gh8f5dh44fgd58h";
            $user->save();
            $user->assignRole('utilisateur');
            $user->assignRole('admin');
        }
    }
//        connection avec google /

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
        return response()->json(auth()->user()->format());
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
}
