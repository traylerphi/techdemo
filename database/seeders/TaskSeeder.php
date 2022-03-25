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
            'order' => 2
        ]);
        DB::table('tasks')->insert([
            'task' => "Top Level 2",
            'order' => 3
        ]);
        DB::table('tasks')->insert([
            'task' => "Sub 1:1 (3)",
            'parent_task_id' => 1,
            'status' => 'complete',
            'completion' => '2022-03-25 10:00',
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Sub 3:1 (4)",
            'parent_task_id' => 3,
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Finish ToDo List Example",
            'note' => "No longer eligible for FACS review, but still worthwhile task",
            'due' => "2022-04-01 17:00",
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Update Tasks",
            'parent_task_id' => 5,
            'order' => 1
        ]);
        DB::table('tasks')->insert([
            'task' => "Create Tasks",
            'parent_task_id' => 5,
            'order' => 2
        ]);
        DB::table('tasks')->insert([
            'task' => "Delete Tasks",
            'parent_task_id' => 5,
            'order' => 3
        ]);
        DB::table('tasks')->insert([
            'task' => "Re-Order Tasks",
            'parent_task_id' => 5,
            'order' => 4
        ]);
    }
}
