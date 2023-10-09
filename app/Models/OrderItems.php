<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderItems extends Pivot
{
    use HasFactory;

    public $timestamps = false;


    protected $table = 'order_items';

    public $incrementing = true;


    public function products()
    {
        return $this->hasMany(Product::class)->withDefault([
            'name' => $this->product_name
        ]);
    }
}
