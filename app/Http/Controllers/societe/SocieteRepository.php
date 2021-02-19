<?php
namespace App\Http\Controllers\societe;

use App\Models\Produit;
use App\Models\Societe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocieteRepository
{
    private $offset = 0;
    private $limit = 50;

    public function searchWithCriteria($criteria)
    {
        if (!Auth::user()->hasRole('admin')){
            $criteria['date_fin_abonnement']=date('y-m-d');
        }

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
                    case 'date_fin_abonnement':
                        $qr->where('date_fin_abonnement', '>', $value );
                        break;
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

        $criteria['date_fin_abonnement']=date('y-m-d');
        $qr = Societe::leftJoin('produits', 'produits.societe_id', '=', 'societes.id');

        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'date_fin_abonnement':
                        $qr->where('societes.date_fin_abonnement', '>', $value );
                        break;

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
                    case 'email':
                        $qr->where('email', 'like', '%' . $value . '%');
                        break;
                    case 'reference':
                        $qr->where('reference', 'like', '%' . $value . '%');
                        break;
                    case 'delegation_id':
                        $qr->where('delegation_id', '=', $value);
                        break;
                    case 'gouvernorat_id':
                        $qr->where('gouvernorat_id', '=', $value);
                        break;
                    case 'telephone_fix':
                        $qr->where('telephone_fix', '=', $value);
                        break;
                    case 'telephone_mobile':
                        $qr->where('telephone_mobile', '=', $value);
                        break;
                    case 'type_activite_id':
                        $qr->where('type_activite_id', '=', $value);
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
