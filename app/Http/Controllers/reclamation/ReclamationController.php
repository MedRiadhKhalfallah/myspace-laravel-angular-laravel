<?php

namespace App\Http\Controllers\reclamation;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\ReclamationCreateRequest;
use App\Models\Marque;
use App\Models\Reclamation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class ReclamationController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Reclamation';

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
        $this->authorize('index', Reclamation::class);

        if (Auth::user()->hasRole('admin')) {
            return Reclamation::orderBy('id','DESC')->get()
                ->map->format();

        } else {
            return Reclamation::where('societe_id', '=', Auth::user()->societe_id)
                ->orderBy('id','DESC')
                ->get()
                ->map->format();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReclamationCreateRequest $request)
    {
        $this->authorize('store', Reclamation::class);

        if (Reclamation::isExiste($request) !== false) {
            return Reclamation::isExiste($request);
        }

        $fileNameUnique = "";
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('reclamations_images', $fileNameUnique, 'public');
        }

        $param = [
            'reference' => $request->input('reference'),
            'description' => $request->input('description'),
            'image_path' => $fileNameUnique,
            'societe_id' => Auth::user()->societe_id,
            'user_id' => Auth::user()->id,
            'etat' => "en attend",
            'created_at' => date("Y-m-d H:i:s")
        ];
        $res = Reclamation::create($param);

        if ($res) {
            $this->saveHistorique('Creation', $param);

            return response()->json(['data' => $res->format(), 'message' => 'Reclamation cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Reclamation'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reclamation $reclamation)
    {
        $this->authorize('show', $reclamation);
        return $reclamation;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReclamationCreateRequest $request, Reclamation $reclamation)
    {
        $this->authorize('update', $reclamation);
        $res = $reclamation->update($request->all());

        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $reclamation->format(), 'message' => 'Reclamation modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Reclamation'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reclamation $reclamation)
    {
        $this->authorize('destroy', $reclamation);

        $res = $reclamation->delete();
        if ($res) {
            $this->saveHistorique('destroy', $reclamation->id);
            return response()->json(['message' => 'Reclamation modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Reclamation'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        if (isset($action_contenu['reference'])) {
            $contenu["Référence réclamation"] = $action_contenu['reference'];
        }
        if (isset($action_contenu['etat'])) {

            $contenu["Etat réclamtion"] = $action_contenu['etat'];
        }
        if (isset($action_contenu['description'])) {

            $contenu["Description"] = $action_contenu['description'];
        }
        if (isset($action_contenu['image_path'])) {

            $contenu["image"] = $action_contenu['image_path'];
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
