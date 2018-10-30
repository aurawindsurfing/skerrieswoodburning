<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ExportToExcel extends DownloadExcel implements ShouldAutoSize, WithColumnFormatting
{
    //  /**
    //  * Get the displayable name of the action.
    //  *
    //  * @return string
    //  */
    // public function name()
    // {
    //     return ('Download');
    // }


    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => "###############"
        ];
    }
}
