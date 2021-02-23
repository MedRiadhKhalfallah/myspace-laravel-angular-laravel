<?php


namespace App\Http\Controllers\newProduit;


use App\Models\NewProduit;

class NewProduitRepository
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
        $qr = NewProduit::orderBy('id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'titre':
                        $qr->where('titre', 'like', '%' . $value . '%');
                        break;
                    case 'sousCategory_id':
                        $qr->where('sous_category_id', '=', $value);
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();

    }

}