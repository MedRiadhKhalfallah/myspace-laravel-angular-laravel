<?php

namespace App\Models;

use App\Modele;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Marque extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'selectedFile',
        'etat',
        'image_path',
        'image_name'
    ];

    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNomAttribute($value)
    {
        return $this->attributes['nom'] = strtolower($value);
    }

    public static function isExiste($request)
    {
        if (Marque::where('nom', '=', strtolower($request->nom))->exists()) {
           return response()->json(['message' => 'Marque existe'], 403);
        }else{
            return false;
        }
    }

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }

    public function format()
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'etat' => $this->etat,
            'image_path' => url('/').config('front.STORAGE_URL').'/marques_images/'.$this->image_path,
            'image_name' => $this->image_name
        ];

    }
}
