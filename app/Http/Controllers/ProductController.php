<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Count;
use App\Http\Requests\CartRequest;
use App\Http\Requests\CommentRequest;
use App\Services\Mail;

class ProductController extends Controller
{

    protected $repository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $repository)
    {
        // $this->middleware('auth');
        $this->repository = $repository;
    }

    /**
     * Show the home-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    public function index(Request $request, ProductRepository $repository) //$request->more = true
    {
        // $products = $this->repository->funcSelect($request);
  $products = $repository->funcSelect($request); //[]
  // $cartCount = Cart::where('user_id', \auth()->user()->id)->count();

  // Ajax response
  if ($request->ajax()) {
    return response()->json([
        'table' => view("product.brick-standard", ['products' => $products])->render(),
    ]);
}
        // return view('product.index', ['products'=> $products]);
         return view('product.index', compact('products')); //compact('products, cartCount')
    }
    /* Show the product-page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function product(Request $request, Product $modelProduct)  //($id)
   {

       $product = $modelProduct->with('counts')
                    ->find($request->id);//null
      //  $cartCount = Cart::where('user_id', \auth()->user()->id)->count();

       //$product = Product::find($request->id)
       $rating = $this->repository->funcGetRating($request);
       $sizes = $this->repository->funcSelectSize($request);

       if ($product == null) { //!!!
        return view('404');
     } else {
        return view('product.product', ['product' => $product, 'rating' => $rating, 'sizes' => $sizes]);
     }
    //    return view('product.product', compact('product'));
   }


    /* Show the comment-page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function comment(Request $request)  //($id)
    {
 
        $product =$this->repository->funcSelectComment($request);//null
       
        if ($product == null) { //!!!
         return view('404');
      } else {
         return view('product.comment', ['product' => $product]);
      }
     //    return view('product.product', compact('product'));
    }

    /* Store item  to comment-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function addcomment(CommentRequest $request) 
  {
    $this->repository->funcStoreComment($request);
    //...
      return $this->repository->funcSelectComment($request);
      
  }

  /* Clear one item from comment-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable 
   */
  public function removecomment(Request $request)
  {
     $commentOne = Comment::find($request->commentId);

    $this->authorize('manage', $commentOne);
    $commentOne->delete();
   
  
    return $this->repository->funcSelectComment($request);
  }

   /* Show the cart-page.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function cart(Request $request)
  {
    
    $carts = $this->repository->funcSelectCart();

    // $cartCount = Cart::where('user_id', \auth()->user()->id)->count();

// Ajax response //!!!ajax
    if ($request->ajax()) {
      return response()->json([
          'table' => view("product.cart-standard", ['carts' => $carts])->render(), //!!!cart-standard, 'carts' => $carts
      ]);
  }

      return view('product.cart', ['carts' => $carts]); // compact('carts', 'cartCount')
  }
   /* Store item  to cart-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function tocart(CartRequest $request) //$request->product_id
  {
    $this->repository->funcStore($request);
    //...
      return redirect(route('cart'));
  }


    /* Clear all from cart-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function clearall(Request $request, Cart $cart)
  {
    //  $cart->truncate();
    $cart->where('user_id', \auth()->user()->id)->delete();
   
      // return redirect(route('cart'));

      foreach ($request->carts as $cart){
        $this->repository->countDecrementIncrement(json_decode(json_encode($cart)), 'increment');
      }
      return $this->repository->funcSelectCart();
  }

     /* Clear one item from cart-table.
   *
   * @return \Illuminate\Contracts\Support\Renderable 
   */
  public function clearone(Request $request, Cart $cart)
  {
     $cartOne = $cart 
                      // ->where('user_id', \auth()->user()->id)->delete();
                      ->find($request->id);

                 
    // if ($cartOne) $cartOne->delete();
    $this->authorize('manage', $cartOne);
    $cartOne->delete();

//     $countSizeProduct = Count::where('product_id', $request->product_id)
//     ->where('size_id', $request->size_id)
//     ->first();

// $countSizeProduct->count = $countSizeProduct->count + 1;
// $countSizeProduct->save();
$this->repository->countDecrementIncrement($request, 'increment');

   
    //  return $this->cart($request);
    return $this->repository->funcSelectCart();
  }
    /* Send message to admin.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function mailer(Request $request, Mail $mailer)
  {
     return $mailer->funcSend($request->message, $request->contact );
  }



}
