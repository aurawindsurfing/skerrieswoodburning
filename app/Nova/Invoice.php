<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Money\Number;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;

class Invoice extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Invoice';

    /**
     * title
     *
     * @return void
     */
    public function title()
    {
        return $this->number();
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'total'
    ];

     /**
     * $group
     *
     * @var string
     */
    public static $group = "Accounting";

    public static $group_index = 300;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Text::make('ID')
                ->displayUsing(function ($course) {
                    return $this->number();
                })
                ->sortable(),
            
            Date::make('Date'),

            Money::make('Total', 'EUR'),

            Select::make('Status')->options([
                'paid' => 'Paid',
                'unpaid' => 'Unpaid',
                'cancelled' => 'Cancelled',
            ])->displayUsingLabels(),

            BelongsTo::make('Company'),

            HasMany::make('Payment')

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
