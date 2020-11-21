<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use \App\Models\Marque;

class Modele extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'etat',
        'marque_id'
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

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
        if (Modele::where('name', '=', strtolower($request->name))->exists()) {
           return response()->json(['message' => 'Modele existe'], 403);
        }else{
            return false;
        }
    }

    public function format()
    {
//        return $this;
        return [
            'marque' => $this->marque,
            'modele_id' => $this->id,
            'modele_name' => $this->name,
            'etat' => $this->etat
        ];

    }
}
