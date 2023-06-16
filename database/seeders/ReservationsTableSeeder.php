<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationsTableSeeder extends Seeder
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
            // 平日のみ予約枠を生成する
            if ($current_date->isWeekday()) {
                // 10:00の予約枠を作成
                Reservation::create([
                    'start_time' => $current_date->copy()->setHour(10)->setMinute(0)->toDateTime(),
                    'end_time' => $current_date->copy()->setHour(11)->setMinute(30)->toDateTime(),
                ]);

                // 13:00の予約枠を作成
                Reservation::create([
                    'start_time' => $current_date->copy()->setHour(13)->setMinute(0)->toDateTime(),
                    'end_time' => $current_date->copy()->setHour(14)->setMinute(30)->toDateTime(),
                ]);

                // 15:00の予約枠を作成
                Reservation::create([
                    'start_time' => $current_date->copy()->setHour(15)->setMinute(0)->toDateTime(),
                    'end_time' => $current_date->copy()->setHour(16)->setMinute(30)->toDateTime(),
                ]);
            }

            $current_date->addDay();
        }
    }
}
