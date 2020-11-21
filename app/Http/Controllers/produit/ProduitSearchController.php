<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProduitCreateRequest;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitSearchController extends Controller
{
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProduitCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $produits = $this->produitRepository->searchWithCriteria($request->all());
        return $produits;
    }

}
