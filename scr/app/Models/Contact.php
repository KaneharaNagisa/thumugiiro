<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'name',
        'email',
        'company_name',
        'budget',
        'desired_deadline',
        'message',
        'status',
        'admin_notes',
        'handled_at',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'integer',
            'desired_deadline' => 'date',
            'handled_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
