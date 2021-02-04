<?php

namespace App\Policies;

use App\Models\Reclamation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReclamationPolicy
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

    public function show(User $user)
    {
        return true;
    }

    public function update(User $user)
    {
        $isadmin = $user->hasRole('admin');
        return  $isadmin;
    }

    public function destroy(User $user, Reclamation $reclamation)
    {
        $appartientSociete= $user->societe_id == $reclamation->societe_id;
        $isadmin = $user->hasRole('admin');
        return ($isadmin || $appartientSociete);
    }

}
