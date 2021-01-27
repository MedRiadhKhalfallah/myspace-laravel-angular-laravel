<?php

namespace App\Policies;

use App\Models\Historique;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoriquePolicy
{
    use HandlesAuthorization;

    public function index(User $user, Historique $historique)
    {
        return  $user->hasRole('admin');
    }

    public function getSocieteHistorique(User $user, Historique $historique)
    {
        return ($user->hasRole('admin_societe') || $user->hasRole('admin'));
    }

}
