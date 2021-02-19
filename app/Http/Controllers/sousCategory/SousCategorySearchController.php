<?php

namespace App\Http\Controllers\sousCategory;

use App\Http\Controllers\Controller;
use App\Http\Controllers\sousCategory\SousCategoryRepository;
use App\Http\Requests\SousCategoryCreateRequest;
use Illuminate\Http\Request;

class SousCategorySearchController extends Controller
{
    private $sousCategoryRepository;

    public function __construct(SousCategoryRepository $sousCategoryRepository)
    {
        $this->sousCategoryRepository = $sousCategoryRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SousCategorieCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
        $sousCategories = $this->sousCategoryRepository->searchWithCriteria($request->all());
        return $sousCategories;
    }

}
