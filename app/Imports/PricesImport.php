<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Price;
use DB;

class PricesImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        Price::truncate();
        return [
            1 => new PricesSheetImport(),
        ];
    }
}
