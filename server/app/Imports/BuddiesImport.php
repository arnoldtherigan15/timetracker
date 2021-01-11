<?php

namespace App\Imports;

use App\Models\Buddy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BuddiesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Buddy([
            'name'     => $row['name'],
            'batch'    => $row['batch'], 
            'api_key'    => $row['api_key'],
            'user_id' => auth()->user()->id,
        ]);
    }
}
