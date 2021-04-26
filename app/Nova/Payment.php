<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Outhebox\NovaHiddenField\HiddenField;
use Vyuldashev\NovaMoneyField\Money;

class Payment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Payment::class;

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
        'amount',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'invoice' => ['id'],
    ];

    /**
     * $group.
     *
     * @var string
     */
    public static $group = 'Accounting';

    public static $group_index = 300;

    public static $tableStyle = 'tight';

    /**
     * softDeletes.
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

            Money::make('Amount', 'EUR')->rules('required'),

            Select::make('Payment Method')->options([
                'cc' => 'CC',
                'eft' => 'EFT',
                'cash' => 'Cash',
                'cheque' => 'Cheque',
            ])->displayUsingLabels()
              ->rules('required'),

            Date::make('Date', 'created_at')->exceptOnForms(),

            Indicator::make('Status')
             ->labels([
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
            ])->colors([
                'completed' => 'green',
                'cancelled' => 'grey',
            ])->exceptOnForms(),

            BelongsTo::make('Invoice')
                ->searchable(),

            HiddenField::make('Status')
            ->onlyOnForms()
            ->defaultValue('completed'),

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
        return [
            (new Actions\PaymentReceiptDownload),
        ];
    }
}
