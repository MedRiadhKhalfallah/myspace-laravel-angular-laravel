<?php


namespace App\Http\Controllers\marque;


use App\Models\Marque;

class MarqueRepository
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
        $qr = Marque::orderBy('id');
//        return $criteria;
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('name', 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        return $qr->offset($this->offset)->limit($this->limit)->get()
            ->map->format();
        /*        $marques = $qr->get()
                    ->map(function ($marque) {
                        return  $marque->format();
                    });*/

        /*        ->map(function ($marque){
                    return[
                        'marque_id'=>$marque->id,
                        'marque_name'=>$marque->name,
                        'modele_id'=>$marque->model->id,
                        'modele_nale'=>$marque->model->name
                    ];
                });*/

    }

    /*    protected function format($marque)
        {
            return [
                'marque_id' => $marque->id,
                'marque_name' => $marque->name
            ];

        }*/
}
