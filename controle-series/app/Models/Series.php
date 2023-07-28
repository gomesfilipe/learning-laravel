<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome']; // Pega somente o campo nome num mass assignment

    public function seasons() {
        return $this->hasMany(Season::class, 'series_id'); // series_id é o nome da chave estrangeira
    }

    // Escopo global de todas as buscas dessa model. Nesse caso, sempre ordenará as séries pelo nome.
    protected static function booted() {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }
}
