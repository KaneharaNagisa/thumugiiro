<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'client_id',
        'project_id',
        'type',
        'category',
        'transaction_date',
        'amount',
        'tax_amount',
        'status',
        'paid_at',
        'invoice_number',
        'business_ratio',
        'receipt_path',
        'memo',
    ];

    protected function casts(): array
    {
        return [
            'transaction_date' => 'date',
            'amount' => 'integer',
            'tax_amount' => 'integer',
            'paid_at' => 'date',
            'business_ratio' => 'decimal:2',
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
}
