<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Country;
use App\Models\Weight;
use Lang;
use DB;

class ExcelImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        Country::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Weight::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return [
            0 => new FirstSheetImport(Lang::get('countries'), trans('countries', [], 'uk_UA')),
            1 => new SecondSheetImport(),
        ];
    }
}
