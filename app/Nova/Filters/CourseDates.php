<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Illuminate\Database\Eloquent\Scope;
use App\Scopes\UpcomingOnlyScope;

class CourseDates extends Filter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {

        // session()->has('filter.upcoming_value') ? $value = session('filters.upcoming_value') : session(['filters.upcomin_value' => $value]);

        return $query
            // ->withoutGlobalScope(UpcomingOnlyScope::class)
            ->where('date', '>=', $value);
    }

    public function default()
    {
        return ['currentValue' => 'Upcoming Only'];
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Upcoming Only' => date('Y-m-d h:m:s'),
            'All' => date('1900-01-01 00:00:00'),
        ];
    }
}
