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
        'name',
        'selectedFile',
        'etat',
        'image_path',
        'image_name'
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = strtolower($value);
    }

    public static function isExiste($request)
    {
        if (Marque::where('name', '=', strtolower($request->name))->exists()) {
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
            'marque_id' => $this->id,
            'marque_name' => $this->name,
            'etat' => $this->etat,
            'image_path' => url('/').config('front.STORAGE_URL').'/marques_images/'.$this->image_path,
            'image_name' => $this->image_name
        ];

    }
}
