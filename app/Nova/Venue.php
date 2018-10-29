<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Markdown;
use Silvanite\NovaFieldCloudinary\Fields\CloudinaryImage;

class Venue extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Venue';

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
        'address_line_1',
        'postal_code',
        'city'
    ];

    /**
     * $group
     *
     * @var string
     */
    public static $group = "Resources";

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
            Text::make('Name')->sortable()->rules('required', 'max:255'),
            $this->addressFields(),
            Text::make('Phone')->rules('max:254')->hideFromIndex(),
            Markdown::make('Directions')->hideFromIndex(),
            CloudinaryImage::make('Photo'),
            
        ];
    }

    /**
     * addressFields
     *
     * @return void
     */
    protected function addressFields()
    {
        return $this->merge([
            Place::make('Address', 'address_line_1')
                ->rules('required', 'max:255')->countries(['IE', 'NI', 'GB'])->hideFromIndex(),
            // Text::make('Address Line 2')->hideFromIndex(),
            Text::make('City'),
            Text::make('Postal Code')->hideFromIndex(),
            Country::make('Country')->hideFromIndex(),
        ]);
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
