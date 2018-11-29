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

use Laravel\Nova\Fields\Boolean;
use Inspheric\Fields\Indicator;

use Laravel\Nova\Fields\Text;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Fields\Number;
use Laraning\NovaTimeField\TimeField;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use App\Scopes\UpcomingOnlyScope;
use Illuminate\Database\Eloquent\Scope;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Course';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static $title = 'id';

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'date' => 'asc'
    ];

    // showing default upcoming courses only, will overwrite in filter query
    public static function indexQuery(NovaRequest $request, $query)
    {
        // $query->withGlobalScope(UpcomingOnlyScope::class, new UpcomingOnlyScope);
    }

    /**
     * title
     *
     * @return void
     */
    public function title()
    {
        return $this->date->format('Y-m-d') .' - '. $this->course_type->name .' - '. $this->venue->name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'date',
    ];

    /**
     * The relationship columns that should be searched.
     *
     * @var array
     */
    public static $searchRelations = [
        'course_type' => ['name'],
    ];

    /**
     * $group
     *
     * @var string
     */
    public static $group = "Resources";

    public static $group_index = 110;

    /**
     * label
     *
     * @return void
     */
    // public static function label() { return 'All Courses'; }

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
     * placesLeft
     *
     * @return void
     */
    public function placesLeft()
    {
        return $this->capacity - $this->bookings->count();
        
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
            Text::make('Uuid', function () {
                return isset($this->date) ? $this->uuid() : '';
            })->exceptOnForms(),

            BelongsTo::make('Course Type', 'course_type')->sortable()->rules('required'),
            
            Money::make('Price','EUR')
                ->withMeta([
                    'value' => 115, 
                ])
                ->hideFromIndex()
                ->sortable()
                ->rules('required'),

            Date::make('Date')->sortable()->rules('required'),

            TimeField::make('Time')
                ->withMeta([
                    'value' => '08:00',
                //     // 'belongsToId' => session('booking.course_id') 
                ])
                // ->displayUsing(function ($course) {
                //     return $course->course_type->name;
                // })
                ->rules('required'),
            
            BelongsTo::make('Venue')->sortable()->searchable()->rules('required'),

            BelongsTo::make('Tutor')->sortable()->searchable()->rules('required'),

            Boolean::make('Inhouse'),

            Indicator::make('Status', function () {

                if ($this->placesLeft() > 0){
                    return 'available';
                } elseif ($this->placesLeft() == 0) {
                    return 'full';
                } elseif ($this->placesLeft() < 0) {
                    return 'overbooked';
                }

            })->labels([
                'available' => $this->placesLeft() . ' Available',
                'full' => 'Full',
                'overbooked' => $this->placesLeft() . ' Overbooked',
            ])->colors([
                'available' => 'green',
                'full' => 'purple',
                'overbooked' => 'red',
            ]),

            HasMany::make('Bookings')->sortable(),
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
        return [
            new Filters\CourseDates,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            // new Lenses\UpcomingOnly,
        ];
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
            (new Actions\DownloadCourseConfirmationForWholeCourse),
        ];
    }
}
