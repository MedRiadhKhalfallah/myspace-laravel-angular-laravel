<?php
namespace App\Http\Controllers\client;

use App\Models\Client;

class ClientRepository
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

        $qr = Client::orderBy('nom');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                    case 'value1':
                        $qr->where('value1', '=', $value);
                        break;
                    case 'value2':
                        $qr->where('value2', '=', $value);
                        break;
                    case 'num_tel':
                        $qr->where('num_tel', '=', $value);
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
    }
}
