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
     * Get the rural producer that owns the property.
     */
    public function producer(): BelongsTo
    {
        return $this->belongsTo(RuralProducer::class);
    }

    /**
     * Get the herds for the property.
     */
    public function herds()
    {
        return $this->hasMany(Herd::class);
    }
}
