<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiMonitor extends Model
{
    protected $fillable = [
        'client_id',
        'project_id',
        'name',
        'url',
        'method',
        'expected_status',
        'timeout_seconds',
        'is_active',
        'last_status',
        'last_checked_at',
    ];

    protected function casts(): array
    {
        return [
            'expected_status' => 'integer',
            'timeout_seconds' => 'integer',
            'is_active' => 'boolean',
            'last_checked_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(ApiMonitorLog::class);
    }
}
