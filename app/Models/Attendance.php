<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'empId',
        'check_in_branch_id',
        'check_out_branch_id',
        'photo_path',
        'check_out_photo_path',
        'latitude',
        'longitude',
        'check_out_latitude',
        'check_out_longitude',
        'check_in_date',
        'check_in_time',
        'check_in_distance',
        'check_out_date',
        'check_out_time',
        'check_out_distance',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'empId', 'empId');
    }

    public function checkInBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'check_in_branch_id', 'branchId');
    }

    public function checkOutBranch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'check_out_branch_id', 'branchId');
    }
}
