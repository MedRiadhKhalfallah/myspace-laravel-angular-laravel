<?php

namespace App\Http\Controllers\historique;

use App\Models\Societe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoriqueSearchController extends Controller
{
    private $historiqueRepository;

    public function __construct(HistoriqueRepository $historiqueRepository)
    {
        $this->historiqueRepository = $historiqueRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Societe
     */
    public function store(Request $request)
    {
        $param=$request->all();
        if(!Auth::user()->hasRole('admin')){
            $param['societe_id']=Auth::user()->societe_id;
        }
        $historiques = $this->historiqueRepository->searchWithCriteria($param);
        return $historiques;
    }

}
