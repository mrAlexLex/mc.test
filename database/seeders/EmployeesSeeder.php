<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'name' => Str::random(10),
            'surname' => Str::random(10),
            'patronymic' => Str::random(10),
            'gender' => rand(0, 1) ? 'male' : 'female',
            'wage' => 111.11,
        ]);
    }
}
