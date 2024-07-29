
                     @foreach ($users as $user)
                     <div class="row">
                     <div class="col-lg-2 border p-2 text-center"><i class="fa fa-trash-o" id="{{$user->id}}"></i></div>  
                        <div class="col-lg-3 border p-2">{{$user->name}}</div>  
                        <div class="col-lg-3 border p-2">{{$user->email}}</div>
                        <div class="col-lg-2 border p-2">{{$user->created_at}}</div>
                        <div class="col-lg-2 border p-2">{{$user->role}}</div>
                    </div>
                     @endforeach
                    
