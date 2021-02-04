<?php
namespace App\Http\Controllers\societe;

use App\Models\Produit;
use App\Models\Societe;
use Illuminate\Support\Facades\DB;

class SocieteRepository
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

        $qr = Societe::orderBy('nom');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
    }

    public function societeTopSearch($criteria){

        $qr = Societe::leftJoin('produits', 'produits.societe_id', '=', 'societes.id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'date_top':
                        $qr->where('produits.created_at', '>=', $value);
                        break;
                }

            }
        }
        return $qr->limit($criteria['top'])
            ->select('societes.id','societes.nom','societes.image_societe_path', DB::raw('count(produits.id) as num_produit'))
            ->groupBy('societes.id','societes.nom','societes.image_societe_path')
            ->orderby('num_produit','DESC' )
            ->get();

    }

    public function societeMapSearch($criteria){

        $qr = Societe::orderBy('nom');
        $criteria['date_fin_abonnement']=date('y-m-d');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                    case 'date_fin_abonnement':
                        $qr->where('date_fin_abonnement', '>', $value );
                        break;
                }
            }
        }
        return $qr->get()
            ->map->formatMap();

    }
}
