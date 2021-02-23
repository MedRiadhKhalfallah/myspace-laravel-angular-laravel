<?php

namespace App\Policies;

use App\Models\RoueElement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoueElementPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')){
            return true ;
        }
    }

    public function index(User $user, RoueElement $roueElement)
    {
        return $user->hasRole('admin_societe');
    }

    public function store(User $user)
    {
        return !$user->societe_id;
    }

    public function show(User $user, RoueElement $roueElement)
    {
        return true;
    }

    public function update(User $user, RoueElement $roueElement)
    {
        return  $user->hasRole('admin_societe');
    }

    public function destroy(User $user, RoueElement $roueElement)
    {
        return $user->hasRole('admin');
    }

}
