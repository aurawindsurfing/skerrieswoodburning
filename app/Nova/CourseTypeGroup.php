<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use MichielKempen\NovaOrderField\Orderable;
use MichielKempen\NovaOrderField\OrderField;
use Silvanite\NovaFieldCloudinary\Fields\CloudinaryImage;

class CourseTypeGroup extends Resource
{
    use Orderable;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\CourseTypeGroup::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * @var string
     */
    public static $defaultOrderField = 'order';

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

    public static $group_index = 410;

    /**
     * label.
     *
     * @return void
     */
    public static function label()
    {
        return 'Display Groups';
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

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            CloudinaryImage::make('Icon'),

            OrderField::make('Order'),

            HasMany::make('Course Types', 'course_types'),

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
