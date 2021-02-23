<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewProduit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'description',
        'quantite',
        'seuil_min',
        'prix',
        'societe_id',
        'sous_category_id',
        'modele_id',
        'image_name',
        'image_path',
        'selectedFile',
        'reference',
        'paiement_facilite_3_mois',
        'paiement_facilite_6_mois',
        'paiement_facilite_12_mois',
        'prix_achat',
        'prix_sold',
        'url_externe',
        'etat_produit',
        'etat'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getImagePathAttribute($value)
    {
        return url('/') . config('front.STORAGE_URL') . '/new_produits_images/' . $value;
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function sousCategory()
    {
        return $this->belongsTo(SousCategory::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function getTitreAttribute($value)
    {
        return ucfirst($value);
    }

    public function setTitreAttribute($value)
    {
        return $this->attributes['titre'] = strtolower($value);
    }

    public function format()
    {
        return [
            'titre' => $this->titre,
            'description' => $this->description,
            'quantite' => $this->quantite,
            'seuil_min' => $this->seuil_min,
            'prix' => $this->prix,
            'societe' => $this->societe,
            'societe_id' => $this->societe->id,
            'sous_category' => $this->sousCategory,
            'sous_category_id' => $this->sousCategory->id,
            'modele_id' => $this->modele->id,
            'modele' => $this->modele,
            'id' => $this->id,
            'image_name' => $this->image_name,
            'image_path' => $this->image_path,
            'reference'=> $this->reference,
            'paiement_facilite_3_mois'=> $this->paiement_facilite_3_mois,
            'paiement_facilite_6_mois'=> $this->paiement_facilite_6_mois,
            'paiement_facilite_12_mois'=> $this->paiement_facilite_12_mois,
            'prix_achat'=> $this->prix_achat,
            'prix_sold'=> $this->prix_sold,
            'url_externe'=> $this->url_externe,
            'etat_produit'=> $this->etat_produit,
            'etat'=> $this->etat

        ];

    }
    public function formatFromSociete()
    {
        return [
            'titre' => $this->titre,
            'description' => $this->description,
            'quantite' => $this->quantite,
            'prix' => $this->prix,
            'modele' => $this->modele->format(),
            'id' => $this->id,
            'image_name' => $this->image_name,
            'image_path' => $this->image_path,
            'reference'=> $this->reference,
            'paiement_facilite_3_mois'=> $this->paiement_facilite_3_mois,
            'paiement_facilite_6_mois'=> $this->paiement_facilite_6_mois,
            'paiement_facilite_12_mois'=> $this->paiement_facilite_12_mois,
            'prix_achat'=> $this->prix_achat,
            'prix_sold'=> $this->prix_sold,
            'url_externe'=> $this->url_externe,
            'etat_produit'=> $this->etat_produit,
            'etat'=> $this->etat
        ];

    }
}