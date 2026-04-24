<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuralProducer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cpf_cnpj',
        'phone',
        'email',
        'address',
    ];

    /**
     * The attributes that are allowed for filtering.
     *
     * @var array<int, string>
     */
    protected $allowedFilters = [
        'name',
        'cpf_cnpj',
        'phone',
        'email',
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
    * Get the properties for the rural producer.
    */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
