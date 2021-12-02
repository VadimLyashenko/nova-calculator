<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Country;
use Lang;

class ExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        Country::truncate();
        return [
            0 => new FirstSheetImport(Lang::get('countries'), trans('countries', [], 'uk_UA')),
            1 => new SecondSheetImport(),
        ];
    }
}
