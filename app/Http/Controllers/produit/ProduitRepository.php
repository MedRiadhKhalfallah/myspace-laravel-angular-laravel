<?php


namespace App\Http\Controllers\produit;


use App\Models\Produit;

class ProduitRepository
{
    public function searchWithCriteria($criteria)
    {
        $qr = Produit::orderBy('name');
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
        /*        $produits = $qr->get()
                    ->map(function ($produit) {
                        return  $produit->format();
                    });*/

        /*        ->map(function ($produit){
                    return[
                        'produit_id'=>$produit->id,
                        'produit_name'=>$produit->name,
                        'modele_id'=>$produit->model->id,
                        'modele_nale'=>$produit->model->name
                    ];
                });*/

    }

    /*    protected function format($produit)
        {
            return [
                'produit_id' => $produit->id,
                'produit_name' => $produit->name
            ];

        }*/
}
