<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Money\Number;
use Vyuldashev\NovaMoneyField\Money;
use Outhebox\NovaHiddenField\HiddenField;
use Laravel\Nova\Fields\Select;

class CreditNote extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\CreditNote';

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
     * softDeletes
     *
     * @return void
     */
    public static function softDeletes()
    {
        return false;
    }

    /**
     * The columns that should be searched.
     * We are using titasgailius/search-relations here
     *
     * @var array
     */
    public static $search = [
        'id',
        'amount',
    ];

    /**
     * label
     *
     * @return void
     */
    public static function label()
    {return 'Credit Notes';}

     /**
     * $displayInNavigation
     *
     * @var boolean
     */
    public static $displayInNavigation = false;

    /**
     * $group
     *
     * @var string
     */
    public static $group = "Accounting";

    public static $group_index = 340;

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

            Money::make('Amount', 'EUR'),

            Date::make('Date', 'created_at')->exceptOnForms(),

            Indicator::make('Status')
                ->labels([
                    'issued' => 'Issued',
                    'cancelled' => 'Cancelled',
                ])->colors([
                'issued' => 'green',
                'cancelled' => 'red',
            ])->exceptOnForms(),

            BelongsTo::make('Invoice'),

            BelongsTo::make('User')
                ->withMeta([
                    'value' => $this->user_id ?? auth()->user()->id,
                    'belongsToId' => $this->user_id ?? auth()->user()->id,
                ])
                ->onlyOnForms()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('User')->onlyOnDetail(),

            HiddenField::make('Status')
            ->onlyOnForms()
            ->default('issued'),

            HiddenField::make('Prefix')
            ->onlyOnForms()
            ->default('CN-'),

            HiddenField::make('User Id')
            ->onlyOnForms()
            ->default(auth()->user()->id),

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
