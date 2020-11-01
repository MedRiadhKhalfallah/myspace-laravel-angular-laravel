<?php

namespace App\Http\Controllers\modele;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeleCreateRequest;
use App\Image;
use App\Models\Modele;
use JWTAuth;

class ModeleController extends Controller
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
        return Modele::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModeleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ModeleCreateRequest $request)
    {
        if (Modele::isExiste($request) !== false) {
            return Modele::isExiste($request);
        }

        $res = Modele::create($request->all());

            if ($res) {
                return response()->json(['message' => 'modele cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation modele'], 400);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param Modele $modele
     * @return  modele $modele
     */
    public function show(Modele $modele)
    {
        return $modele;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModeleCreateRequest $request
     * @param Modele $modele
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ModeleCreateRequest $request, Modele $modele)
    {
        $res = $modele->update($request->all());

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Modele $modele
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Modele $modele)
    {
        $res = $modele->delete();
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }
}
