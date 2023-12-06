<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | This value is the default currency that is going to be used in invoices.
    | You can change it on each invoice individually.
    */

    'currency' => 'EUR',

    /*
    |--------------------------------------------------------------------------
    | Default Decimal Precision
    |--------------------------------------------------------------------------
    |
    | This value is the default decimal precision that is going to be used
    | to perform all the calculations.
    */

    'decimals' => 2,

    /*
    |--------------------------------------------------------------------------
    | Default Tax
    |--------------------------------------------------------------------------
    |
    | This value is the default tax that is going to be used in invoices.
    | You can change it on each invoice individually.
    */

    'tax' => 0,

    /*
    |--------------------------------------------------------------------------
    | Default Tax Type
    |--------------------------------------------------------------------------
    |
    | This value is the default tax type that is going to be used in invoices.
    | You can change it on each invoice individually.
    | The tax type accepted values are: 'percentage' and 'fixed'
    | The percentage type calculates the tax depending on the invoice price, and
    | the fixed type simply adds a fixed ammount to the total price
    */

    'tax_type' => 'percentage',

    /*
   |--------------------------------------------------------------------------
   | Default Invoice Logo
   |--------------------------------------------------------------------------
   |
   | This value is the default invoice logo that is going to be used in invoices.
   | You can change it on each invoice individually.
   */

    'logo' => env('APP_URL').'/images/cit_logo.png',

    /*
  |--------------------------------------------------------------------------
  | Default Invoice Logo Height
  |--------------------------------------------------------------------------
  |
  | This value is the default invoice logo height that is going to be used in invoices.
  | You can change it on each invoice individually.
  */

    'logo_width' => 130,

    /*
  |--------------------------------------------------------------------------
  | Default Invoice Buissness Details
  |--------------------------------------------------------------------------
  |
  | This value is going to be the default attribute displayed in
  | the customer model.
  */

    'business_details' => [
        'name' => 'Contruction Industry Training Ltd',
        'id' => '8220493A',
        'phone' => '01 809 7266',
        'location' => 'Unit C3, Dunshaughlin Business Park ',
        'zip' => 'A85 YV58',
        'city' => 'Dunshaughlin, Co. Meath',
        'country' => 'Ireland',
    ],

    'bank_details' => [
        'name' => 'Construction Industry Training Ltd',
        'number' => '78384868',
        'sort' => '90-04-20',
        'iban' => 'IE92BOFI90042078384868',
        'swift' => 'BOFIIE2D',
    ],

    /*
  |--------------------------------------------------------------------------
  | Default Invoice Footnote
  |--------------------------------------------------------------------------
  |
  | This value is going to be at the end of the document, sometimes telling you
  | some copyright message or simple legal terms.
  */

    'footnote' => '
  ',

];
