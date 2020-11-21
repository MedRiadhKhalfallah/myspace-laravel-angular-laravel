<?php

namespace App\Http\Controllers\categorie;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Http\Requests\CategorieCreateRequest;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorieCreateRequest $request)
    {
        $res = Categorie::create($request->all());
        if ($res) {
            return redirect(route('admin.categories.index'))->with('messageSuccess', 'creation avec ucc');
        } else {
            return redirect()->back()->with('messageEchec', 'creation avec echec');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Categorie $category
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $category)
    {
        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Categorie $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $category)
    {
        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategorieCreateRequest $request, Categorie $category)
    {
        $res = $category->update($request->all());
        if ($res) {
            return redirect(route('admin.categories.index'))->with('messageSuccess', 'Update with succ');
        } else {
            return redirect()->back()->with('messageEchec', 'Update echec');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Categorie $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        // delete foreign entity
        $category->sousCategories->each->delete();

        $res = $category->delete();
        if ($res) {
            return redirect(route('admin.categories.index'))->with('messageSuccess', 'delete success');
        } else {
            return redirect()->back()->with('messageEchec', 'delete echec');
        }

    }
}
