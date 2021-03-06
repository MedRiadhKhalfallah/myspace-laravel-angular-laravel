<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Carbon\Carbon;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class ProfileController extends Controller
{
    protected $user;

    public function __construct()
    {
        if (JWTAuth::getToken()) {
            $this->user = JWTAuth::parseToken()->authenticate();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(auth()->user());
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return  Profile $profile
     */
    public function show(User $profile)
    {
        return $profile;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileUpdateRequest $request, User $user)
    {
        /** @var User $user */
        $user = User::where('id', $request->input('id'))->first();
        /** @var User $userAuth */
        $userAuth = User::where('id', auth()->user()->getAuthIdentifier())->first();
        if ($user && auth()->user()->getAuthIdentifier() === $user->id) {
            $res = $user->update([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'telephone' => $request->input('telephone'),
                'username' => $request->input('username'),
                'site_web' => $request->input('site_web'),
                'site_fb' => $request->input('site_fb'),
                'sex' => $request->input('sex'),
                'description' => $request->input('description'),
                'date_de_naissance' => $request->input('date_de_naissance'),
                'etat' => $request->input('etat'),
                'updated_at' => $request->input('updated_at'),
            ]);

        } elseif ($user && $userAuth && $userAuth->hasRole('admin')) {
            //add role update
            $res = $user->update([
                'nom' => $request->input('nom'),
                'prenom' => $request->input('prenom'),
                'telephone' => $request->input('telephone'),
                'username' => $request->input('username'),
                'site_web' => $request->input('site_web'),
                'site_fb' => $request->input('site_fb'),
                'sex' => $request->input('sex'),
                'description' => $request->input('description'),
                'date_de_naissance' => $request->input('date_de_naissance'),
                'etat' => $request->input('etat'),
                'updated_at' => $request->input('updated_at'),
            ]);

        }
        if ($res) {
            return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation utilisateur'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(Request $request, $id)
    {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $res = null;
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return response()->json(['message' => 'mot de passe non conforme'], 400);
        }
        if (Hash::check($request->input('oldPassword'), Auth::user()->password)) {
            $obj_user->password = $request->input('password');
            $obj_user->save();
            return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation utilisateur'], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileImage(Request $request, $id)
    {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $res = null;
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('profiles_images', $fileNameUnique, 'public');


            $obj_user->image_profile_name = $fileName;
            $obj_user->image_profile_path = $fileNameUnique;
            $res = $obj_user->save();
            if ($res) {
                return response()->json(['message' => 'Photo de profile a ete modifier avec success'], 200);
            } else {
                return response()->json(['error' => 'Echec modification image de profile'], 400);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCovertureImage(Request $request, $id)
    {
        $user_id = Auth::User()->id;
        $obj_user = User::find($user_id);
        $res = null;
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('covertures_images', $fileNameUnique, 'public');


            $obj_user->image_coverture_name = $fileName;
            $obj_user->image_coverture_path = $fileNameUnique;
            $res = $obj_user->save();
            if ($res) {
                return response()->json(['message' => 'Photo de coverture a ete modifier avec success'], 200);
            } else {
                return response()->json(['error' => 'Echec modification image de coverture'], 400);
            }

        }
    }


}
