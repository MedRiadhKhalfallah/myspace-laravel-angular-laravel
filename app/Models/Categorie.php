<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'etat', 'avatar'
    ];

    public function sousCategories()
    {
        return $this->hasMany(SousCategorie::class);
    }

}
