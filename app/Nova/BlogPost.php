<?php

namespace App\Nova;

use DinandMentink\Markdown\Markdown;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Silvanite\NovaFieldCloudinary\Fields\CloudinaryImage;

class BlogPost extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\BlogPost';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

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
     * $group.
     *
     * @var string
     */
    public static $group = 'Resources';

    public static $group_index = 160;

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
            Text::make('Header'),
            Text::make('Title')->rules('required'),
            Markdown::make("Description Above Image")->onlyOnForms()->required(),
            CloudinaryImage::make('Image'),
            Markdown::make("Description Below Image")->onlyOnForms(),
            Text::make('Slug')->required(),

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
