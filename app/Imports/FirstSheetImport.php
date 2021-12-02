<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Area;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FirstSheetImport implements ToModel, WithStartRow
{
    protected $countries;
    protected $ua_countries;

    public function __construct($countries, $ua_countries)
    {
        $this->countries = $countries;
        $this->ua_countries = $ua_countries;
    }

    public function model(array $row)
    {
        if(isset($row[0])&&isset($row[1])) {
            $code = array_search(trim(preg_replace('/[0-9]+/', '', $row[0])), $this->ua_countries);
            Country::create([
                'name' => $this->countries[$code],
                'area_id' => Area::where('area', $row[1])->first()->id,
            ]);
        }

        if(isset($row[2])&&isset($row[3])) {
            $code = array_search(trim(preg_replace('/[0-9]+/', '', $row[2])), $this->ua_countries);
            Country::create([
                'name' => $this->countries[$code],
                'area_id' => Area::where('area', $row[3])->first()->id,
            ]);
        }

        if(isset($row[4])&&isset($row[5])) {
            $code = array_search(trim(preg_replace('/[0-9]+/', '', $row[4])), $this->ua_countries);
            Country::create([
                'name' => $this->countries[$code],
                'area_id' => Area::where('area', $row[5])->first()->id,
            ]);
        }

        if(isset($row[6])&&isset($row[7])) {
            $code = array_search(trim(preg_replace('/[0-9]+/', '', $row[6])), $this->ua_countries);
            Country::create([
                'name' => $this->countries[$code],
                'area_id' => Area::where('area', $row[7])->first()->id,
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
