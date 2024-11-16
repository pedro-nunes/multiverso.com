<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'main',
        'type',
        'responsible',
        'phone',
        'zip',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'information',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getResponsibleAttribute($value)
    {
        return ucwords($value);
    }

    public function getTypeAttribute($value)
    {
        return ucwords($value);
    }

    public function getComplementAttribute($value)
    {
        return ucwords($value);
    }

    public function getDistrictAttribute($value)
    {
        return ucwords($value);
    }

    public function getCityAttribute($value)
    {
        return ucwords($value);
    }

    public function getStateAttribute($value)
    {
        return strtoupper($value);
    }
}