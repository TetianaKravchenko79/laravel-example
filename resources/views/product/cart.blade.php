@extends('product.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">

<style>
    .listbuttonremove {
	margin: 10px;   
}
</style>
@endsection
@section('main')

<div class="cart_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="cart_container">

                        <script>
                                window.carts = @json($carts); //!!!variable from php to js in blade
                            </script>
                            
                            <!-- Cart Block -->
                            <div class="cart_block">
                                <!-- <ul class="cart_items_list">

                               
                                </ul> -->
                            </div>
                            <!-- Cart Buttons -->
                            <!-- <div class="cart_buttons d-flex flex-row align-items-start justify-content-start">
                                <div class="cart_buttons_inner ml-sm-auto d-flex flex-row align-items-start justify-content-start flex-wrap">
                                    <div class="button button_clear trans_200"><a href="#">clear</a></div>
                                </div>
                            </div>  
                            
                            <form name="form_clearall" method="post" action="{{ route('clearall') }}" style="display: none;">
                                            {{ csrf_field() }}     
                              </form>                                   -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>             

@endsection

@section('js')

<!--<script src="{{ mix('js/cart.js') }}"></script> -->
<script src="{{ mix('js/cartvue.js') }}"></script>
<!--

<script src="{{ asset('js/mainCart.js') }}"></script>
<script>
$(document).ready(function(){
   $('.button_clear').click(function(){
      form_clearall.submit(); 
      return false; //!!!<a href="#">... 
   });

//    $('.listbuttonremove').click(function(){
//     $('body').on('click', '.listbuttonremove', function() { //!!!new event
//       BaseRecord.clearone($(this).attr('id')); //!!!
//       return false;
//    });
});

</script>

-->



@endsection