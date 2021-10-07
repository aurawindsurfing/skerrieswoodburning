<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class BookingDateFilter extends DateFilter
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
        return $query
            ->join('courses','bookings.course_id', '=', 'courses.id')
            ->where('courses.date', '=', Carbon::parse($value)->format('Y-m-d'))
            ->select('bookings.*');
    }
}
