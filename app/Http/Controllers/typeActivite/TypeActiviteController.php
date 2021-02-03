<?php

namespace App\Http\Controllers\typeActivite;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\TypeActiviteCreateRequest;
use App\Models\TypeActivite;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class TypeActiviteController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Type activité';

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
        $this->authorize('index', TypeActivite::class);
        return TypeActivite::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TypeActiviteCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TypeActiviteCreateRequest $request)
    {
        $this->authorize('store', TypeActivite::class);

        if (TypeActivite::isExiste($request) !== false) {
            return TypeActivite::isExiste($request);
        }

        $res = TypeActivite::create($request->all());

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res, 'message' => 'TypeActivite cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation TypeActivite'], 400);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(TypeActivite $typeActivite)
    {
        $this->authorize('show', $typeActivite);
        return $typeActivite;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeActiviteCreateRequest $request, TypeActivite $typeActivite)
    {
        $this->authorize('update', $typeActivite);
        $res = $typeActivite->update($request->all());
        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['message' => 'TypeActivite cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation TypeActivite'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeActivite $typeActivite)
    {
        $this->authorize('destroy', TypeActivite::class);

        $res = $typeActivite->delete();
        if ($res) {
            $this->saveHistorique('destroy', $typeActivite->id);
            return response()->json(['message' => 'TypeActivite modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification TypeActivite'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        $contenu["Type d'activté"]=$action_contenu['nom'];
        $contenu["Coleur"]=$action_contenu['coleur'];
        $contenu["Icon URL"]=$action_contenu['iconUrl'];
        $contenu["Legende dans le map"]=$action_contenu['map_legende'];
        $contenu["Description de legende"]=$action_contenu['map_description'];

        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $contenu,
            ]
        );
    }


}
