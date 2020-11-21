<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'etat', 'prix', 'adresse', 'sous_categorie_id', 'user_id', 'file3',
        'type_de_transaction',
        'chambres',
        'salles_de_bains',
        'superficie',
        'couleur_du_véhicule',
        'type_de_carrosserie',
        'etat_du_vehicule',
        'boite',
        'cylindree',
        'kilometrage',
        'annee',
        'marque',
        'modele',
        'carburant',
        'puissance_fiscale',
        'livraison',
        'prix_livraison',
        'modele_id',

    ];

//Mutators
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }

//accessors
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    //accessors
    public function getprixAttribute($value)
    {
        return number_format($value, 0, '', ' ');
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SousCategorie::class);
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }
/*    public function adresse()
    {
//        return $this->belongsTo(Adress::class);
        return "adresse";
    }*/

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format()
    {
//        return $this;
        return [
            'name' => $this->name,
            'etat' => $this->etat,
            'id' => $this->id,
            'description' => $this->description,
            'sousCategorie' => $this->sousCategorie,
            'categorie' => $this->sousCategorie->categorie,
            'modele' => $this->modele->format(),
            'marque' => $this->modele->marque,
            'user' => $this->user,
            'prix' => $this->prix,
//            'adresse' => $this->adresse,
            'type_de_transaction' => $this->type_de_transaction,
            'chambres' => $this->chambres,
            'salles_de_bains' => $this->salles_de_bains,
            'superficie' => $this->superficie,
            'couleur_du_véhicule' => $this->couleur_du_véhicule,
            'type_de_carrosserie' => $this->type_de_carrosserie,
            'etat_du_vehicule' => $this->etat_du_vehicule,
            'boite' => $this->boite,
            'cylindree' => $this->cylindree,
            'kilometrage' => $this->kilometrage,
            'annee' => $this->annee,
            'carburant' => $this->carburant,
            'puissance_fiscale' => $this->puissance_fiscale,
            'livraison' => $this->livraison,
            'prix_livraison' => $this->prix_livraison,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'images' => $this->images
        ];

    }

}
