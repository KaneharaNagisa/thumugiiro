<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'category',
        'status',
        'amount',
        'start_date',
        'due_date',
        'completed_at',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'start_date' => 'date',
            'due_date' => 'date',
            'completed_at' => 'date',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function apiMonitors(): HasMany
    {
        return $this->hasMany(ApiMonitor::class);
    }
}
