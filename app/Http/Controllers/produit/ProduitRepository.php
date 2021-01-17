<?php
namespace App\Http\Controllers\produit;

use App\Models\Produit;

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
        $qr = Produit::with('societe')->orderBy('id');
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
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
    }
}
