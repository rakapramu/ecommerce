<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'qty'];

    // relasi ke tabel product
    public function Product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
