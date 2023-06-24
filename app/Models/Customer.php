<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Customer extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $table = 'customers';

    protected $fillable = [
        'id',
        'nif',
        'address',
        'default_payment_type',
        'default_payment_ref'
    ];

    public function userId(): BelongsTo{
        return $this->belongsTo(User::Class);
    }

    public function order(): HasMany{
        return $this->hasMany(Encomenda::Class, 'id', 'id');
    }

    public function tshirtImage(): HasMany{
        return $this->hasMany(Imagem::class, 'customer_id', 'id');
    }
}
