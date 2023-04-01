<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property TaskStatus $status
 * @property User $created_by
 * @property User $assigned_to
 * @property mixed $labels
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status_id', 'assigned_to_id', 'labels'];

    public function created_by()            // phpcs:ignore
    {
        return $this->belongsTo('App\Models\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\TaskStatus');
    }

    public function assigned_to()          // phpcs:ignore
    {
        return $this->belongsTo('App\Models\\User');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
    }
}
