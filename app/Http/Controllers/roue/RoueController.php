<?php

namespace App\Http\Controllers\roue;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\RoueCreateRequest;
use App\Models\Roue;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class RoueController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Roue';

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
    public function getCurrentRoue()
    {
        return Roue::where('societe_id', '=', Auth::user()->societe_id)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Roue::class);
        return Roue::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoueCreateRequest $request)
    {

        $this->authorize('store', Roue::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $res = Roue::create($param);

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res->format(), 'message' => 'Roue cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Roue'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Roue $roue)
    {
        $roueFormat=$roue->format();
        if($roueFormat['etat']=='true'){
            return $roue->format();
        }else{
            return response()->json(['error' => "la roue n'est pas activée"], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoueCreateRequest $request, Roue $roue)
    {
        $this->authorize('update', $roue);
        $res = $roue->update($request->all());

        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $roue->format(), 'message' => 'Roue cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Roue'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roue $roue)
    {
        $this->authorize('destroy', $roue);

        $res = $roue->delete();
        if ($res) {
            $this->saveHistorique('destroy', $roue->id);
            return response()->json(['message' => 'Roue modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Roue'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        $contenu["état"]=$action_contenu['etat'];
        $contenu["game Over Text"]=$action_contenu['gameOverText'];
        $contenu=$action_contenu;
        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $contenu,
            ]
        );
    }

}
