<?php

namespace App\Imports;

use App\Models\Price;
use App\Models\Area;
use App\Models\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PricesSheetImport implements ToModel, WithStartRow
{
    private $service_type_id = 1;

    public function model(array $row)
    {
        if ($row[0] == "Посилки") {
            $this->service_type_id = 2;
        }

        if (isset($row[1]))
        {
            for ($i = 1; $i < 10; $i++) {
                $area_id = Area::where('area', $i)->first()->id;
                $area_id = $area_id - 1;
                if ($area_id == 0) {
                    $area_id = 9;
                }
                $weight_id = Weight::where('weight', $row[0])->first()->id;
                
                Price::create([
                    'price' => $row[$i],
                    'area_id' => $area_id,
                    'weight_id' => $weight_id,
                    'service_type_id' => $this->service_type_id,
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 7;
    }
}
