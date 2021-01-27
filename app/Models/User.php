<?php

namespace App\Models;

use http\Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'image_profile_path',
        'image_profile_name',
        'image_coverture_path',
        'image_coverture_name',
        'etat',
        'username',
        'site_web',
        'site_fb',
        'sex',
        'description',
        'date_de_naissance',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /*    public function roles()
        {
            return $this->belongsToMany(Role::class);
        }*/
    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', '=', $role)->first()) {
            return true;
        } else {
            return false;
        }
    }

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
    public function getPrenomAttribute($value)
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
    public function setPrenomAttribute($value)
    {
        return $this->attributes['prenom'] = strtolower($value);
    }

    /**
     * @param $user
     * @throws \Exception
     */
    public function isExiste($user)
    {
        if (User::where('email', '=', Input::get('email'))->exists()) {
            throw new \Exception('Utilisateur exixte', 403);
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageProfilePathAttribute($value)
    {
        return url('/') . config('front.STORAGE_URL') . '/profiles_images/' . $value;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageCoverturePathAttribute($value)
    {
        return url('/') . config('front.STORAGE_URL') . '/covertures_images/' . $value;
    }

    /**
     * @return array
     */
    public function format()
    {
        return $this->jsonSerialize();

    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @return mixed
     */
    public function getSocieteId()
    {
        return $this->societe_id;
    }

    /**
     * @return mixed
     */
    public function getSocieteNom()
    {
        $societe = Societe::where('id', '=', $this->societe_id)->first();
        if ($societe){
            return $societe->getNom();
        }else{
            return "";
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

}
