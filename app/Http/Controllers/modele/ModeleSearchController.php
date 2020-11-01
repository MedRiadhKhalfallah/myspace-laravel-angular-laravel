<?php

namespace App\Http\Controllers\modele;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModeleCreateRequest;
use Illuminate\Http\Request;

class ModeleSearchController extends Controller
{
    private $modeleRepository;

    public function __construct(ModeleRepository $modeleRepository)
    {
        $this->modeleRepository = $modeleRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModeleCreateRequest $request
     * @return Illuminate\Http\Request
     */
    public function store(Request $request)
    {
//        var_dump($request);die;
//        return $request->all();
//        return json_decode($request->all());
        $modeles = $this->modeleRepository->searchWithCriteria($request->all());
        return $modeles;
    }

}
