<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Etat;
use App\Models\Historique;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\NewProduit;
use App\Models\Produit;
use App\Models\Reclamation;
use App\Models\Roue;
use App\Models\RoueElement;
use App\Models\Societe;
use App\Models\SousCategory;
use App\Models\TypeActivite;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\EtatPolicy;
use App\Policies\HistoriquePolicy;
use App\Policies\MarquePolicy;
use App\Policies\ModelePolicy;
use App\Policies\NewProduitPolicy;
use App\Policies\ProduitPolicy;
use App\Policies\ReclamationPolicy;
use App\Policies\RoueElementPolicy;
use App\Policies\RouePolicy;
use App\Policies\SocietePolicy;
use App\Policies\SousCategoryPolicy;
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
        TypeActivite::class => TypeActivitePolicy::class,
        Reclamation::class => ReclamationPolicy::class,
        Category::class => CategoryPolicy::class,
        SousCategory::class => SousCategoryPolicy::class,
        Marque::class => MarquePolicy::class,
        Modele::class => ModelePolicy::class,
        NewProduit::class => NewProduitPolicy::class,
        Roue::class => RouePolicy::class,
        RoueElement::class => RoueElementPolicy::class
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
