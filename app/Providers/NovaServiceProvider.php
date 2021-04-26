<?php

namespace App\Providers;

use App\Nova\BlogPost;
use App\Nova\Booking;
use App\Nova\BookingMIssingPPS;
use App\Nova\Company;
use App\Nova\Course;
use App\Nova\CourseType;
use App\Nova\CourseTypeGroup;
use App\Nova\Invoice;
use App\Nova\Metrics\NewBookings;
use App\Nova\Metrics\NewCandidates;
use App\Nova\NotificationLog;
use App\Nova\Payment;
use App\Nova\Tutor;
use App\Nova\UnpaidInvoice;
use App\Nova\User;
use App\Nova\Venue;
use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Itainathaniel\NovaNexmo\NovaNexmoCard;
use Itainathaniel\NovaNexmo\NovaNexmoTool;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

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
        Nova::routes()->withAuthenticationRoutes()->withPasswordResetRoutes()->register();
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
                'alec@citltd.ie',
                'hank@citltd.ie',
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
            new CollapsibleResourceManager([
                'disable_default_resource_manager' => true, // default
                'remember_menu_state' => false, // default
                'navigation' => [
                    TopLevelResource::make([
                        'label' => 'Customers',
                        'resources' => [
                            Booking::class,
                            NotificationLog::class,
                            BookingMIssingPPS::class,
                            Company::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Resources',
                        'resources' => [
                            Course::class,
                            Venue::class,
                            Tutor::class,
                            BlogPost::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Accounting',
                        'resources' => [
                            Payment::class,
                            Invoice::class,
                            UnpaidInvoice::class,
                        ]
                    ]),
                    TopLevelResource::make([
                        'label' => 'Settings',
                        'resources' => [
                            CourseType::class,
                            CourseTypeGroup::class,
                            User::class,
                        ]
                    ]),
                ]
            ])
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
