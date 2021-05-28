<?php

namespace LaraJar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaxJarApiLog extends Model
{
    protected $table = 'taxjar_api_logs';

    public $timestamps = false;

    protected $casts = [
        'sent_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'api_endpoint',
        'method',
        'payload_sent',
        'response_code',
        'payload_received',
        'sent_at',
        'received_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            config('taxjar.model_names.log_owner'),
            'log_owner_id',
            config('taxjar.column_names.log_owner_key')
        );
    }
}
