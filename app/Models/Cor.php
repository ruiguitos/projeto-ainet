<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Cor extends Model{
    use HasFactory;


    protected $table = 'colors';

    protected $keyType = 'string';

    protected $primaryKey = 'code';

    protected $fillable = [
        'code',
        'name'
    ];

    public $timestamps = false;

    public function getCor(): HasMany{
        return $this->hasMany(Tshirt::Class, 'color_code', 'code');
    }

}
