<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => "Student",
                'shorthand_code' => "STD"
            ],
            [
                'name' => "Administrator",
                'shorthand_code' => "ADM"
            ],
            [
                'name' => "Company Delegate",
                'shorthand_code' => "CDE"
            ],
            [
               'name' => "Lecturer",
                'shorthand_code' => "LEC"
            ]
        ]);
    }
}
