<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Encomenda extends Model{

    use HasFactory;

    protected $table = 'orders';

    public $timestamps = false;

    protected $fillable = [
        'status',
        'customer_id',
        'date',
        'total_price',
        'notes',
        'nif',
        'address',
        'payment_type',
        'payment_ref',
        'receipt_url'
    ];

    public function tshirt(): HasMany{

        return $this->hasMany(Imagem::class, 'order_id', 'id');
    }

    public function customerRef(): BelongsTo{

        return $this->belongsTo(Cliente::class, 'customer_id', 'id');
    }

}
