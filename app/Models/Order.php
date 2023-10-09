<?php

namespace App\Models;

use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable= [
        'store_id','user_id','payment_method','status','payment_status'
    ] ;


    public function store()
    {
        return $this->belongsTo(Store::class) ;
    }

    public function products()
    {
        return $this->hasMany(Product::class,'order_items')->using(OrderItems::class)->withPivot([
            'quantity' ,'product_name','price','options'
        ]) ;
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class) ;
    }


    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type','=','billing') ;
    }



    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type','=','shipping') ;
    }


    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'Guest'
        ]) ;


    }

    protected static function booted()
    {
        static::creating(function(Order $order){
            $order->number = Order::getNextOrderNumber() ;
        }) ;
    }

    public static function getNextOrderNumber()
    {
        $year= Carbon::now()->year ;
        $number =Order::whereYear('created_at',$year)->max('number') ;
        if($number)
        {
            return $number + 1 ;
        }

        return $year . "0001" ;

    }

}
