<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sales;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start_date = Carbon::create(2023, 6, 1); // 開始日
        $end_date = Carbon::create(2025, 12, 31); // 終了日
        
        $current_date = $start_date;
        
        while ($current_date <= $end_date) {
            if ($current_date->isWeekday()) {
                Sales::create([
                    'sales_date' => $current_date->toDateString(),
                    'price' => 0,
                ]);
            }
        
            $current_date->addDay();
        }
    }
}
