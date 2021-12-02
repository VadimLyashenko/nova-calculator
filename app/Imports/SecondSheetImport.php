<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class SecondSheetImport implements WithMappedCells, ToModel
{
    public function mapping(): array
    {
        return [];
    }

    public function model(array $row)
    {

    }
}
