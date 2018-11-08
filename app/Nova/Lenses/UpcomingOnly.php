<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Fields\BelongsTo;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\HasMany;

class UpcomingOnly extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            // BelongsTo::make('Course Type', 'course_type')->sortable(),
            Money::make('Price','EUR')->sortable(),
            DateTime::make('Date')->sortable()->hideFromIndex(),
            Date::make('Date')->sortable()->onlyOnIndex(),
            // BelongsTo::make('Venue', 'vanue', \App\Venue::class)->sortable()->searchable(),

            // Indicator::make('Status', function () {

            //     if ($this->placesLeft() > 0){
            //         return 'available';
            //     } elseif ($this->placesLeft() == 0) {
            //         return 'full';
            //     } elseif ($this->placesLeft() < 0) {
            //         return 'overbooked';
            //     }

            // })->labels([
            //     'available' => $this->placesLeft() . ' Available',
            //     'full' => 'Full',
            //     'overbooked' => $this->placesLeft() . ' Overbooked',
            // ])->colors([
            //     'available' => 'green',
            //     'full' => 'purple',
            //     'overbooked' => 'red',
            // ]),

            // HasMany::make('Bookings')->sortable(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'upcoming-only';
    }
}
