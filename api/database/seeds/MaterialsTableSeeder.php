<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('learning_materials')->insert([
            [
                'name' => 'File1',
                'path' => 'Filepath1',
                'user_id' => 1
            ],
            [
                'name' => 'File2',
                'path' => 'Filepath2',
                'user_id' => 1
            ],
            [
                'name' => 'File3',
                'path' => 'Filepath3',
                'user_id' => 1
            ],
            [
                'name' => 'File4',
                'path' => 'Filepath4',
                'user_id' => 1
            ]
        ]);
    }
}
