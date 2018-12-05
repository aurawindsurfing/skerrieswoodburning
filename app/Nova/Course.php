<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Vyuldashev\NovaMoneyField\Money;

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
        'date' => 'asc',
    ];

    /**
     * title
     *
     * @return void
     */
    public function title()
    {
        return $this->date->format('Y-m-d') . ' - ' . $this->course_type->name . ' - ' . $this->venue->name;
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
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['venue', 'tutor'];

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

            BelongsTo::make('Course Type', 'course_type')->onlyOnForms()->sortable()->rules('required'),

            Text::make('Course Type', function () {
                return $this->course_type->name;
            })->exceptOnForms(),

            Money::make('Price', 'EUR')
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

            Text::make('Venue', function () {
                return $this->venue->name;
            })->exceptOnForms(),

            Text::make('Tutor', function () {
                return $this->tutor->name;
            })->exceptOnForms(),

            BelongsTo::make('Venue')->onlyOnForms()->sortable()->searchable()->rules('required'),

            BelongsTo::make('Tutor')->onlyOnForms()->sortable()->searchable()->rules('required'),

            Boolean::make('Inhouse'),

            Text::make('Notes')->exceptOnForms(),

            Indicator::make('Status', function () {

                if ($this->placesLeft() > 0) {
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
