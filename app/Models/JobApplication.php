<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public const STATUSES = [
        'en_attente' => 'En attente',
        'entretien' => 'Entretien',
        'refusee' => 'Refusée',
        'acceptee' => 'Acceptée',
    ];

    protected $fillable = [
        'company',
        'position',
        'status',
        'applied_at',
        'salary_range',
        'offer_url',
        'notes',
    ];

    protected $casts = [
        'applied_at' => 'date',
    ];

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
