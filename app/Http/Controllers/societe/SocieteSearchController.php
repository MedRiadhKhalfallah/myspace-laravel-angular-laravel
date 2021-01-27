<?php

namespace App\Http\Controllers\societe;

use App\Http\Controllers\Controller;
use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteSearchController extends Controller
{
    private $societeRepository;

    public function __construct(SocieteRepository $societeRepository)
    {
        $this->societeRepository = $societeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Societe
     */
    public function store(Request $request)
    {
        $societes = $this->societeRepository->searchWithCriteria($request->all());
        return $societes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Societe
     */
    public function societeTopSearch(Request $request)
    {
        $societes = $this->societeRepository->societeTopSearch($request->all());
        return $societes;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Societe
     */
    public function societeMapSearch(Request $request)
    {
        $societes = $this->societeRepository->societeMapSearch($request->all());
        return $societes;
    }

}
