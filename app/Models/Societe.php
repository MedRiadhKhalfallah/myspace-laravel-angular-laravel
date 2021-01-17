<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

/** @var array  */
    protected $fillable = [
        'nom',
        'adresse',
        'complement_adresse',
        'code_postal',
        'ville',
        'telephone_mobile',
        'telephone_fix',
        'numero_tva',
        'longitude',
        'latitude',
        'email',
        'image_societe_path',
        'image_societe_name',
        'image_coverture_path',
        'image_coverture_name',
        'site_web',
        'site_fb',
        'description'
    ];

    /**
     * @param $value
     * @return string
     */
    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setNomAttribute($value)
    {
        return $this->attributes['nom'] = strtolower($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageSocietePathAttribute($value)
    {
        return url('/') .config('front.STORAGE_URL'). '/societes_images/' . $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageCoverturePathAttribute($value)
    {
        return url('/') . config('front.STORAGE_URL').'/societes_covertures_images/' . $value;
    }

    /**
     * @param $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public static function isExiste($request)
    {
        if (Societe::where('email', '=', strtolower($request->email))->exists()) {
            return response()->json(['message' => 'Societe avec ce mail existe'], 403);
        }else{
            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * @return array
     */
    public function format()
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'adresse' => $this->adresse,
            'complement_adresse' => $this->complement_adresse,
            'code_postal' => $this->code_postal,
            'ville' => $this->ville,
            'email' => $this->email,
            'telephone_mobile' => $this->telephone_mobile,
            'telephone_fix' => $this->telephone_fix,
            'numero_tva' => $this->numero_tva,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'image_societe_path' => $this->image_societe_path,
            'image_societe_name' => $this->image_societe_name,
            'image_coverture_path' => $this->image_coverture_path,
            'image_coverture_name' => $this->image_coverture_name,
            'site_web' => $this->site_web,
            'site_fb' => $this->site_fb,
            'description' => $this->description,
            'type_abonnement' => $this->type_abonnement,
            'date_fin_abonnement' => $this->date_fin_abonnement,
        ];
    }
}