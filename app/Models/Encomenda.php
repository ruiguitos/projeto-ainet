<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Encomenda extends Model{

    use HasFactory;

    use SoftDeletes;

    protected $table = 'orders';

    public $timestamps = false;

    protected $fillable = [
        'id',
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

        return $this->hasMany(Tshirt::class, 'order_id', 'id');
    }

    public function customerRef(): BelongsTo{

        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}
