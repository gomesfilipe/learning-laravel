<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover']; // Pega somente o campo nome e cover num mass assignment
    // protected $appends = ['links'];


    public function seasons() {
        return $this->hasMany(Season::class, 'series_id'); // series_id é o nome da chave estrangeira
    }

    public function episodes() {
        // Relacionamento transitivo entre séries e episódios
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    // Escopo global de todas as buscas dessa model. Nesse caso, sempre ordenará as séries pelo nome.
    protected static function booted() {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }

    // Colocar links no json de resposta de get das requisições para auxiliar o cliente
    // Obs: Pode não ser uma boa prática, pois mistura a lógica das models com resposta de requisições.
    // public function links(): Attribute {
    //     return new Attribute(
    //         get: fn () => [
    //             [
    //                 'rel' => 'self',
    //                 'url' => "/api/series/{$this->id}"
    //             ],
    //             [
    //                 'rel' => 'seasons',
    //                 'url' => "/api/series/{$this->id}/seasons"
    //             ],
    //             [
    //                 'rel' => 'episodes',
    //                 'url' => "/api/series/{$this->id}/episodes"
    //             ],
    //         ]
    //     );
    // }
}
