<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Inspheric\Fields\Indicator;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Michielfb\Time\Time;
use Vyuldashev\NovaMoneyField\Money;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Course::class;

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
     * title.
     *
     * @return void
     */
    public function title()
    {
        return $this->date->format('Y-m-d').' - '.$this->course_type->name.' - '.$this->venue->name;
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
     * $group.
     *
     * @var string
     */
    public static $group = 'Resources';

    public static $group_index = 110;

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['venue', 'tutor'];

    /**
     * label.
     *
     * @return void
     */
    // public static function label() { return 'All Courses'; }

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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Uuid', function () {
                return isset($this->date) ? $this->uuid() : '';
            })->exceptOnForms(),

            BelongsTo::make('Course Type', 'course_type')->rules('required'),

            Money::make('Price', 'EUR')->hideFromIndex()->sortable()->rules('required'),

            Date::make('Date')->sortable()->rules('required'),

            Time::make('Time')->format('HH:mm')->rules('required'),

            Number::make('Capacity')->rules('required'),

            BelongsTo::make('Venue')->searchable()->rules('required'),

            BelongsTo::make('Tutor')->searchable()->rules('required'),

            Boolean::make('Inhouse'),

            Boolean::make('Multiday'),

            Text::make('Notes')->exceptOnForms()->hideFromIndex(),

            Indicator::make('Status', function () {
                if ($this->placesLeft() > 0 && $this->cancelled == false) {
                    return 'available';
                } elseif ($this->placesLeft() == 0 && $this->cancelled == false) {
                    return 'full';
                } elseif ($this->placesLeft() < 0 && $this->cancelled == false) {
                    return 'overbooked';
                } elseif ($this->cancelled == true) {
                    return 'cancelled';
                }
            })->labels([
                'available'  => $this->placesLeft().' Available',
                'full'       => 'Full',
                'overbooked' => $this->placesLeft().' Overbooked',
                'cancelled'  => 'Cancelled',
            ])->colors([
                'available'  => 'green',
                'full'       => 'purple',
                'overbooked' => 'red',
                'cancelled'  => 'red',
            ]),

            HasMany::make('Course Dates')->sortable()->canSee(function () {
                    return $this->multiday;
                }),

            HasMany::make('Bookings')->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [// new Lenses\UpcomingOnly,
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\ExportToExcel),
            (new Actions\DownloadCourseConfirmationForWholeCourse),
            (new Actions\DownloadCourseCertificateForWholeCourse),
            (new Actions\InformAboutVenueChange),
            (new Actions\CancelCourse),

        ];
    }
}
