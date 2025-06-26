<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_type',
        'week_start',
        'day',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
} 