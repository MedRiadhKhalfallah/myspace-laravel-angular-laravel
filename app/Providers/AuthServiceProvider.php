<?php

namespace App\Providers;

use App\Models\Produit;
use App\Models\Societe;
use App\Models\User;
use App\Policies\ProduitPolicy;
use App\Policies\SocietePolicy;
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
