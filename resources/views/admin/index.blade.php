@extends('admin.layout')

@section('css')
<style>
.fa-trash-o {
  cursor: pointer;
  color: red;
  font-size: 1.5em;  
}
</style>
@endsection

@section('main')

        <div class="row padding_body">
           <div class="col-md-12">
              <div class="box box-primary">
                 <div class="box-body container">

                 <div class="row">
                 <div class="col-lg-2 border text-center p-2 text-danger">Remove</div>  
                      <div class="col-lg-3 border font-weight-bold p-2">Name</div>  
                      <div class="col-lg-3 border font-weight-bold p-2">Login(Email)</div>
                      <div class="col-lg-2 border font-weight-bold p-2">Date Create</div>
                      <div class="col-lg-2 border font-weight-bold p-2">Role</div>
                    </div>
                   
                    <div class="user_item_list">
                    @include('admin.admin-standard')
                    </div>
                    <hr>                       
                   </div>  
                 </div>
              </div> 
           </div>         
@endsection

@section('js')
<script src="{{ asset('js/mainAdmin.js') }}"></script>
<script>
$(document).ready(function(){
   $('body').on('click', '.fa-trash-o', function() { 
      BaseRecord.removeUser($(this).attr('id'));
   });
});
</script>
@endsection
