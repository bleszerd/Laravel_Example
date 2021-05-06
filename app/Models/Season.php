<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'number'
    ];

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
