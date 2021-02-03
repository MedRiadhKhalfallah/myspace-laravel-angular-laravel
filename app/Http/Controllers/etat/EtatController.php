<?php

namespace App\Http\Controllers\etat;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\EtatCreateRequest;
use App\Models\Etat;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class EtatController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Etat';

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
        $this->authorize('index', Etat::class);
        return Etat::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtatCreateRequest $request)
    {

        $this->authorize('store', Etat::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $param['createur_id'] = Auth::user()->id;
        $res = Etat::create($param);

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res->format(), 'message' => 'Etat cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Etat'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Etat $etat)
    {
        $this->authorize('show', $etat);
        return $etat;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EtatCreateRequest $request, Etat $etat)
    {
        $this->authorize('update', $etat);
        $res = $etat->update($request->all());

        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $etat->format(), 'message' => 'Etat cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Etat'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etat $etat)
    {
        $this->authorize('destroy', $etat);

        $res = $etat->delete();
        if ($res) {
            $this->saveHistorique('destroy', $etat->id);
            return response()->json(['message' => 'Etat modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Etat'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        $contenu["Nom d'état"]=$action_contenu['nom'];
        $contenu["Ordre d'état"]=$action_contenu['order'];
        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $contenu,
            ]
        );
    }

}
