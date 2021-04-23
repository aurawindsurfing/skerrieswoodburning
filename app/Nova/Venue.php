<?php

namespace App\Nova;

use DinandMentink\Markdown\Markdown;
use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Silvanite\NovaFieldCloudinary\Fields\CloudinaryImage;

class Venue extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Venue::class;

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
        'city',
    ];

    /**
     * $group.
     *
     * @var string
     */
    public static $group = 'Resources';

    public static $group_index = 120;

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

            $this->addressFields(),

            Text::make('Phone')->rules('max:254')->hideFromIndex(),

            Url::make('Google Maps')->hideFromIndex()->rules('url')->clickable(),

            CloudinaryImage::make('Photo'),

            Markdown::make('Description')->onlyOnForms(),

            HasMany::make('Courses'),

        ];
    }

    /**
     * addressFields.
     *
     * @return void
     */
    protected function addressFields()
    {
        return $this->merge([
            Place::make('Address', 'address_line_1')->rules('required', 'max:255')->countries([
                    'IE',
                    'NI',
                    'GB',
                ])->hideFromIndex(),
            // Text::make('Address Line 2')->hideFromIndex(),
            Text::make('City'),
            Text::make('Postal Code')->hideFromIndex(),
            Country::make('Country')->hideFromIndex(),
        ]);
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
        return [
            (new Actions\MergeVenues),
        ];
    }
}
