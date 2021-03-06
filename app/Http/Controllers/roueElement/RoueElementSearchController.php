<?php

namespace App\Http\Controllers\roueElement;

use App\Http\Controllers\Controller;
use App\Models\RoueElement;
use Illuminate\Http\Request;

class RoueElementSearchController extends Controller
{
    private $roueElementRepository;

    public function __construct(RoueElementRepository $roueElementRepository)
    {
        $this->roueElementRepository = $roueElementRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RoueElement
     */
    public function store(Request $request)
    {
        $roueElements = $this->roueElementRepository->searchWithCriteria($request->all());
        return $roueElements;
    }

}
