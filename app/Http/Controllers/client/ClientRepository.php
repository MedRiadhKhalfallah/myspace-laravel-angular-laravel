<?php

namespace App\Http\Controllers\client;

use App\Models\Client;
use App\Models\Roue;
use App\Models\RoueElement;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

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

        $roue = Roue::where('societe_id', '=', Auth::user()->societe_id)->first();
        $criteria['roue_id'] = $roue->id;
        /** @var Builder $qr */
        $qr = Client::orderBy('nom');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                    case 'value':
                        $qr->where(function ($query) use ($value) {
                            $query->where('value1', '=', $value)
                                ->orWhere('value2', '=', $value);
                        });
                        break;
                    case 'num_tel':
                        $qr->where('num_tel', '=', $value);
                        break;
                    case 'roue_id':
                        $qr->where('roue_id', '=', $value);
                        break;

                }

            }
        }
        return $qr->get()->map->format();
        /*        return $qr->offset($this->offset)->limit($this->limit)->get()
                    ->map->format();*/
    }
}
