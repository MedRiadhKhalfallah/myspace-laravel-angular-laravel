<?php

namespace App\Policies;

use App\Models\TypeActivite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeActivitePolicy
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
        return true;
    }

    public function store(User $user)
    {
        return $user->hasRole('admin');
    }

    public function show(User $user, TypeActivite $typeActivite)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, TypeActivite $typeActivite)
    {
        return $user->hasRole('admin');
    }

    public function destroy(User $user, TypeActivite $typeActivite)
    {
        return $user->hasRole('admin');
    }

}
