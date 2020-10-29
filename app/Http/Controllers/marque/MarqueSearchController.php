<?php

namespace App\Http\Controllers\marque;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarqueCreateRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueSearchController extends Controller
{
    private $marqueRepository;

    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarqueCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
//        var_dump($request);die;
//        return $request->all();
//        return json_decode($request->all());
        $marques = $this->marqueRepository->searchWithCriteria($request->all());
        return $marques;
    }

}
