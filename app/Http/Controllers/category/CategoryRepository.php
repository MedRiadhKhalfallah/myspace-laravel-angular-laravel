<?php


namespace App\Http\Controllers\category;


use App\Models\Category;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class CategoryRepository
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
        $criteria['societe_id']=Auth::user()->societe_id;
        /** @var Builder $qr */
        $qr = Category::orderBy('id');
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('nom', 'like', '%' . $value . '%');
                        break;
                    case 'societe_id':
                        $qr->where('societe_id', '=',$value);
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
    }
}
