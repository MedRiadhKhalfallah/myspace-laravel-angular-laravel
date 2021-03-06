<?php


namespace App\Http\Controllers\marque;


use App\Models\Marque;

class MarqueRepository
{
    public function searchWithCriteria($criteria)
    {
        $qr = Marque::orderBy('name');
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
        return $qr->get()
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
