<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientSearchController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Client
     */
    public function store(Request $request)
    {
        $clients = $this->clientRepository->searchWithCriteria($request->all());
        return $clients;
    }

}
