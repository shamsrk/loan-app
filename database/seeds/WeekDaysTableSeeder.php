<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class WeekDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $week_days = [];
        foreach (Config::get('constants.week_days') as $day) {
            $week_days[] = ['day' => $day];
        }

        DB::table('week_days')->insert($week_days);
    }
}
