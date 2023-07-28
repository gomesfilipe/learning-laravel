<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    // Criando relacionamentos entre as models
    public function series() {
        return $this->belongsTo(Series::class);
    }

    public function episodes() {
        return $this->hasMany(Episode::class);
    }
}