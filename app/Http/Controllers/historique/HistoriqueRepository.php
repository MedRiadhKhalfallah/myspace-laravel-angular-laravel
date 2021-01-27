<?php
namespace App\Http\Controllers\historique;

use App\Models\Historique;

class HistoriqueRepository
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

        $qr = Historique::orderBy('created_at','DESC');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'societe_nom':
                        $qr->where('societe_nom', 'like', '%' . $value . '%');
                        break;
                    case 'societe_id':
                        $qr->where('societe_id', '=',  $value );
                        break;
                    case 'user_id':
                        $qr->where('user_id', '=',  $value);
                        break;
                    case 'user_nom':
                        $qr->where('user_nom', 'like', '%' . $value . '%');
                        break;
                    case 'controller':
                        $qr->where('controller', 'like', '%' . $value . '%');
                        break;
                    case 'action':
                        $qr->where('action', 'like', '%' . $value . '%');
                        break;
                    case 'action_contenu':
                        $qr->where('action_contenu', 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()->map->format();
    }
}
