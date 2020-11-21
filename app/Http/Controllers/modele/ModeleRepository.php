<?php


namespace App\Http\Controllers\modele;


use App\Models\Modele;

class ModeleRepository
{
    public function searchWithCriteria($criteria)
    {
        $qr = Modele::orderBy('modeles.name');
//        return $criteria;
        if (isset($criteria['nom_marque'])) {
            $qr->join('marques', 'modeles.marque_id', '=','marques.id');
        }
        foreach ($criteria as $key => $value) {
            if ($value != null) {
                switch ($key) {
                    case 'nom':
                        $qr->where('modeles.name', 'like', '%' . $value . '%');
                        break;
                    case 'nom_marque':
                        $qr->where('marques.name', 'like', '%' . $value . '%');
                        break;
                }

            }
        }
        $qr->select('modeles.id','modeles.name','modeles.etat','modeles.marque_id');
//        var_dump($qr->get()); return true;
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
