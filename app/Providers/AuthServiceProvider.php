<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\User::class => \App\Policies\UserPolicy::class,
        \App\Invoice::class => \App\Policies\InvoicePolicy::class,
        \App\Booking::class => \App\Policies\BookingPolicy::class,
        // 'App\CreditNote' => 'App\Policies\CreditNotePolicy',
        \App\NotificationLog::class => \App\Policies\NotificationLogPolicy::class,
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
