<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class EncomendaStatus extends Model{

    use HasFactory;

    protected $table = 'orders';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'order_id',
        'tshirt_image_id',
        'color_code',
        'size',
        'qty',
        'unit_price',
        'sub_total',
    ];

    public function tshirt(): HasMany{

        return $this->hasMany(Tshirt::class, 'order_id', 'id');
    }

    public function customerRef(): BelongsTo{

        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

}
