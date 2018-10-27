<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;

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
     * $group
     *
     * @var string
     */
    public static $group = "Customers";

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            
            DateTime::make('Date')->sortable(),

            BelongsTo::make('Client')->sortable(),

            BelongsTo::make('Course')->sortable(),

            HasMany::make('Payments')->sortable(),

            BelongsTo::make('Company')->sortable(),

            HasOne::make('Contact')->sortable(),

            Text::make('PO')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Invoice')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Boolean::make('Confirmation Sent'),

            Boolean::make('Confirmed'),

            Boolean::make('No Show'),

            BelongsTo::make('User')
                ->hideFromIndex(),

            Text::make('Actually Paid')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

            Text::make('Comments')
                ->hideFromIndex()
                ->rules('required', 'max:255'),

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
        return [
            new Metrics\NewBookings
        ];
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
