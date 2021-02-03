<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\Societe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Date;

class ProduitPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function index(User $user)
    {
        if ($user->hasRole('admin_societe') || $user->hasRole('admin')) {
            return true;
        } else {
            return $this->deny('Désolé, vous n\'avez pas le droit de faire cette action !', 403);
        }
    }

    public function store(User $user)
    {
        /** @var Societe $societe */
        $societe = $user->societe;
        $haveAbonnement = $societe->date_fin_abonnement > date("Y-m-d");
        if ($user->societe_id && $haveAbonnement) {
            return true;
        } else {
            return $this->deny('Désolé, vous n\'avez pas le droit de faire cette action ou votre abonnement a expiré !', 403);
        }
    }

    public function show(User $user, Produit $produit)
    {
        return true;
    }

    public function update(User $user, Produit $produit)
    {
        /** @var Societe $societe */
        $societe = $user->societe;
        $haveAbonnement = $societe->date_fin_abonnement > date("Y-m-d");

        $isadmin = $user->hasRole('admin');
//        $isadminSociete=$user->hasRole('admin_societe');
        $appartientSociete = $user->societe_id == $produit->societe_id;
        if (($appartientSociete && $haveAbonnement) || $isadmin) {
            return true;
        } else {
            return $this->deny('Désolé, vous n\'avez pas le droit de faire cette action ou votre abonnement a expiré !', 403);
        }
    }

    public function destroy(User $user, Produit $produit)
    {
        /** @var Societe $societe */
        $societe = $user->societe;
        $haveAbonnement = $societe->date_fin_abonnement > date("Y-m-d");

        $isadmin = $user->hasRole('admin');
        $appartientSociete = $user->societe_id == $produit->societe_id;

        if (($appartientSociete && $haveAbonnement) || $isadmin) {
            return true;
        } else {
            return $this->deny('Désolé, vous n\'avez pas le droit de faire cette action ou votre abonnement a expiré !', 403);
        }
    }

}
