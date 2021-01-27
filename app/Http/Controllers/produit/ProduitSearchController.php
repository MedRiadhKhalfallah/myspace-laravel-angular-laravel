<?php

namespace App\Http\Controllers\produit;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitSearchController extends Controller
{
    private $produitRepository;

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Produit
     */
    public function store(Request $request)
    {
        $param=$request->all();
        if(!Auth::user()->societe_id){
            $param['societe_id']="n'a pas de societe";
        }else{
            $param['societe_id']=Auth::user()->societe_id;
        }

        if(Auth::user()->hasRole('admin')){
            $param['societe_id']=0;
        }
        $produits = $this->produitRepository->searchWithCriteria($param);
        return $produits;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Produit
     */
    public function getProduitsByEtat()
    {
        if(!Auth::user()->societe_id){
            $param['societe_id']="n'a pas de societe";
        }else{
            $param['societe_id']=Auth::user()->societe_id;
        }

        if(Auth::user()->hasRole('admin')){
            $param['societe_id']=0;
        }
        $produits = $this->produitRepository->searchProduitsByEtat($param);
        return $produits;
    }

}
