<?php

namespace App\Http\Controllers\societe;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\SocieteCreateRequest;
use App\Models\Societe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class SocieteController extends Controller
{

    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Société';

    public function __construct()
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
        $this->authorize('index', Societe::class);
        return Societe::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentSociete()
    {
        return Auth::user()->societe()->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SocieteCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SocieteCreateRequest $request)
    {
        $this->authorize('store', Societe::class);
        if (Societe::isExiste($request) !== false) {
            return Societe::isExiste($request);
        }

        $res = Societe::create($this->params($request));

        if ($res) {
            $user = User::where('id', '=', Auth::user()->id)->first();
            $resUser = $user->update(['societe_id' => $res->id]);
            if ($resUser) {
                $this->saveHistorique('store', $this->params($request));

                return response()->json(['data' => $res->format(), 'message' => 'Societe cree avec succee'], 200);
            }
        }
        return response()->json(['error' => 'Echec creation Societe'], 400);

    }

    /**
     * Display the specified resource.
     *
     * @param Societe $societe
     * @return Societe $societe
     */
    public function show(Societe $societe)
    {
//        $this->authorize('show', $societe);
        return $societe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SocieteCreateRequest $request
     * @param Societe $societe
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SocieteCreateRequest $request, Societe $societe)
    {
        $this->authorize('update', $societe);
        $res = $societe->update($this->params($request));

        if ($res) {
            $this->saveHistorique('update', $this->params($request));

            return response()->json(['data' => $societe->format(), 'message' => 'Utilisateur cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation utilisateur'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Societe $societe
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Societe $societe)
    {
        $this->authorize('destroy', Societe::class);

        $res = $societe->delete();
        if ($res) {
            $this->saveHistorique('destroy', $societe->id);
            return response()->json(['message' => 'Societe modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Societe'], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCovertureImage(Request $request, int $id)
    {
        $societe = Societe::find($id);

        $this->authorize('updateCovertureImage', $societe);

        $res = null;
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('societes_covertures_images', $fileNameUnique, 'public');


            $societe->image_coverture_name = $fileName;
            $societe->image_coverture_path = $fileNameUnique;
            $res = $societe->save();

            if ($res) {
                $this->saveHistorique('updateCovertureImage', $request->all());

                return response()->json(['data' => $societe->format(), 'message' => 'Photo de coverture a ete modifier avec success'], 200);
            } else {
                return response()->json(['error' => 'Echec modification image de coverture'], 400);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSocieteImage(Request $request, $id)
    {
        $societe = Societe::find($id);
        $this->authorize('updateSocieteImage', $societe);

        $res = null;
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('societes_images', $fileNameUnique, 'public');

            $societe->image_societe_name = $fileName;
            $societe->image_societe_path = $fileNameUnique;
            $res = $societe->save();
            if ($res) {
                $this->saveHistorique('updateSocieteImage', $request->all());

                return response()->json(['data' => $societe->format(), 'message' => 'Photo de profile a ete modifier avec success'], 200);
            } else {
                return response()->json(['error' => 'Echec modification image de profile'], 400);
            }

        }
    }

    private function params(SocieteCreateRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $param = $request->all();
            $param['date_fin_abonnement'] = date("Y-m-d", strtotime($request->input('date_fin_abonnement')) + 7200);
            return $param;
        } else {
            return $request->except(['type_abonnement', 'date_fin_abonnement', 'etat']);
        }
    }

    private function saveHistorique($action, $action_contenu)
    {
        if (isset($action_contenu['nom'])) {
            $contenu["Nom de société"] = $action_contenu['nom'];
        }
        if (isset($action_contenu['adresse'])) {
            $contenu["Adresse"] = $action_contenu['adresse'];
        }
        if (isset($action_contenu['complement_adresse'])) {
            $contenu["Complément de l'adresse"] = $action_contenu['complement_adresse'];
        }
        if (isset($action_contenu['code_postal'])) {
            $contenu["Code postal"] = $action_contenu['code_postal'];
        }
        if (isset($action_contenu['ville'])) {
            $contenu["Ville"] = $action_contenu['ville'];
        }
        if (isset($action_contenu['telephone_mobile'])) {
            $contenu["Téléphone mobile"] = $action_contenu['telephone_mobile'];
        }
        if (isset($action_contenu['telephone_fix'])) {
            $contenu["Téléphone fix"] = $action_contenu['telephone_fix'];
        }
        if (isset($action_contenu['longitude'])) {
            $contenu["Longitude dans le map"] = $action_contenu['longitude'];
        }
        if (isset($action_contenu['latitude'])) {
            $contenu["Latitude  dans le map"] = $action_contenu['latitude'];
        }
        if (isset($action_contenu['email'])) {
            $contenu["E-mail"] = $action_contenu['email'];
        }
        if (isset($action_contenu['notre_code_invitation'])) {
            $contenu["Code parainage"] = $action_contenu['notre_code_invitation'];
        }
        if (isset($action_contenu['votre_code_invitation'])) {
            $contenu["Code parainage invitation"] = $action_contenu['votre_code_invitation'];
        }
        if (isset($action_contenu['reference_societe'])) {
            $contenu["Référence"] = $action_contenu['reference_societe'];
        }
        if (isset($action_contenu['image_societe_name'])) {
            $contenu["Nom image société"] = $action_contenu['image_societe_name'];
        }
        if (isset($action_contenu['image_coverture_name'])) {
            $contenu["Nom image coverture"] = $action_contenu['image_coverture_name'];
        }
        if (isset($action_contenu['site_web'])) {
            $contenu["Site web"] = $action_contenu['site_web'];
        }
        if (isset($action_contenu['site_fb'])) {
            $contenu["Site FB"] = $action_contenu['site_fb'];
        }
        if (isset($action_contenu['description'])) {
            $contenu["Description"] = $action_contenu['description'];
        }
        if (isset($action_contenu['type_abonnement'])) {
            $contenu["Type abonnement"] = $action_contenu['type_abonnement'];
        }
        if (isset($action_contenu['date_fin_abonnement'])) {
            $contenu["Date fin d'abonnement"] = $action_contenu['date_fin_abonnement'];
        }
        if (isset($action_contenu['type_activite_id'])) {
            $contenu["Type Activité"] = $action_contenu['type_activite_id'];
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
