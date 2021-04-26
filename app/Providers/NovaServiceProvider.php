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
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="credit-card" class="svg-inline--fa fa-credit-card fa-w-18" role="img" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Resources',
                        'resources' => [
                            Course::class,
                            Venue::class,
                            Tutor::class,
                            BlogPost::class,
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="clipboard-list" class="svg-inline--fa fa-clipboard-list fa-w-12" role="img" viewBox="0 0 384 512"><path fill="currentColor" d="M280 240H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0 96H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM112 232c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zM336 64h-88.6c.4-2.6.6-5.3.6-8 0-30.9-25.1-56-56-56s-56 25.1-56 56c0 2.7.2 5.4.6 8H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 32c13.3 0 24 10.7 24 24s-10.7 24-24 24-24-10.7-24-24 10.7-24 24-24zm160 432c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16h48v20c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12V96h48c8.8 0 16 7.2 16 16v352z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Accounting',
                        'resources' => [
                            Payment::class,
                            Invoice::class,
                            UnpaidInvoice::class,
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="calculator" class="svg-inline--fa fa-calculator fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M80 448h288c8.84 0 16-7.16 16-16V240c0-8.84-7.16-16-16-16H80c-8.84 0-16 7.16-16 16v192c0 8.84 7.16 16 16 16zm208-96v-96h64v160h-64v-64zm-96-96h64v64h-64v-64zm0 96h64v64h-64v-64zm-96-96h64v64H96v-64zm0 96h64v64H96v-64zM400 0H48C22.4 0 0 22.4 0 48v416c0 25.6 22.4 48 48 48h352c25.6 0 48-22.4 48-48V48c0-25.6-22.4-48-48-48zm16 464c0 7.93-8.07 16-16 16H48c-7.93 0-16-8.07-16-16V192h384v272zm0-304H32V48c0-7.93 8.07-16 16-16h352c7.93 0 16 8.07 16 16v112z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Settings',
                        'resources' => [
                            CourseType::class,
                            CourseTypeGroup::class,
                            User::class,
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="users-cog" class="svg-inline--fa fa-users-cog fa-w-20" role="img" viewBox="0 0 640 512"><path fill="currentColor" d="M287.4 250.6c2.9-10.4 6.5-20.4 10.9-30-33.6-9.5-58.4-40.1-58.4-76.7 0-44.1 35.9-80 80-80 36.6 0 67.1 24.8 76.7 58.4 9.6-4.4 19.6-8.1 30-10.9C412.6 65.6 370.4 32 320 32c-61.9 0-112 50.1-112 112 0 50.4 33.6 92.6 79.4 106.6zM96 224c44.2 0 80-35.8 80-80s-35.8-80-80-80-80 35.8-80 80 35.8 80 80 80zm0-128c26.5 0 48 21.5 48 48s-21.5 48-48 48-48-21.5-48-48 21.5-48 48-48zm61.1 172.9c-11.9-8.1-26-12.9-41.1-12.9H76c-41.9 0-76 35.9-76 80 0 8.8 7.2 16 16 16s16-7.2 16-16c0-26.5 19.8-48 44-48h40c5.5 0 10.8 1.2 15.7 3.3 7.5-8.5 16.1-16 25.4-22.4zM176 448c-8.8 0-16-7.2-16-16v-44.8c0-16.6 4.9-32.7 14.1-46.4 13.8-20.5 38.4-32.8 65.7-32.8 14.3 0 18.8 2.4 40.7 7.2-.2-3.8-1.4-13.4.6-32.6-16.3-4.3-26.4-6.6-41.3-6.6-36.3 0-71.6 16.2-92.3 46.9-12.4 18.4-19.6 40.5-19.6 64.3V432c0 26.5 21.5 48 48 48h209c-16-8.6-30.6-19.5-43.5-32H176zm304-208.5c-35.6 0-64.5 29-64.5 64.5s28.9 64.5 64.5 64.5 64.5-29 64.5-64.5-28.9-64.5-64.5-64.5zm0 97c-17.9 0-32.5-14.6-32.5-32.5s14.6-32.5 32.5-32.5 32.5 14.6 32.5 32.5-14.6 32.5-32.5 32.5zm148.3-10.2l-16.5-9.5c.8-8.5.8-17.1 0-25.6l16.6-9.5c9.5-5.5 13.8-16.7 10.5-27-7.2-23.4-19.9-45.4-36.7-63.5-7.4-8.1-19.3-9.9-28.8-4.4l-16.5 9.5c-7-5-14.4-9.3-22.2-12.8v-19c0-11-7.5-20.3-18.2-22.7-23.9-5.4-49.3-5.4-73.3 0-10.7 2.4-18.2 11.8-18.2 22.7v19c-7.8 3.5-15.3 7.8-22.2 12.8l-16.5-9.5c-9.5-5.5-21.3-3.7-28.7 4.4-16.8 18.1-29.4 40.1-36.7 63.4-3.3 10.4 1.2 21.8 10.6 27.2l16.5 9.5c-.8 8.5-.8 17.1 0 25.6l-16.6 9.5c-9.3 5.4-13.8 16.9-10.5 27.1 7.3 23.4 19.9 45.4 36.7 63.5 7.4 8 19.2 9.8 28.8 4.4l16.5-9.5c7 5 14.4 9.3 22.2 12.8v19c0 11 7.5 20.3 18.2 22.7 12 2.7 24.3 4 36.6 4s24.7-1.3 36.6-4c10.7-2.4 18.2-11.8 18.2-22.7v-19c7.8-3.5 15.2-7.8 22.2-12.8l16.5 9.5c9.4 5.4 21.3 3.6 28.7-4.4 16.8-18.1 29.4-40.1 36.7-63.4 3.4-10.4-1.1-21.9-10.5-27.3zm-51.6 7.2l29.4 17c-5.3 14.3-13 27.8-22.8 39.5l-29.4-17c-21.4 18.3-24.5 20.1-51.1 29.5v34c-15.1 2.6-30.6 2.6-45.6 0v-34c-26.9-9.5-30.2-11.7-51.1-29.5l-29.4 17c-9.8-11.8-17.6-25.2-22.8-39.5l29.4-17c-4.9-26.8-5.2-30.6 0-59l-29.4-17c5.2-14.3 13-27.7 22.8-39.5l29.4 17c21.4-18.3 24.5-20.1 51.1-29.5v-34c15.1-2.5 30.7-2.5 45.6 0v34c26.8 9.5 30.2 11.6 51.1 29.5l29.4-17c9.8 11.8 17.6 25.2 22.8 39.5l-29.4 17c4.9 26.8 5.2 30.6 0 59z"/></svg>'
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
