<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TaskStatus
 *
 * @property mixed $tasks
 */

class Label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task');
    }
}
