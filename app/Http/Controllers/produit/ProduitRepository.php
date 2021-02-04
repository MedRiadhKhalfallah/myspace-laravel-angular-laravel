<?php
namespace App\Http\Controllers\produit;

use App\Models\Produit;
use App\Models\Societe;
use Illuminate\Support\Facades\DB;

class ProduitRepository
{
    private $offset = 0;
    private $limit = 50;

    public function searchWithCriteria($criteria)
    {
        if (isset($criteria['offset'])) {
            $this->offset = $criteria['offset'];
        }
        if (isset($criteria['limit']) && $criteria['limit'] < 50) {
            $this->limit = $criteria['limit'];
        }

//        $qr = Produit::orderBy('nom');
        $qr = Produit::with('societe')->orderBy('id','DESC');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                    case 'reference':
                        $qr->where('reference', '=', $value);
                        break;
                    case 'societe_id':
                        $qr->where('societe_id', '=', $value);
                        break;
                    case 'etat_id':
                        $qr->where('etat_id', '=', $value);
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)
            ->get()
            ->map->format();
    }

    public function searchProduitsByEtat($criteria)
    {

        $qr = Produit::leftJoin('etats', 'etats.id', '=', 'produits.etat_id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'societe_id':
                        $qr->where('produits.societe_id', '=', $value);
                        break;
                }

            }
        }
        return $qr
            ->select(DB::raw('count(produits.id) as num_produit'),'etats.id','etats.nom','etats.order')
            ->groupBy('etats.nom','etats.order','etats.id')
            ->orderby('etats.order','DESC' )
            ->get();
    }
}
