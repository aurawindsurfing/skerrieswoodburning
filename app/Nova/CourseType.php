<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laraning\NovaTimeField\TimeField;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Vyuldashev\NovaMoneyField\Money;

class CourseType extends Resource
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            BelongsTo::make('Display Group', 'course_type_group','App\Nova\CourseTypeGroup'),

            Text::make('Title')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Tutor title')
                ->sortable()
                ->hideFromIndex(),

            Money::make('Default Rate', 'EUR')
                ->rules('required', 'max:255'),

            Textarea::make('Objectives')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Textarea::make('Who should attend', 'who_should_attend')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Textarea::make('Delegates')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Markdown::make('Outline')
                ->hideFromIndex()
                ->alwaysShow(),

            Textarea::make('Duration')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Textarea::make('Certification')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Textarea::make('What to bring', 'what_to_bring')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            TimeField::make('Start Time'),

            Textarea::make('Plan of the day', 'plan_of_the_day')
                ->rows(5)
                ->hideFromIndex()
                ->alwaysShow(),

            Number::make('Valid for years', 'valid_for_years'),

            Number::make('Capacity'),

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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
