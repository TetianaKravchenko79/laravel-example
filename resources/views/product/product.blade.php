@extends('product.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/product.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/product_responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/qty.css') }}">


@endsection
@section('main')

<div class="super_container_inner">
        <div class="super_overlay"></div>

		<!-- Product -->

		<div class="product">
			<div class="container">
			@if ($errors->any())
                    @component('product.components.alert')
                        @slot('type')
                            danger
                        @endslot
                      @foreach ($errors->all() as $error)
                          {{ $error }}<br>
                      @endforeach
                    @endcomponent
                @endif

			
				<div class="row">

                    <!-- Product Info -->

					<!-- @php 


					print_r($sizes->toArray());
					@endphp -->

					<!-- Product image <div class="col-lg-6 product_image"><img src="" />... -->
					<div class="col-lg-6 product_image">
                       <img src="{{ asset('images/' . $product->image) }}" />
					</div>

					<div class="col-lg-6 product_col">
						<div class="product_info">
                            <!-- Product name <div class="product_name"></div> -->
							<div class="product_name">{{$product->name}}</div>
							<div class="product_category">В <a href="#">Катагории</a></div>
							<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
								<div class="rating_r rating_r_{{ceil($rating['ratingComments'])}} product_rating"><i></i><i></i><i></i><i></i><i></i></div>
								<div class="product_reviews">{{ceil($rating['ratingComments'])}} из ({{$rating['countComments']}})</div>
								<div class="product_reviews_link"><a href="{{route('comment', [$product->id])}}">Отзывы</a></div>
							</div>
                            <!-- Product price <div class="product_price"></div> -->
							<div class="product_price">{{$product->price}}</div>
							<div class="product_size">

							@if ($product->counts->count()) 
								<div class="product_size_title">Выберите Размер</div>
								<ul class="d-flex flex-row align-items-start justify-content-start">

									@foreach ($product->counts as $count)

									<li>

									@if ($count->size->default)

								@php
									$sizeDefault = $count->size->id;

								@endphp
					


										<input type="radio" checked id="radio_{{$count->size->id}}" name="product_radio" class="regular_radio radio_{{$count->size->id}}" value="{{$count->size->id}}">
										@else

										<input type="radio" id="radio_{{$count->size->id}}" name="product_radio" class="regular_radio radio_{{$count->size->id}}"   value="{{$count->size->id}}">
										@endif
										<label for="radio_{{$count->size->id}}">{{$count->size->name}}</label>
									</li>
									@endforeach

								</ul>

								@else 
								<div class="product_size_title">Сейчас товар отсутствует</div>

								@endif
							</div>

							<div class="product_quantity mr-lg-auto text-center">
								<span class="product_text product_num">1</span>
								<div class="qty_sub qty_button trans_200 text-center"><span>-</span></div>
								<div class="qty_add qty_button trans_200 text-center"><span>+</span></div>
							</div>
							<div class="product_text">
								<p>Удобная и недорогая одежда отличного качества от мировых брендов. Может быть вполне уместна как для повседневного ношения, так и для неформальных меропрятий праздничного характера. В изготовлении использованы только экологически чистые материалы (хлопок, лен, шерсть), которые не только отлично носятся, но и без особо труда поддаются стирке и чистке даже в домашних условиях.</p>
							</div>
							<div class="product_buttons">
								<div class="text-right d-flex flex-row align-items-start justify-content-start">
								@if ($product->counts->count()) 
									<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
										<div><div><img src="{{ asset('images/cart.svg') }}" class="svg" alt=""><div>+</div></div></div>
									</div>

									<form name="form_tocart" method="post" action="{{route('tocart')}}" style="display: none;">
                                            {{ csrf_field() }}
                                       <input type="hidden" name="product_id" value="{{ $product->id }}" />  
									   
									   <input type="hidden" name="size_id" value="@php if(isset($sizeDefault)) echo $sizeDefault; @endphp" />  
									   <input type="hidden" name="qty" value="1" />
                                    </form>

									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

@endsection

@section('js')

<script src="{{ asset('js/qty.js') }}"></script>
<script>
$(document).ready(function(){
   $('.product_button.product_cart').click(function(){
      form_tocart.submit();   
   });
   $('.product_size input').click(function(){
      form_tocart.size_id.value = $(this).attr('value');   
   });
});
</script>

@endsection