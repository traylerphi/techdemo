<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $fillable = [
        'parent_task_id','task','note','order','status','due','completion'
    ];

    protected $with = [
	    'subtasks'
	];

	protected $casts = [
		'due' => 'datetime:Y-m-d\TH:00',
	];

    public function subtasks()
    {
    	return $this->hasMany('App\Models\Task', 'parent_task_id', 'id')->orderBy('completion')->orderBy('due')->with('subtasks');
    }
}
