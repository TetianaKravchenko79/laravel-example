$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

let BaseRecord = {

   removeUser(id) {
      let ajaxSetting = {
         method: 'delete',
         url: '/users/' + id,
         success: function(data) {
            $('.user_item_list').html(data.table);
         },
         error: function(data) {
            console.log(data.responseText);
         },
      };

      $.ajax(ajaxSetting);
   },

};