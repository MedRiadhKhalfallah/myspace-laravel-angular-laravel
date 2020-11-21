<?php

namespace App\Http\Controllers\sousCategorie;

use App\Models\Categorie;
use App\Http\Requests\SousCategorieCreateRequest;
use App\Models\SousCategorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SousCategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sousCategories = SousCategorie::all();
        return view('admin.sousCategories.index', compact('sousCategories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Categorie::all();
        return view('admin.sousCategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SousCategorieCreateRequest $request)
    {
        $res = SousCategorie::create($request->all());
        if ($res) {
            return redirect(route('admin.sousCategories.index'))->with('messageSuccess', 'creation avec ucc');
        } else {
            return redirect(route('admin.sousCategories.index'))->with('messageEchec', 'creation avec echec');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  SousCategorie  $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SousCategorie $sousCategory)
    {
        return view('admin.sousCategories.show', compact('sousCategory'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SousCategorie $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SousCategorie $sousCategory)
    {
        $categories=Categorie::all();
        return view('admin.sousCategories.edit', compact('sousCategory'),compact('categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  SousCategorie $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function update(SousCategorieCreateRequest $request, SousCategorie $sousCategory)
    {
        $res = $sousCategory->update($request->all());
        if ($res) {
            return redirect(route('admin.sousCategories.index'))->with('messageSuccess', 'Update with succ');
        } else {
            return redirect()->back()->with('messageEchec', 'Update echec');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SousCategorie $sousCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SousCategorie $sousCategory)
    {
        // delete foreign entity
        $sousCategory->produits->each->delete();


        $res = $sousCategory->delete();
        if ($res) {
            return redirect(route('admin.sousCategories.index'))->with('messageSuccess', 'delete success');
        } else {
            return redirect()->back()->with('messageEchec', 'delete echec');
        }

    }
}
