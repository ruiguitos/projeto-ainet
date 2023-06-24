<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;



class Categoria extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
    ];

    public function catalogo(): HasMany
    {
        return $this->hasMany(Imagem::class);
    }
}
