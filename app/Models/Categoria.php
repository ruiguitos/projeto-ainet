<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
    ];

    public function catalogo()
    {
        return $this->hasMany(Catalogo::class);
    }
}
