@extends('product.layout')

@section('css')
<style>
.mr-auto {
   margin-bottom: 1em;	
}
</style>
@endsection

@section('main')

<div class="super_container_inner">
    <div class="super_overlay"></div>
    
        <!-- Products -->

        <div class="products">
			<div class="container">
				<div class="row products_row">
                    @php 
                   // print_r($products); 
                    @endphp
                    

                    @include('product.brick-standard')

                      

				</div>
			  </div>
			</div>
        </div>

        <div class="button load_more ml-auto mr-auto"><a href="#" class="link_again">more</a></div> 
</div>

@endsection

@section('js')


<script src="{{ asset('js/mainIndex.js') }}"></script>
<script>
$(document).ready(function(){
   $('.load_more').click(function(){
      BaseRecord.more = true;
      BaseRecord.showMore();
      return false;
   });
   $('.header_search_button').click(function() { //if ($('.search_input').val()) {...
      BaseRecord.search = $('.search_input').val(); 
      BaseRecord.showSearch();
   });  
});
</script>
@endsection