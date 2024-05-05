<script>

$(document).ready(function(){

//====================Category Data Insert Start=========================>
        $("#categoeyfrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('category.insert') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    // $('#addctegoryModals').modal('hide');
                    $('.tab_refe').load(location.href+' .tab_refe');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#error').text(response.responseJSON.message);
                }

              });

         })
//====================Category Data Insert End=========================>

//====================Category Item Edit Start=========================>
      $(document).on('click','.category_edit_btn',function(){
             let id = $(this).data('id');
             let category_name = $(this).data('category_name');
             let category_photo = $(this).data('category_photo');
             
             $('#id').val(id);
             $('#category_name').val(category_name);
      });
//====================Category Item Edit End=========================>

//====================Category Data Update Start=========================>

         $("#categoeyupdatefrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#update_error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('category.update') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#ctegoryUpadeModal').modal('hide');
                    $('.tab_refe').load(location.href+' .tab_refe');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#update_error').text(response.responseJSON.message);
                }

              });

         })
//====================Category Data Update End=========================>

//==================Paginator pagr Ajax Responsive Start============================================================>              
$(document).on('click','.pagination a',function(e){
                  e.preventDefault();
                  var page = $(this).attr('href').split('page=')[1]
                  category(page);
        });

        function category(page){
                $.ajax({
                      url:"{{route('category.pagination')}}?page="+page,
                      success:function(r){
                        $('#table-data').html(r);
                      }
                });
        }
//==================Paginator pagr Ajax Responsive End============================================================>  

//====================Category Item Search Start=========================>
$(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('#all_search').val();
        $.ajax({
            url:"{{ route('category.search') }}",
            method:'GET',
            data:{search_string:search_string},
            success:function(res){
                $('#table-data').html(res);
                if (res.status == "nothing_found"){
                    $('#table-data').html('<span class ="text-danger text-center">'+'Nothing found'+'</span>');
                }
            }

        });
});  
//====================Category Item Search End=========================>

//====================Category Item Delete Start=========================>
$(document).on('click','.category_delete_btn',function(e){
                  e.preventDefault();
                  let category_id = $(this).data('id');
                if(confirm('You are sure to Delete Your Category ?')){
                    $.ajax({
                  url:"{{route('category.delete')}}",
                  method:'get',
                  data:{category_id:category_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('.tab_refe').load(location.href+' .tab_refe');
                        }
                  }

                });
                }
                
          });     
//====================Category Item Delete End=========================>

//====================Category Item Restore Start=========================>
$(document).on('click','.category_restore_btn',function(e){
                  e.preventDefault();
                  let category_id = $(this).data('id');
                        
                if(confirm('You are sure to Restore Your Category ?')){
                    $.ajax({
                  url:"{{route('category.restore')}}",
                  method:'get',
                  data:{category_id:category_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('#table-trash').load(location.href+' #table-trash');
                        }
                  }

                });
                }
                
          });   
//====================Category Item Restore End=========================>

//====================Category Item Force Delete Start=========================>
$(document).on('click','.category_forcedelete_btn',function(e){
                  e.preventDefault();
                  let category_id = $(this).data('id');
                  console.log(category_id);
                        
                if(confirm('You are sure to Force Delete Your Category ?')){
                    $.ajax({
                  url:"{{route('category.forcedelete')}}",
                  method:'get',
                  data:{category_id:category_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('#table-trash').load(location.href+' #table-trash');
                        }
                  }

                });
                }
                
          }); 

//====================Category Item Force Delete End=========================>

//====================Category All Delete Start=========================>
// $(document).on('click','#all_delete_category',function(e){
//                   e.preventDefault();  
//                     $.ajax({
//                   url:"{{route('category.alldelete')}}",
//                   method:'get',
//                   // data:{category_id:category_id},
//                   success:function(res){
//                         if (res.status=='success') { 
//                             $('#table-trash').load(location.href+' #table-trash');
//                         }
//                   }

//                 });
                
                
//           }); 
//====================Category All Delete End=========================>


});

</script>