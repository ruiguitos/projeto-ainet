<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'nif', 'address', 'payment_type', 'payment_ref'];

    public function userRef(){
        return $this->belongsTo(User::Class, 'id', 'id');
    }

    public function order(){
        return $this->hasMany(Encomenda::Class);
    }
}
