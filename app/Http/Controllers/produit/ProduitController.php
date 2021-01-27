<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\ProduitCreateRequest;
use App\Models\Produit;
use App\Models\Societe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class ProduitController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Produit';

    public function __construct(HistoriqueController $historiqueController)
    {
        $this->historiqueController = new HistoriqueController();
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
        $this->authorize('index', Produit::class);
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
        $this->authorize('store', Produit::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $param['createur_id'] = Auth::user()->id;
        $res = Produit::create($param);

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res->format(), 'message' => 'Produit cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Produit'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Produit $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        $this->authorize('show', $produit);
        return $produit;

    }

    /**
     * Display the specified resource.
     *
     * @param string $referencet
     * @return \Illuminate\Http\Response
     */
    public function getProduitByReference(string $reference)
    {
        return Produit::with('societe')->
        where('reference', '=', $reference)->
        first()->formatProduitByReference();
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
        $this->authorize('update', $produit);
        $res = $produit->update($this->params($request));

        if ($res) {
            $this->saveHistorique('update', $this->params($request));
            return response()->json(['message' => 'Produit cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Produit'], 400);
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
        $this->authorize('destroy', Produit::class);

        $res = $produit->delete();
        if ($res) {
            $this->saveHistorique('destroy', $produit->id);
            return response()->json(['message' => 'Societe modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Societe'], 400);
        }

    }

    private function params(ProduitCreateRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin_societe')) {
            return $request->except(['reference', 'societe_id', 'createur_id']);
        } else {
            return $request->all();
        }
    }

    private function saveHistorique($action, $action_contenu)
    {
        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $action_contenu,
            ]
        );
    }

}
