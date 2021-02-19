<?php

namespace App\Http\Controllers\newProduit;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewProduitCreateRequest;
use Illuminate\Http\Request;

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

}
