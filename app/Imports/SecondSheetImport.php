<?php

namespace App\Imports;

use App\Models\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SecondSheetImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        Weight::create([
            'weight' => $row[0]
        ]);
    }

    public function startRow(): int
    {
        return 18;
    }
}
