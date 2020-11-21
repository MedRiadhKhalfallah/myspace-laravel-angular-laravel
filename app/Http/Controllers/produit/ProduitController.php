<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitCreateRequest;
use App\Image;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JWTAuth;

class ProduitController extends Controller
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
        return Produit::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProduitCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProduitCreateRequest $request)
    {
        $res = Produit::create($request->all());

        if ($res) {
            $details = [
                'object' => 'Ajout produit',
                'title' => 'Ajout produit',
                'body' => 'votre nouveu produit est ajouter'
            ];

            Mail::to('mrk19933@gmail.com')->send(new \App\Mail\MyTestMail($details));

            return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation utilisateur'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Produit $produit
     * @return  produit $produit
     */
    public function show(Produit $produit)
    {
        return $produit;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProduitCreateRequest $request
     * @param Produit $produit
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProduitCreateRequest $request, Produit $produit)
    {
        $res = $produit->update($request->all());

            if ($res) {
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param Produit $produit
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Produit $produit)
    {
        // delete foreign entity
        $produit->images->each->delete();

        $res = $produit->delete();
        if ($res) {
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }
}
