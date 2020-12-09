<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Michielfb\Time\Time;
use MichielKempen\NovaOrderField\Orderable;
use MichielKempen\NovaOrderField\OrderField;
use Vyuldashev\NovaMoneyField\Money;

class CourseType extends Resource
{
    use Orderable;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\CourseType::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    public static $defaultOrderField = 'order';

    /**
     * $group.
     *
     * @var string
     */
    public static $group = 'Settings';

    public static $group_index = 400;

    /**
     * label.
     *
     * @return void
     */
    public static function label()
    {
        return 'Course Types';
    }

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
            ID::make()->sortable(),

            Text::make('Name')->sortable()->rules('required', 'max:255'),

            BelongsTo::make('Display Group', 'course_type_group', 'App\Nova\CourseTypeGroup'),

            Text::make('Title')->sortable()->hideFromIndex(),

            Text::make('Tutor title')->sortable()->hideFromIndex(),

            Money::make('Default Rate', 'EUR'),

            Textarea::make('Objectives')->hideFromIndex()->alwaysShow(),

            Textarea::make('Who should attend', 'who_should_attend')->hideFromIndex()->alwaysShow(),

            Textarea::make('Delegates')->rows(1)->hideFromIndex()->alwaysShow(),

            Markdown::make('Outline')->hideFromIndex()->alwaysShow(),

            Textarea::make('Duration')->rows(1)->hideFromIndex()->alwaysShow(),

            Textarea::make('Certification')->rows(2)->hideFromIndex()->alwaysShow(),

            Markdown::make('What to bring', 'what_to_bring')->hideFromIndex()->alwaysShow(),

            Time::make('Start Time')->format('HH:mm'),

            Markdown::make('Plan of the day', 'plan_of_the_day')->hideFromIndex()->alwaysShow(),

            Number::make('Valid for years', 'valid_for_years'),

            Number::make('Capacity')->rules('required'),

            OrderField::make('Order'),

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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
