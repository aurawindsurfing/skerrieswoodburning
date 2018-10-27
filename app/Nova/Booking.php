<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Booking';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Client')->sortable(),

            DateTime::make('Date')->sortable(),
            
            BelongsTo::make('Course')->sortable(),

            HasMany::make('Payments')->sortable()

            







            // $table->dateTime('date');
            // $table->integer('client_id')->unsigned();
            // $table->integer('course_id')->unsigned();
            // $table->integer('company_id')->unsigned()->nullable()->default(null);
            // $table->integer('contact_person_id')->unsigned()->nullable()->default(null);
            // $table->text('po')->nullable()->default(null);
            // $table->text('invoice')->nullable()->default(null);
            // $table->dateTime('confirmation_sent')->nullable()->default(null);
            // $table->dateTime('reminder_sent')->nullable()->default(null);
            // $table->boolean('confirmed')->default(false);
            // $table->boolean('no_show')->default(false);
            // $table->integer('user_id')->unsigned()->nullable()->default(null);
            // $table->integer('payment_id')->unsigned()->nullable()->default(null);
            // $table->text('actually_paid')->nullable()->default(null);
            // $table->text('comments')->nullable()->default(null);



        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
