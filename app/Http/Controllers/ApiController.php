<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Make login-api.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (! \Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }
       
        return response()->json([
            'token_type' => 'Bearer',
            'name' => \Auth::user()->name,
            'api_token' => \Auth::user()->api_token, //!!!
        ], 200);
    }

    /**
     * Show the dashboard-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::get();

        return response()->json([
            'table' => view("api.api-standard", ['products' => $products])->render(),
        ]);
    }

    /**
     * Delete item from the dashboard-page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Product $product)
    {
       //...
    } 

    /**
     * Store a newly created product in storage.
     *
     * @return \Illuminate\Http\Response
     */      
    public function store(Request $request)
    {
       //...
    }  

    /**
     * Edit-view for selected product.
     *
     * @param  ...
     * @return \Illuminate\Http\Response
     */      
    public function show(Product $product)
    {
       //...
    }  

    /**
     * Update selected product in storage.
     *
     * @return \Illuminate\Http\Response
     */      
    public function update(Request $request, Product $product)
    {
       //...
    }      
}
