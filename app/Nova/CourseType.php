<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Markdown;
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
    public static $model = 'App\CourseType';

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
     * $group
     *
     * @var string
     */
    public static $group = "Settings";

    public static $group_index = 300;

    /**
     * label
     *
     * @return void
     */
    public static function label() { return 'Course Types'; }

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

            Text::make('Title')
                ->sortable()
                ->hideFromIndex(),

            Money::make('Default Rate', 'EUR')
                ->rules('required', 'max:255'),

            Textarea::make('Objectives')
                ->rows(5)
                ->hideFromIndex(),

            Textarea::make('Who should attend', 'who_should_attend')
                ->rows(5)
                ->hideFromIndex(),

            Textarea::make('Delegates')
                ->rows(5)
                ->hideFromIndex(),

            Markdown::make('Outline')
                ->hideFromIndex(),

            Textarea::make('Duration')
                ->rows(5)
                ->hideFromIndex(),

            Textarea::make('Certification')
                ->rows(5)
                ->hideFromIndex(),

            Textarea::make('What to bring', 'what_to_bring')
                ->rows(5)
                ->hideFromIndex(),

            Textarea::make('Plan of the day', 'plan_of_the_day')
                ->rows(5)
                ->hideFromIndex(),

            Number::make('Valid for years', 'valid_for_years'),

            Number::make('Capacity')

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
