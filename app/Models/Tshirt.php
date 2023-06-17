<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TShirt extends Model
{
    protected $table = 'tshirt_images'; // Replace 'tshirts' with the actual table name in your database

    protected $fillable = [
        'id',
        'name',
        'image_url',
        'description'
        // Add other columns of your tshirt table here
    ];
}
