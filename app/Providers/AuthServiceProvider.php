<?php

namespace App\Providers;

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
        'App\User' => 'App\Policies\UserPolicy',
        'App\Invoice' => 'App\Policies\InvoicePolicy',
        'App\Booking' => 'App\Policies\BookingPolicy',
        // 'App\CreditNote' => 'App\Policies\CreditNotePolicy',
        'App\NotificationLog' => 'App\Policies\NotificationLogPolicy',
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
