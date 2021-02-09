<?php

namespace App\Http\Controllers\delegation;

use App\Http\Controllers\Controller;
use App\Models\Delegation;
use Illuminate\Http\Request;

class DelegationSearchController extends Controller
{
    private $delegationRepository;

    public function __construct(DelegationRepository $delegationRepository)
    {
        $this->delegationRepository = $delegationRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Delegation
     */
    public function store(Request $request)
    {
        $delegations = $this->delegationRepository->searchWithCriteria($request->all());
        return $delegations;
    }

}
