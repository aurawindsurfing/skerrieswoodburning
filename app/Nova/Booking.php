<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;

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
     * softDeletes
     *
     * @return void
     */
    public static function softDeletes()
    {
        return false;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()
                ->sortable(),

            Date::make('Date')
                ->sortable()
                ->withMeta([ 
                    'value' => date('Y-m-d H:m:s'),
                ])
                // ->hideWhenCreating()
                ,

            BelongsTo::make('Client')
                ->sortable()
                ->searchable(),

            BelongsTo::make('Course')
                ->sortable()
                ->searchable(),

            HasMany::make('Payments')
                ->sortable(),

            BelongsTo::make('Company')
                ->sortable()
                ->searchable(),

            HasOne::make('Contact', 'contact')
                ->sortable(),

            Text::make('PO')
                ->hideWhenCreating()
                ->hideFromIndex(),

            Text::make('Invoice')
                ->hideFromIndex()
                ->hideWhenCreating(),

            Boolean::make('Confirmation Sent')
                ->hideWhenCreating(),

            Boolean::make('Confirmed')
                ->hideWhenCreating(),

            Boolean::make('No Show')
                ->hideWhenCreating(),

            BelongsTo::make('User')
                ->withMeta([
                    'value' => $this->user_id ?? auth()->user()->id, 
                    'belongsToId' => $this->user_id ?? auth()->user()->id
                ])
                ->hideFromIndex()
                ->hideWhenCreating(),

            Text::make('Actually Paid')
                ->hideFromIndex()
                ->hideWhenCreating(),

            Text::make('Comments')
                ->hideWhenCreating()
                ->hideFromIndex(),

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
