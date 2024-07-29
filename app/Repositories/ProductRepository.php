<?php

namespace App\Repositories;

use App\Models\ {
    Product, 
    Cart, 
    Comment,
    Size, 
    Count
};

class ProductRepository
{
    /**
     * The Model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelProduct;
    protected $modelCart;
    protected $modelComment;
    protected $modelSize;


    /**
     * Create a new ProductRepository instance.
     *
     * @param  \App\Models\Product $product
     */
    public function __construct(Product $product, Cart $cart, Comment $comment, Size $size)
    {
        $this->modelProduct = $product;
        $this->modelCart = $cart;
        $this->modelComment = $comment;
        $this->modelSize = $size;
    }

    /**
     * Create a query for Product.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function funcSelect($request)
    {


        // $query = $this->model
        //     ->select('id', 'name', 'price', 'image');
        // return $query->get();

        // return Product::select('id', 'name', 'price', 'image')->get();        ////(2 variant)

        // return $this->model->get();  //return Product::get();                 //////(3variant)
        
        
        /*return $this->model
                    ->where('top9', 1)  //->where('top9',  '!=',  1), >, <
                    ->orderBy('price', 'asc')
                    ->get();  

                    */

                    $query = $this->modelProduct->orderBy('price', 'asc');

        if (! isset($request->more)) {
           $query = $query->where('top9', 1);
        }
        if(isset($request->search) && $request->search) $query = $query->where('name', 'like', '%' . $request->search . '%');

        return $query->get();


    }
     /* Store item  to cart-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function funcStore($request) //$request->product_id
  {
    // Cart::create($request->all());// for all fields

    $this->modelCart->product_id = $request->product_id;
    $this->modelCart->size_id = $request->size_id;
    $this->modelCart->qty = $request->qty;
    $this->modelCart->user_id = auth()->user()->id; //!!! or \Auth::user()->id;
    $this->modelCart->save();
//     $countSizeProduct = Count::where('product_id', $request->product_id)
//     ->where('size_id', $request->size_id)
//     ->first();

// $countSizeProduct->count = $countSizeProduct->count - 1;
// $countSizeProduct->save();
$this->countDecrementIncrement($request, 'decrement');
  }

    /* Get items  from cart-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function funcSelectCart() 
  {

    /*
    return  \DB::table('carts')
            ->select('carts.id as id', 'products.name as name', 'products.price as price', 'products.image as image')        
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->orderBy('products.price') //'desc'
            ->get();
    */


    return $this->modelCart
          ->with('product') //->doesntHave('product')
          ->with('size')
          ->where('user_id', \auth()->user()->id)
          ->get()
          ->sortBy('product.price')
          ->values();

  }
 /* Get items  from product-comment-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function funcSelectComment($request) 
  {
    return $this->modelProduct

          ->with('comments.user')
          ->find($request->id);        
          
  }


  /* Get items  from size-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function funcSelectSize($request) 
  {
    return $this->modelSize

          ->get();        
          
  }

      /* Store item  to comment-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function funcStoreComment($request) 
{
    $this->modelComment->product_id = $request->id;
    $this->modelComment->user_id = auth()->user()->id; //!!! or \Auth::user()->id;
    $this->modelComment->comment = $request->comment;
    $this->modelComment->rating = $request->rating;
    $this->modelComment->save();

  }
  /**
     * Get rating product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcGetRating($request)
    {
       $product = $this->funcSelectComment($request);

       $countComments = $product->comments->count();
       $sumRating = 0;
       foreach ($product->comments as $comment) {
          $sumRating += $comment->rating;   
       }

       if ($countComments) $ratingComments = $sumRating / $countComments; 
       else $ratingComments = 0;

       return ['countComments' => $countComments, 'ratingComments' => $ratingComments];
    }

    /**
     * Decrement-Increment count
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function countDecrementIncrement($request, $operation)
    {
       $countSizeProduct = Count::where('product_id', $request->product_id)
                     ->where('size_id', $request->size_id)
                     ->first();

       if ($operation == 'decrement') $countSizeProduct->count = $countSizeProduct->count - $request->qty;
       if ($operation == 'increment') $countSizeProduct->count = $countSizeProduct->count + $request->qty;
       $countSizeProduct->save(); 
    }

}
