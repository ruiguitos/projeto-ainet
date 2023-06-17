<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Imagem extends Model
{

    use HasFactory, SoftDeletes;

    protected $table = 'tshirt_images';

    protected $fillable = ['customer_id', 'category_id', 'name', 'description', 'image_url', 'extra_info'];

    public function tshirt(): HasMany
    {
        return $this->hasMany(Imagem::Class);
    }

    public function costumerId(): BelongsTo
    {
        return $this->belongsTo(Cliente::Class, 'customer_id', 'id');
    }

    public function categoryId() : BelongsTo
    {
        return $this->belongsTo(Categoria::Class, 'category_id', 'id');
    }
}
