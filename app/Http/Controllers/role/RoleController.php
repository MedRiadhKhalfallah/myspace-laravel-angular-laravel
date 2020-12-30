<?php

namespace App\Http\Controllers\role;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleCreateRequest;
use App\Image;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;

class RoleController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoleCreateRequest $request)
    {
        if (Role::isExiste($request) !== false) {
            return Role::isExiste($request);
        }

        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('roles_images', $fileNameUnique, 'public');

            $res = Role::create([
                'name' => $request->input('name'),
                'image_name' => $fileName,
                'image_path' => $fileNameUnique,
                'etat' =>$request->input('etat'),
                'updated_at' =>$request->input('updated_at'),
                'created_at' =>$request->input('created_at')
            ]);

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }

        }

/*        if ($request->file('selectedFile')) {
            foreach ($request->file('selectedFile') as $selectedFile) {
                $selectedFile->store("public");
            }
//            $file = $request->file('selectedFile')->store("public");
        }*/

    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return  role $role
     */
    public function show(Role $role)
    {
        return $role;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleCreateRequest $request
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoleCreateRequest $request, Role $role)
    {
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('roles_images', $fileNameUnique, 'public');

            $res = $role->update([
                'name' => $request->input('name'),
                'image_name' => $fileName,
                'image_path' => $fileNameUnique,
                'etat' =>$request->input('etat'),
                'updated_at' =>$request->input('updated_at'),
                'created_at' =>$request->input('created_at')
            ]);

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }

        }


/*        $res = $role->update($request->all());
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        // delete foreign entity
        $role->modeles->each->delete();

        $res = $role->delete();
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }
}
