<?php

namespace App\Http\Controllers\roueElement;

use App\Models\RoueElement;
use App\Models\Roue;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class RoueElementRepository
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
        $qr = RoueElement::orderBy('id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
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
