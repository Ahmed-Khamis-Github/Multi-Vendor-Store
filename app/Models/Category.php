<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable= ['name' ,'slug' ,'parent_id','description','image','status'] ;


    public function scopeSearch(Builder $builder,$filters){

        $builder->when($filters['search'] ?? false,function($builder ,$value){
                 $builder->where('name','like',"%$value%") ;
            
        }) ;

    }


    public function products(){
        return $this->hasMany(Product::class) ;
    }


    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')->withDefault([
            'name'=>'Main Category'
        ]) ;
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id','id') ;
    }

 
}


