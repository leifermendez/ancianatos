<?php

namespace App\Exports;

use App\Institutions;
use Maatwebsite\Excel\Concerns\FromCollection;

class InstitutionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Institutions::all();
    }
}
