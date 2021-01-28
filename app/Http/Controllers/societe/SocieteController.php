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
    const CONTROLLER_NAME = 'Produit';

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

            return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
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

                return response()->json(['message' => 'Photo de coverture a ete modifier avec success'], 200);
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

                return response()->json(['message' => 'Photo de profile a ete modifier avec success'], 200);
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
            return $request->all();
        } else {
            return $request->except(['type_abonnement', 'date_fin_abonnement']);
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
