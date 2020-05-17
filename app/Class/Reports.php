<?php

namespace leifermendez\Reports;

use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class Reports
{
    protected $pdf;

    public function __construct()
    {
        $this->pdf = App::make('dompdf.wrapper');
    }

    public function reportSingle($data, $name = '')
    {

        $content = \PDF::loadView('reports.single', $data)->output();
        Storage::disk('public')->put($name, $content);
        return Storage::disk('public')->url($name);

    }
}
