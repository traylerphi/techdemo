<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        

        DB::table('tasks')->insert([
            'task'  => "Top Level 1",
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Top Level 2",
            'order' => 2
        ]);
        DB::table('tasks')->insert([
            'task' => "Sub 1:1 (3)",
            'parent_task_id' => 1,
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Sub 3:1 (4)",
            'parent_task_id' => 3,
            'order' => 1
        ]);
    }
}
