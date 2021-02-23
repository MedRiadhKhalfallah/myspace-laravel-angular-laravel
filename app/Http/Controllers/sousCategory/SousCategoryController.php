<?php

namespace App\Http\Controllers\sousCategory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\SousCategoryCreateRequest;
use App\Models\SousCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class SousCategoryController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'SousCategorie';

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
/*        $this->authorize('index', SousCategory::class);
        return SousCategory::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SousCategoryCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SousCategoryCreateRequest $request)
    {
        $this->authorize('store', SousCategory::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $res = SousCategory::create($param);
        if ($res) {
            $this->saveHistorique('store', $request->all());
            return response()->json(['data' => $res->format(), 'message' => 'Sous categorie cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Sous categorie'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param SousCategory $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SousCategory $sousCategory)
    {
        $this->authorize('show', $sousCategory);
        return $sousCategory;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SousCategoryCreateRequest $request
     * @param SousCategory $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SousCategoryCreateRequest $request, SousCategory $sousCategory)
    {
        $this->authorize('update', $sousCategory);
        $res = $sousCategory->update($request->all());
        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $sousCategory->format(), 'message' => 'SousCategorie cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation SousCategorie'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SousCategory $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SousCategory $sousCategory)
    {
        $this->authorize('destroy', $sousCategory);
        $res = $sousCategory->delete();
        if ($res) {
            $this->saveHistorique('destroy', $sousCategory->id);
            return response()->json(['message' => 'SousCategorie modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification SousCategorie'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        if (isset($action_contenu['description'])) {
            $contenu["Description"] = $action_contenu['description'];
        }
        if (isset($action_contenu['nom'])) {
            $contenu["Nom"] = $action_contenu['nom'];
        }
        if (isset($action_contenu['order'])) {
            $contenu["Ordre"] = $action_contenu['order'];
        }
        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $contenu,
            ]
        );
    }

}
