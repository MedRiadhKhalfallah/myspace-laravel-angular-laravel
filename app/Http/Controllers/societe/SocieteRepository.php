<?php
namespace App\Http\Controllers\societe;

use App\Models\Societe;

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
}
