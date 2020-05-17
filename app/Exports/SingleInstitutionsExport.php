<?php

namespace App\Exports;

use App\Institutions;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class SingleInstitutionsExport implements FromQuery
{
    use Exportable;

    public function forId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function query()
    {
        return Institutions::query()->find($this->id);
    }

}
