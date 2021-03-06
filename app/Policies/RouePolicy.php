<?php

namespace App\Policies;

use App\Models\Roue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RouePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')){
            return true ;
        }
    }

    public function index(User $user, Roue $roue)
    {
        return $user->hasRole('admin');
    }

    public function store(User $user)
    {
        if ($user->societe_id) {
            return true;
        } else {
            return false;

        }
    }

    public function show(User $user, Roue $roue)
    {
        return true;
    }

    public function update(User $user, Roue $roue)
    {
        return $user->societe_id == $roue->societe_id && $user->hasRole('admin_societe');
    }

    public function destroy(User $user, Roue $roue)
    {
        return $user->hasRole('admin');
    }

}
