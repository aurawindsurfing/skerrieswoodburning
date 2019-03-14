<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Cards\Help;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Metrics\NewCandidates;
use App\Nova\Metrics\NewBookings;
use App\Nova\Booking;
use App\Nova\Metrics\CoursesPerTutor;
use Itainathaniel\NovaNexmo\NovaNexmoTool;
use Itainathaniel\NovaNexmo\NovaNexmoCard;
use PeterBrinck\NovaLaravelNews\NovaLaravelNews;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'tomcentrumpl@gmail.com',
                'alec@citltd.ie'
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new NewBookings,
            (new \Richardkeep\NovaTimenow\NovaTimenow)->width('2/3'),
            // (new \Llaski\NovaScheduledJobs\NovaScheduledJobsCard)->width('full'),
            // (new NovaLaravelNews)->width('full'),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
