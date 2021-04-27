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
use DigitalCreative\CollapsibleResourceManager\Resources\ExternalLink;
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
            //(new \Richardkeep\NovaTimenow\NovaTimenow)->width('1/3'),
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
                // docs https://github.com/dcasia/collapsible-resource-manager
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
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="wallet" class="svg-inline--fa fa-wallet fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M448 112V96c0-35.35-28.65-64-64-64H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h352c35.35 0 64-28.65 64-64V176c0-35.35-28.65-64-64-64zm16 304c0 8.82-7.18 16-16 16H96c-26.47 0-48-21.53-48-48V128c0-26.47 21.53-48 48-48h288c8.82 0 16 7.18 16 16v32H112c-8.84 0-16 7.16-16 16s7.16 16 16 16h336c8.82 0 16 7.18 16 16v240zm-80-160c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Resources',
                        'resources' => [
                            Course::class,
                            Venue::class,
                            Tutor::class,
                            BlogPost::class,
                            ExternalLink::make([
                                'label' => 'Google ranking',
                                'badge' => null,
                                'icon' => null,
                                'target' => '_blank',
                                'url' => 'https://app.serpwatcher.com/report?token=zDUX3FoHm3MODfE4aIzpR8Pa20m7wXBqPcgIAmwHviMg7k5Gs3CsePvj9bj1nMIy&id=601825e1f4c7d61875941223'
                            ])
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clipboard-list" class="svg-inline--fa fa-clipboard-list fa-w-12" role="img" viewBox="0 0 384 512"><path fill="currentColor" d="M280 240H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm0 96H168c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h112c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zM112 232c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zM336 64h-80c0-35.3-28.7-64-64-64s-64 28.7-64 64H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM192 48c8.8 0 16 7.2 16 16s-7.2 16-16 16-16-7.2-16-16 7.2-16 16-16zm144 408c0 4.4-3.6 8-8 8H56c-4.4 0-8-3.6-8-8V120c0-4.4 3.6-8 8-8h40v32c0 8.8 7.2 16 16 16h160c8.8 0 16-7.2 16-16v-32h40c4.4 0 8 3.6 8 8v336z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Accounting',
                        'resources' => [
                            Payment::class,
                            Invoice::class,
                            UnpaidInvoice::class,
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="calculator-alt" class="svg-inline--fa fa-calculator-alt fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M477.71 0H34.29C15.35 0 0 15.35 0 34.29v443.43C0 496.65 15.35 512 34.29 512h443.43c18.94 0 34.29-15.35 34.29-34.29V34.29C512 15.35 496.65 0 477.71 0zM232 464H48V280h184v184zm0-232H48V48h184v184zm232 232H280V280h184v184zm0-232H280V48h184v184zm-360-72h80c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8h-80c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zm224 248h80c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8h-80c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zm0-48h80c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8h-80c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zm0-200h24v24c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-24h24c4.42 0 8-3.58 8-8v-16c0-4.42-3.58-8-8-8h-24v-24c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v24h-24c-4.42 0-8 3.58-8 8v16c0 4.42 3.58 8 8 8zM104.4 396.28l11.31 11.31c3.12 3.12 8.19 3.12 11.31 0L144 390.63l16.97 16.97c3.12 3.12 8.19 3.12 11.31 0l11.31-11.31c3.12-3.12 3.12-8.19 0-11.31L166.63 368l16.97-16.97c3.12-3.12 3.12-8.19 0-11.31l-11.31-11.31c-3.12-3.12-8.19-3.12-11.31 0L144 345.37l-16.97-16.97c-3.12-3.12-8.19-3.12-11.31 0l-11.31 11.31c-3.12 3.12-3.12 8.19 0 11.31L121.37 368l-16.97 16.97c-3.12 3.12-3.12 8.19 0 11.31z"/></svg>'
                    ]),
                    TopLevelResource::make([
                        'label' => 'Settings',
                        'resources' => [
                            CourseType::class,
                            CourseTypeGroup::class,
                            User::class,
                        ],
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="cog" class="svg-inline--fa fa-cog fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M452.515 237l31.843-18.382c9.426-5.441 13.996-16.542 11.177-27.054-11.404-42.531-33.842-80.547-64.058-110.797-7.68-7.688-19.575-9.246-28.985-3.811l-31.785 18.358a196.276 196.276 0 0 0-32.899-19.02V39.541a24.016 24.016 0 0 0-17.842-23.206c-41.761-11.107-86.117-11.121-127.93-.001-10.519 2.798-17.844 12.321-17.844 23.206v36.753a196.276 196.276 0 0 0-32.899 19.02l-31.785-18.358c-9.41-5.435-21.305-3.877-28.985 3.811-30.216 30.25-52.654 68.265-64.058 110.797-2.819 10.512 1.751 21.613 11.177 27.054L59.485 237a197.715 197.715 0 0 0 0 37.999l-31.843 18.382c-9.426 5.441-13.996 16.542-11.177 27.054 11.404 42.531 33.842 80.547 64.058 110.797 7.68 7.688 19.575 9.246 28.985 3.811l31.785-18.358a196.202 196.202 0 0 0 32.899 19.019v36.753a24.016 24.016 0 0 0 17.842 23.206c41.761 11.107 86.117 11.122 127.93.001 10.519-2.798 17.844-12.321 17.844-23.206v-36.753a196.34 196.34 0 0 0 32.899-19.019l31.785 18.358c9.41 5.435 21.305 3.877 28.985-3.811 30.216-30.25 52.654-68.266 64.058-110.797 2.819-10.512-1.751-21.613-11.177-27.054L452.515 275c1.22-12.65 1.22-25.35 0-38zm-52.679 63.019l43.819 25.289a200.138 200.138 0 0 1-33.849 58.528l-43.829-25.309c-31.984 27.397-36.659 30.077-76.168 44.029v50.599a200.917 200.917 0 0 1-67.618 0v-50.599c-39.504-13.95-44.196-16.642-76.168-44.029l-43.829 25.309a200.15 200.15 0 0 1-33.849-58.528l43.819-25.289c-7.63-41.299-7.634-46.719 0-88.038l-43.819-25.289c7.85-21.229 19.31-41.049 33.849-58.529l43.829 25.309c31.984-27.397 36.66-30.078 76.168-44.029V58.845a200.917 200.917 0 0 1 67.618 0v50.599c39.504 13.95 44.196 16.642 76.168 44.029l43.829-25.309a200.143 200.143 0 0 1 33.849 58.529l-43.819 25.289c7.631 41.3 7.634 46.718 0 88.037zM256 160c-52.935 0-96 43.065-96 96s43.065 96 96 96 96-43.065 96-96-43.065-96-96-96zm0 144c-26.468 0-48-21.532-48-48 0-26.467 21.532-48 48-48s48 21.533 48 48c0 26.468-21.532 48-48 48z"/></svg>'
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
