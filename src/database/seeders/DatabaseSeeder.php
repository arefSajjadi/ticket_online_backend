<?php

namespace Database\Seeders;

use App\Enums\HallEnum;
use App\Models\Hall;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $hall = Hall::findOrFail(1);

        $rows = [10, 11, 12, 13, 14];

        $columns = [15,16,17,18,19];
//        $columns = [10, 11, 12, 13, 14, 15, 16, 17, 18];

        foreach ($rows as $row) {
            foreach ($columns as $column) {
                $hall->seats()->create([
                    'status' => HallEnum::ACTIVE_STATUS,
                    'block'  => 5,
                    'row'    => $row,
                    'column' => $column,
                    'cost'   => 450000
                ]);
            }
        }
    }
}
