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

class UnpaidInvoice extends Invoice
{
    
    public static $group_index = 310;

     /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {

        $query->where('status', '=', 'unpaid');

        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
        return $query;
    }

    /**
     * label
     *
     * @return void
     */
    public static function label() { return 'Unpaid Invoices'; }
    
}
