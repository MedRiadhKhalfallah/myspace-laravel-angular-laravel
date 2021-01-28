<?php

namespace App\Policies;

use App\Models\Societe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocietePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')){
            return true ;
        }
    }

    public function index(User $user, Societe $societe)
    {
        return $user->hasRole('admin');
    }

    public function store(User $user)
    {
        return !$user->societe_id;
    }

    public function show(User $user, Societe $societe)
    {
        return true;
    }

    public function update(User $user, Societe $societe)
    {
        return $user->societe_id == $societe->id && $user->hasRole('admin_societe');
    }

    public function destroy(User $user, Societe $societe)
    {
        return $user->hasRole('admin');
    }

    public function updateCovertureImage(User $user, Societe $societe)
    {
        return $user->societe_id == $societe->id && $user->hasRole('admin_societe');
    }

    public function updateSocieteImage(User $user, Societe $societe)
    {
        return $user->societe_id == $societe->id && $user->hasRole('admin_societe');
    }


}
