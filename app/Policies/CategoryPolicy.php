<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
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

    public function show(User $user, Category $category)
    {
        return true;
    }

    public function update(User $user, Category $category)
    {
        $isadmin = $user->hasRole('admin');
        $appartientSociete = $user->societe_id == $category->societe_id;
        return $appartientSociete || $isadmin;
    }

    public function destroy(User $user, Category $category)
    {
        $isadmin = $user->hasRole('admin');
        $appartientSociete = $user->societe_id == $category->societe_id;
        return $appartientSociete || $isadmin;
    }
}
