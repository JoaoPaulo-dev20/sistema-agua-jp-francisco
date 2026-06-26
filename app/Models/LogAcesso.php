<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAcesso extends Model
{
    protected $table = 'log_acessos';
    protected $fillable = ['user_id', 'consumidor_id', 'acao'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function consumidor(): BelongsTo
    {
        return $this->belongsTo(Consumidor::class);
    }
}
