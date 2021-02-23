<?php

namespace App\Http\Controllers\newProduit;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\NewProduitCreateRequest;
use App\Models\NewProduit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class NewProduitController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'NewProduit';

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
        $this->authorize('index', NewProduit::class);
        return NewProduit::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewProduitCreateRequest $request)
    {

        $this->authorize('store', NewProduit::class);
        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('new_produits_images', $fileNameUnique, 'public');

            $param = $request->all();
            $param['societe_id'] = Auth::user()->societe_id;
            $param['image_name'] = $fileName;
            $param['image_path'] = $fileNameUnique;
            unset($param['selectedFile']);

            $res = NewProduit::create($param);

            if ($res) {
                $this->saveHistorique('store', $request->all());

                return response()->json(['data' => $res->format(), 'message' => 'NewProduit cree avec succee'], 200);
            } else {
                return response()->json(['error' => 'Echec creation NewProduit'], 400);
            }
        } else {
            return response()->json(['error' => 'Une image est obligatoire pour ahouter un produit'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewProduit $newProduit)
    {
        return $newProduit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewProduitCreateRequest $request, NewProduit $newProduit)
    {
        $this->authorize('update', $newProduit);
        $param = $request->all();

        if ($request->hasFile('selectedFile')) {
            $fileNameExtension = $request->file('selectedFile')->getClientOriginalName();
            $fileName = pathinfo($fileNameExtension, PATHINFO_FILENAME);
            $extension = pathinfo($fileNameExtension, PATHINFO_EXTENSION);
            $fileNameUnique = $fileName . '_' . Carbon::now()->timestamp . '.' . $extension;
            $request->file('selectedFile')->storeAs('new_produits_images', $fileNameUnique, 'public');
            $param['image_name'] = $fileName;
            $param['image_path'] = $fileNameUnique;

        }
        unset($param['selectedFile']);
        $res = $newProduit->update($param);

        if ($res) {
            $this->saveHistorique('update', $param);
            return response()->json(['data' => $newProduit->format(), 'message' => 'NewProduit cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation NewProduit'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewProduit $newProduit)
    {
        $this->authorize('destroy', $newProduit);

        $res = $newProduit->delete();
        if ($res) {
            $this->saveHistorique('destroy', $newProduit->id);
            return response()->json(['message' => 'NewProduit modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification NewProduit'], 400);
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
