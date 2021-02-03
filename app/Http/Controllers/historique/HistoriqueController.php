<?php

namespace App\Http\Controllers\historique;

use App\Models\Historique;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;

class HistoriqueController extends Controller
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
        $this->authorize('index', Historique::class);
        return Historique::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($data)
    {
        $action_contenu = "<lu>";
        if (is_array($data['action_contenu'])) {
            foreach ($data['action_contenu'] as $key => $value) {
                if(is_array($value)){
                    $action_contenu .= "<lu>";
                    foreach ($value as $k => $v) {
                        if(is_array($v)){
                            $action_contenu .= "<li>"."array"."</li>";
                        }else{
                            $action_contenu .= "<li>"."$k: $v"."</li>";
                        }
                    }
                    $action_contenu .= "</lu>";
                }else{
                    $action_contenu .= "<li>"."$key: $value"."</li>";
                }
            }
        } else {
            $action_contenu = "<li>".$data['action_contenu']."</li>";
        }
        $action_contenu .= "</lu>";

        $res = Historique::create([
            'controller' => $data['controller'],
            'action' => $data['action'],
            'action_contenu' => $action_contenu,
            'societe_id' => Auth::user()->societe_id,
            'societe_nom' => Auth::user()->getSocieteNom(),
            'user_id' => Auth::user()->id,
            'user_nom' => Auth::user()->nom . ' ' . Auth::user()->prenom,
        ]);

        return $res;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSocieteHistorique()
    {
        $this->authorize('getSocieteHistorique', Historique::class);
        return Historique::where('societe_id', '=', Auth::user()->societe_id)->get();
    }

}
