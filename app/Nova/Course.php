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
        'id' => 'asc',
    ];

    /**
     * title
     *
     * @return void
     */
    public function title()
    {
        return $this->course_type->name . ' - ' . $this->course_dates->first()->venue->name;
    }
    
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
    public static $with = ['tutor'];

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
                return isset($this->course_dates()->first()->date) ? $this->uuid() : '';
            })->exceptOnForms(),

            BelongsTo::make('Course Type', 'course_type')->sortable()->rules('required'),

            Money::make('Price', 'EUR')
                ->withMeta([
                    'value' => 115,
                ])
                ->hideFromIndex()
                ->sortable()
                ->rules('required'),

            Date::make('Start Date', function () {
                return isset($this->course_dates()->first()->date) ? $this->start_date()->format('Y-m-d') : '';
            })
            ->sortable()
            ->onlyOnIndex(),

            Text::make('Venue', function () {
                return isset($this->course_dates()->first()->date) ? $this->course_dates()->first()->venue->name : '';
            })->exceptOnForms(),

            HasMany::make('Course Dates')->sortable(),

            BelongsTo::make('Tutor')->sortable()->searchable()->rules('required'),

            Boolean::make('Inhouse'),

            Text::make('Notes')->exceptOnForms(),

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
                'available' => $this->placesLeft() . ' Available',
                'full' => 'Full',
                'overbooked' => $this->placesLeft() . ' Overbooked',
                'cancelled' => 'Cancelled',
            ])->colors([
                'available' => 'green',
                'full' => 'purple',
                'overbooked' => 'red',
                'cancelled' => 'red',
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
            // new Filters\CourseDates,
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
            (new Actions\ExportToExcel),
            (new Actions\DownloadCourseConfirmationForWholeCourse),
            (new Actions\DownloadCourseCertificateForWholeCourse),
            (new Actions\InformAboutVenueChange),
            (new Actions\CancelCourse),
            
        ];
    }
}
