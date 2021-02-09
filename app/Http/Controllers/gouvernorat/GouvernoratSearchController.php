<?php

namespace App\Http\Controllers\gouvernorat;

use App\Http\Controllers\Controller;
use App\Models\Gouvernorat;
use Illuminate\Http\Request;

class GouvernoratSearchController extends Controller
{
    private $gouvernoratRepository;

    public function __construct(GouvernoratRepository $gouvernoratRepository)
    {
        $this->gouvernoratRepository = $gouvernoratRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Gouvernorat
     */
    public function store(Request $request)
    {
        $gouvernorats = $this->gouvernoratRepository->searchWithCriteria($request->all());
        return $gouvernorats;
    }

}
