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
use Vyuldashev\NovaMoneyField\Money;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class Booking extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Booking';

    // /**
    //  * The single value that should be used to represent the resource when being displayed.
    //  *
    //  * @var string
    //  */
    // public static $title = 'surname';

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'date' => 'desc'
    ];

    /**
     * The number of resources to show per page via relationships.
     *
     * @var int
     */
    public static $perPageViaRelationship = 10;

    /**
     * title
     *
     * @return void
     */
    public function title()
    {
        return $this->name . ' ' . $this->surname .' - '. $this->course->course_type->name . ' - '. $this->course->date->format('Y-m-d');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'surname',
        'email',
        'date',
        // 'course',
        // 'company',
        // 'contact'
    ];

    /**
     * $group
     *
     * @var string
     */
    public static $group = "Customers";

    public static $group_index = 200;

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

            BelongsTo::make('Course')
                ->sortable()
                ->searchable()
                ->onlyOnForms()
                ->withMeta([
                    // 'value' => session('booking.course_id'),
                    'belongsToId' => session('booking.course_id') 
                ])
                ->displayUsing(function ($course) {
                    return $course->course_type->name;
                })
                ->rules('required'),

            Text::make('Name')->sortable(),
            Text::make('Surname')->sortable(),
            Text::make('Phone')->sortable(),
            Text::make('Email')->sortable(),
            Boolean::make('PPS')->hideFromIndex(),
            
            Money::make('Rate', 'EUR')->exceptOnForms(),
            Money::make('Rate', 'EUR')->onlyOnForms()
                ->withMeta([
                    'value' => 115, 
                ]),

            BelongsTo::make('Course')
                ->searchable()
                ->exceptOnForms()
                ->displayUsing(function ($course) {
                    return $course->course_type->name;
                }),

            BelongsTo::make('Invoice')
                ->onlyOnIndex(),

            HasOne::make('Invoice'),

            BelongsTo::make('Company')
                ->withMeta([
                    'belongsToId' => session('booking.company_id')
                ])
                ->searchable(),

            BelongsTo::make('Contact', 'contact')
                ->hideFromIndex()
                ->withMeta([
                    'belongsToId' => session('booking.contact_id')
                ])->searchable(),

            // NovaBelongsToDepend::make('Company')
            //     ->options(\App\Company::all()),

            // NovaBelongsToDepend::make('Contact')
            //     ->optionsResolve(function ($company) {
            //         return $company->contacts()->get();
            //     })
            //     ->dependsOn('Company'),

            Boolean::make('Confirmation Sent')->hideWhenCreating(),

            Text::make('PO')
                ->withMeta([
                    'value' => session('booking.po')
                ])
                ->hideFromIndex(),

            // HasMany::make('Payments'),

            BelongsTo::make('User')
                ->withMeta([
                    'value' => $this->user_id ?? auth()->user()->id, 
                    'belongsToId' => $this->user_id ?? auth()->user()->id
                ])
                ->onlyOnForms()
                ->hideWhenCreating(),

            BelongsTo::make('User')->onlyOnDetail(),


            Text::make('Comments')->hideWhenCreating()->hideFromIndex(),

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

            (new Actions\ExportToExcel)
                ->withHeadings()
                ->withWriterType(\Maatwebsite\Excel\Excel::XLS)
                ->withFilename('bookings-' . time() . '.xls'),

            (new Actions\CreateAndDownloadInvoices),

            (new Actions\CreateInvoiceAndSendByEmail),

            (new Actions\CreateInvoiceSendByEmailMarkAsPaid),

            (new Actions\DownloadCourseConfirmation),

        ];
    }
}
