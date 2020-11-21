<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'path', 'etat', 'produit_id'
    ];


    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

}
