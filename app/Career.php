<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'type',
        'department',
        'salary_min',
        'salary_max',
        'deadline',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at'
    ];

    public function adminCreated()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function adminUpdated()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    // Scope for active careers
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

