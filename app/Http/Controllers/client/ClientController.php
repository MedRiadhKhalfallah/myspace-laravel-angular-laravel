<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Models\Client;
use App\Models\Roue;
use App\Models\RoueElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class ClientController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Client';

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
        $roue = Roue::where('societe_id', '=', Auth::user()->societe_id)->first();
        return Client::where('roue_id', '=', $roue->id)->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function VerificationClient(Request $request)
    {
        $param = $request->all();
        /** @var Client $client */
        $client = Client::where([
            ['roue_id', '=', $param['roue_id']],
            ['num_tel', '=', $param['num_tel']]
        ])->first();
        if ($client) {
            return response()->json(['data' => $client->format(), 'message' => 'u can play'], 200);
        } else {
            return response()->json(['error' => false, 'message' => 'u cant play'], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function endGame(Request $request)
    {
        $param = $request->all();
        /** @var Client $client */
        $client = Client::where([
            ['roue_id', '=', $param['roue_id']],
            ['num_tel', '=', $param['num_tel']]
        ])->first();
        if ($client) {
            $res = $client->update([
                    "value1" => $param['value1'],
                    "value2" => $param['value2']]
            );
            if ($res) {
                return response()->json(['data' => $client->format(), 'message' => 'Client cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation Client'], 400);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        /** @var Client $client */
        $client = Client::where([
            ['roue_id', '=', $param['roue_id']],
            ['num_tel', '=', $param['num_tel']]
        ])->first();
        if ($client) {
            $client->update($param);
            if ($client->getValue1() || $client->getValue2()) {
                return response()->json(['error' => false, 'message' => 'u cant play'], 400);
            } else {
                return response()->json(['data' => true, 'message' => 'u can play'], 200);
            }
        } else {
            $res = Client::create($param);
            if ($res) {
//                $this->saveHistorique('store', $request->all());

                return response()->json(['data' => $res->format(), 'message' => 'Client cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation Client'], 400);
            }
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function videCadeaux()
    {
        /** @var Roue $roue */
        $roue = Roue::where('societe_id', '=', Auth::user()->societe_id)->first();
        $clients = $roue->clients;
        $res = true;
        foreach ($clients as $client) {
            $res = $client->update(['value1' => null, 'value2' => null]);
        }
        if ($res) {
            return response()->json(['message' => 'Client cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Client'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $client;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $res = $client->delete();
        if ($res) {
            $this->saveHistorique('destroy', $client->id);
            return response()->json(['message' => 'Client modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Client'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        $contenu = $action_contenu;
        $this->historiqueController->store(
            [
                'controller' => $this::CONTROLLER_NAME,
                'action' => $action,
                'action_contenu' => $contenu,
            ]
        );
    }

}
