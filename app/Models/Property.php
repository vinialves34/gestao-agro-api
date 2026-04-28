<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'producer_id',
        'name',
        'city',
        'state',
        'state_registration',
        'total_area',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are allowed for filtering.
     *
     * @var array<int, string>
     */
    protected $allowedFilters = [
        'name',
        'city',
        'state',
        'state_registration',
        'total_area',
    ];

    /**
     * Get the rural producer that owns the property.
     */
    public function ruralProducer(): BelongsTo
    {
        return $this->belongsTo(RuralProducer::class, 'producer_id');
    }

    /**
     * Get the herds for the property.
     */
    public function herds()
    {
        return $this->hasMany(Herd::class);
    }
}
