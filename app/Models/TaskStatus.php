<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tasks()
    {
        // каждый статус может содержаться в множестве задач
        // hasMany определяется у модели, имеющей внешние ключи в других таблицах
        return $this->hasMany('App\Models\Task', 'status_id');
    }
}
