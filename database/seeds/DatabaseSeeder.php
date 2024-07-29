<?php

use Illuminate\Database\Seeder;
//use App\Models\Product;
//use App\Models\Cart;
//use App\Models\Comment;
//use App\Models\Size;
use App\Models\Count;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        Product::create(
            [
                'name' => 'Костюм "Лора"',
                'price' => '19.99',
                'image' => 'product_1.jpg',
                'top9' => 1,
            ]
        ); 
        Product::create(
            [
                'name' => 'Костюм "Кимоно"',
                'price' => '22.99',
                'image' => 'product_2.jpg',
                'top9' => 1,
            ]
        );  
        Product::create(
            [
                'name' => 'Блуза "Бриз"',
                'price' => '7.99',
                'image' => 'product_3.jpg',
                'top9' => 1,
            ]
        ); 
        */

        /*
        Comment::create(
            [
                'user_id' => 63, //!!!see real id
                'product_id' => 3,
                'comment' => "admin's comment of product_3",
            ]
        ); 
        Comment::create(
            [
                'user_id' => 64, //!!!see real id
                'product_id' => 3,
                'comment' => "user's comment of product_3",
            ]
        );  
        Comment::create(
            [
                'user_id' => 63, //!!!see real id
                'product_id' => 8,
                'comment' => "admin's comment of product_8",
            ]
        ); 
        */
        
        /*
        Size::create(
            [
                'name' => 'XS',
                'default' => '0',
            ]
        ); 
        Size::create(
            [
                'name' => 'S',
                'default' => '1',
            ]
        );   
        Size::create(
            [
                'name' => 'M',
                'default' => '0',
            ]
        ); 
        Size::create(
            [
                'name' => 'L',
                'default' => '0',
            ]
        ); 
        Size::create(
            [
                'name' => 'XL',
                'default' => '0',
            ]
        ); 
        Size::create(
            [
                'name' => 'XXL',
                'default' => '0',
            ]
        ); 
        */   
        
        Count::create(
            [
                'product_id' => 3,
                'size_id' => 2,
                'count' => 7,
            ]
        ); 
        Count::create(
            [
                'product_id' => 3,
                'size_id' => 3,
                'count' => 5,
            ]
        ); 
        Count::create(
            [
                'product_id' => 3,
                'size_id' => 4,
                'count' => 6,               
            ]
        );
        Count::create(
            [
                'product_id' => 8,
                'size_id' => 2,
                'count' => 7,
            ]
        ); 
        Count::create(
            [
                'product_id' => 8,
                'size_id' => 3,
                'count' => 5,
            ]
        ); 
        Count::create(
            [
                'product_id' => 8,
                'size_id' => 4,
                'count' => 6,               
            ]
        );
        Count::create(
            [
                'product_id' => 6,
                'size_id' => 2,
                'count' => 7,
            ]
        ); 
        Count::create(
            [
                'product_id' => 6,
                'size_id' => 3,
                'count' => 5,
            ]
        ); 
        Count::create(
            [
                'product_id' => 6,
                'size_id' => 4,
                'count' => 6,               
            ]
        );          
    }
}
