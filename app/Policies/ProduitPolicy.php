<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProduitPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function index(User $user, Produit $produit)
    {
        return ($user->hasRole('admin_societe') || $user->hasRole('admin'));
    }

    public function store(User $user)
    {
        if ($user->societe_id) {
            return true;
        } else {
            return false;

        }
    }

    public function show(User $user, Produit $produit)
    {
        return true;
    }

    public function update(User $user, Produit $produit)
    {
        $isadmin = $user->hasRole('admin');
//        $isadminSociete=$user->hasRole('admin_societe');
        $appartientSociete = $user->societe_id == $produit->societe_id;
        return $appartientSociete || $isadmin;
    }

    public function destroy(User $user, Produit $produit)
    {
        $isadmin = $user->hasRole('admin');
        $appartientSociete = $user->societe_id == $produit->societe_id;

        return $appartientSociete || $isadmin;
    }

}
