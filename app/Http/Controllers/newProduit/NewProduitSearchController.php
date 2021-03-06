<?php

namespace App\Http\Controllers\newProduit;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewProduitCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewProduitSearchController extends Controller
{
    private $newProduitRepository;

    public function __construct(NewProduitRepository $newProduitRepository)
    {
        $this->newProduitRepository = $newProduitRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewProduitCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $newProduits = $this->newProduitRepository->searchWithCriteria($request->all());
        return $newProduits;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param NewProduitCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function newProduitSocieteSearch(Request $request)
    {
        $param=$request->all();
        $param['societe_id']=Auth::user()->societe_id;
        $newProduits = $this->newProduitRepository->searchWithCriteria($param);
        return $newProduits;
    }

}
