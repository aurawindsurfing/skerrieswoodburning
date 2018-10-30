<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;

// use Laravel\Nova\Actions\ExportPDF;
// use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Booking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Booking';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * $group
     *
     * @var string
     */
    public static $group = "Customers";

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
            // ID::make()->sortable(),

            // DateTime::make('Date')
            //     ->sortable()
            //     ->withMeta([ 
            //         'value' => date('Y-m-d H:m:s'),
            //     ])
            //     ->hideWhenCreating(),

            BelongsTo::make('Client')
                ->sortable()
                ->searchable(),

            Text::make('Phone', function () {
                return empty($this->client->phone) ? '---' : $this->client->phone;
            })
                ->sortable()
                ->rules('required', 'max:254'),

            BelongsTo::make('Course')
                ->sortable()
                ->searchable()
                ->displayUsing(function ($course) {
                    return $course->course_type->name;
                }),

            HasMany::make('Payments')
                ->sortable(),

            BelongsTo::make('Company')
                ->sortable()
                ->searchable(),

            BelongsTo::make('Contact', 'contact')
                ->sortable()
                ->searchable()
                ->hideWhenCreating(),

            Text::make('PO')
                ->hideWhenCreating()
                ->hideFromIndex(),

            Text::make('Invoice')
                ->hideFromIndex()
                ->hideWhenCreating(),

            Boolean::make('Confirmation Sent')
                ->hideWhenCreating(),

            Boolean::make('Confirmed')
                ->hideWhenCreating(),

            Boolean::make('No Show')
                ->hideWhenCreating(),

            BelongsTo::make('User')
                ->withMeta([
                    'value' => $this->user_id ?? auth()->user()->id, 
                    'belongsToId' => $this->user_id ?? auth()->user()->id
                ])
                ->onlyOnForms()
                ->hideWhenCreating(),

            BelongsTo::make('User')->onlyOnDetail(),

            Text::make('Actually Paid')
                ->hideFromIndex()
                ->hideWhenCreating(),

            Text::make('Comments')
                ->hideWhenCreating()
                ->hideFromIndex(),

            DateTime::make('Date')
                ->sortable()
                ->withMeta([ 
                    'value' => date('Y-m-d H:m:s'),
                ])
                ->hideFromIndex()
                ->hideWhenCreating(),

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
        return [
            new Metrics\NewBookings
        ];
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
        return [

            (new Actions\ExportToPdf)
                ->withHeadings()
                ->withWriterType(\Maatwebsite\Excel\Excel::MPDF)
                ->except('course', 'no_show')
                ->withFilename('bookings- ' . time() . '.pdf'),

            (new Actions\ExportToExcel)
                ->withHeadings()
                ->withWriterType(\Maatwebsite\Excel\Excel::XLS)
                ->withFilename('bookings-' . time() . '.xls'),
        ];
    }
}
