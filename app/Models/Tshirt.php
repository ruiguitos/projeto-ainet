<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tshirt extends Model{

    use HasFactory;

    protected $table = 'order_items';
    public $timestamps = false;
    protected $fillable = [
        'id' ,
        'order_id',
        'tshirt_image_id',
        'color_code',
        'size',
        'qty',
        'unit_price',
        'sub_total'
    ];

    public function orderId(): BelongsTo{
        return $this->belongsTo(Encomenda::Class);
    }

    public function tshirt_images(): BelongsTo{
        return $this->belongsTo(Imagem::Class, "tshirt_image", 'id');
    }

    public function colorCode(): BelongsTo{
        return $this->belongsTo(Cor::Class,"color_code",'code'); //->withTrashed();
    }


}
