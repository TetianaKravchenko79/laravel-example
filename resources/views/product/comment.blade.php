@extends('product.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/comment.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/comment_responsive.css') }}">
<style>
.fa-trash-o {
  font-size:26px;
  color:red;
  cursor: pointer;
}
</style>    
@endsection

@section('main')

        <div class="comment_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="comment_container">
                            <hr> 

                            @php
                            //print_r($product->comments->toArray()); 
                            @endphp

                            <div class="cart_item item_list d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-end justify-content-start" style="width: 50%;">
                                <div class="product d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start mr-auto">
                                    <div><div class="product_image"><img src="{{ asset('images/' . $product->image) }}" alt=""></div></div>
                                    <div class="product_name_container">
                                        <div class="product_name"><a href="{{route('product', [$product->id])}}">{{$product->name}}</a></div>
                                    </div>
                                </div>
                            </div>                      

                            <script>
                                window.user = @json(auth()->user());
                               window.product = @json($product);//... //!!!variable from php to js in blade
                            </script>                              

                            <!-- !!!Comment block -->
                            <div class="comment_block">
                                                               
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div> 

@endsection

@section('js')
<script src="{{ mix('js/comment.js') }}"></script>
@endsection