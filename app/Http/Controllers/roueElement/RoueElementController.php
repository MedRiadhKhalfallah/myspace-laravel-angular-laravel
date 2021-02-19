<?php

namespace App\Http\Controllers\roueElement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Models\RoueElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class RoueElementController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'RoueElement';

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
        $this->authorize('index', RoueElement::class);
        return RoueElement::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('store', RoueElement::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $param['createur_id'] = Auth::user()->id;
        $res = RoueElement::create($param);

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res->format(), 'message' => 'RoueElement cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation RoueElement'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(RoueElement $roueElement)
    {
        $this->authorize('show', $roueElement);
        return $roueElement;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoueElement $roueElement)
    {
        $this->authorize('update', $roueElement);
        $res = $roueElement->update($request->all());

        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $roueElement->format(), 'message' => 'RoueElement cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation RoueElement'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoueElement $roueElement)
    {
        $this->authorize('destroy', $roueElement);

        $res = $roueElement->delete();
        if ($res) {
            $this->saveHistorique('destroy', $roueElement->id);
            return response()->json(['message' => 'RoueElement modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification RoueElement'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        /*        $contenu["Nom d'état"]=$action_contenu['nom'];
                $contenu["Ordre d'état"]=$action_contenu['order'];*/
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
