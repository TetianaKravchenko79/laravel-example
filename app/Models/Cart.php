<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $fillable = [
        'product_id' //!!!
   ];


   public function product()
    {
        //return $this->belongsTo('App\Models\Product'); //!!!АНАЛОГ join
        return $this->belongsTo(Product::class); //!!!product_id(Cart) -> id(Product)
        //return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }


    public static function cartCount()
    {
        return self::where('user_id', \auth()->user()->id)->count();
    }

}
