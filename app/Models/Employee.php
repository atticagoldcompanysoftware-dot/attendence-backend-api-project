<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'employee';

    public $timestamps = false;

    protected $fillable = [
        'empId',
        'name',
        'contact',
        'address',
        'designation',
        'status',
        'salary',
        'doj',
        'shift_timing',
        'gender',
        'marital_status',
        'remark',
    ];

    protected $hidden = [];
}
