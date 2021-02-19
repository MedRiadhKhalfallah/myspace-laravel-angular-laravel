<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\historique\HistoriqueController;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class CategoryController extends Controller
{
    protected $user;
    /** @var HistoriqueController */
    protected $historiqueController;
    const CONTROLLER_NAME = 'Categorie';

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
        $this->authorize('index', Category::class);
        return Category::where('societe_id', '=', Auth::user()->societe_id)->orderBy('order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {

        $this->authorize('store', Category::class);
        $param = $request->all();
        $param['societe_id'] = Auth::user()->societe_id;
        $res = Category::create($param);

        if ($res) {
            $this->saveHistorique('store', $request->all());

            return response()->json(['data' => $res->format(), 'message' => 'Categorie cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Categorie'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $this->authorize('show', $category);
        return $category;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCreateRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $res = $category->update($request->all());

        if ($res) {
            $this->saveHistorique('update', $request->all());
            return response()->json(['data' => $category->format(), 'message' => 'Categorie cree avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec creation Categorie'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('destroy', $category);

        $res = $category->delete();
        if ($res) {
            $this->saveHistorique('destroy', $category->id);
            return response()->json(['message' => 'Categorie modifier avec succee'], 200);
        } else {
            return response()->json(['error' => 'Echec modification Categorie'], 400);
        }

    }

    private function saveHistorique($action, $action_contenu)
    {
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
