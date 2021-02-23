<?php

namespace App\Http\Controllers\marque;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\MarqueCreateRequest;
use App\Image;
use App\Models\Marque;
use Carbon\Carbon;
use JWTAuth;

class MarqueController extends Controller
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
        return Marque::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarqueCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MarqueCreateRequest $request)
    {
        $this->authorize('store', Marque::class);
        if (Marque::isExiste($request) !== false) {
            return Marque::isExiste($request);
        }

        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('marques_images', $fileNameUnique, 'public');

            $res = Marque::create([
                'nom' => $request->input('nom'),
                'image_name' => $fileName,
                'image_path' => $fileNameUnique,
                'etat' =>$request->input('etat'),
                'updated_at' =>$request->input('updated_at'),
                'created_at' =>$request->input('created_at')
            ]);

            if ($res) {
                $this->saveHistorique('store', $request->all());
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Marque $marque
     * @return  marque $marque
     */
    public function show(Marque $marque)
    {
        $this->authorize('show', $marque);
        return $marque;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarqueCreateRequest $request
     * @param Marque $marque
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MarqueCreateRequest $request, Marque $marque)
    {
        $this->authorize('update', $marque);
        $updateData=[];
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('marques_images', $fileNameUnique, 'public');
            $updateData['image_name']=$fileName;
            $updateData['image_path']=$fileNameUnique;
        }
        $updateData['nom']=$request->input('nom');
        $updateData['etat']=$request->input('etat');
        $updateData['updated_at']=$request->input('updated_at');

        $res = $marque->update($updateData);

            if ($res) {
                $this->saveHistorique('update', $request->all());
                return response()->json(['message' => 'Utilisateur cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation utilisateur'], 400);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Marque $marque
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Marque $marque)
    {
        // delete foreign entity
//        $marque->modeles->each->delete();
        $this->authorize('destroy', $marque);
        $res = $marque->delete();
        if ($res) {
            $this->saveHistorique('destroy', $marque->id);
            return response()->json(['message' => 'Utilisateur modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification utilisateur'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
        if (isset($action_contenu['nom'])) {
            $contenu["Nom"] = $action_contenu['nom'];
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
