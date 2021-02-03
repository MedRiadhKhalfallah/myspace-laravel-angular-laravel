<?php

namespace App\Providers;

use App\Http\Controllers\typeActivite\TypeActiviteController;
use App\Models\Etat;
use App\Models\Historique;
use App\Models\Produit;
use App\Models\Societe;
use App\Models\User;
use App\Policies\EtatPolicy;
use App\Policies\HistoriquePolicy;
use App\Policies\ProduitPolicy;
use App\Policies\SocietePolicy;
use App\Policies\TypeActivitePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Societe::class => SocietePolicy::class,
        Produit::class => ProduitPolicy::class,
        Etat::class => EtatPolicy::class,
        Historique::class => HistoriquePolicy::class,
        TypeActiviteController::class => TypeActivitePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
