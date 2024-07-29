                                   @foreach ($products as $product)
                                   <div class="row">
                                     <div class="col-xl-2 border">{{$product->name}}</div>
                                     <div class="col-xl-3 border">{{$product->price}}</div>
                                     <div class="col-xl-2 border text-center p-2"><img src="{{ asset('images/' . $product->image) }}" alt=""></div>
                                   </div>
                                    @endforeach           
