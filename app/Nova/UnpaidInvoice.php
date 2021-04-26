<?php

namespace App\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;

class UnpaidInvoice extends Invoice
{
    public static $group_index = 350;

    public static $tableStyle = 'tight';

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
     * label.
     *
     * @return void
     */
    public static function label()
    {
        return 'Unpaid Invoices';
    }
}
