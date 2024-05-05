<script>
   $(document).ready(function(){
     
//=========================Blog Item  Update===================================================================================>
    $("#profile_from").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              console.log(formdata);
              $('#profile_error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('prfileupdate') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    // $('#updateModal').modal('hide');
                    $(' #card_body').load(location.href+' #card_body');
                    alert('Full upload Successfull');
                  }
                },
                error:function(response){
                   $('#profile_error').text(response.responseJSON.message);
                }

              });

         })


//================Edite Profile============================>

//================Profile delete Start============================>
$(document).on('click','.user_delete_btn',function(e){
                  e.preventDefault();
                  let user_id = $(this).data('id');
                if(confirm('You are sure to Delete Your Product ?')){
                    $.ajax({
                  url:"{{route('profile.delete')}}",
                  method:'get',
                  data:{user_id:user_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('#table_delete').load(location.href+' #table_delete');
                        }
                  }

                });
                }
                
          });    
//================Profile delete End============================>

//================Profile Restore Start============================>
$(document).on('click','.user_restore_btn',function(e){
                  e.preventDefault();
                  let user_id = $(this).data('id');
                        
                if(confirm('You are sure to Restore Your Category ?')){
                    $.ajax({
                  url:"{{route('profile.restore')}}",
                  method:'get',
                  data:{user_id:user_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('#table-trash').load(location.href+' #table-trash');
                        }
                  }

                });
                }
                
          }); 
//================Profile Restore End============================>

//================Profile ForceDelete Start============================>
$(document).on('click','.user_forcedelete_btn',function(e){
                  e.preventDefault();
                  let user_id = $(this).data('id');
                        
                if(confirm('You are sure to Restore Your Category ?')){
                    $.ajax({
                  url:"{{route('profile.forcedelete')}}",
                  method:'get',
                  data:{user_id:user_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('#table-trash').load(location.href+' #table-trash');
                        }
                  }

                });
                }
                
          }); 
//================Profile ForceDelete End============================>

//================Profile Search Start============================>
$(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('#search_page').val();
        console.log( search_string);
        $.ajax({
            url:"{{ route('user.search') }}",
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
//================Profile Search End============================>

//========================Product Pagination Start=================================>  
$(document).on('click','.pagination a',function(e){
                  e.preventDefault();
                  var page = $(this).attr('href').split('page=')[1]
                  product(page);
        });

        function product(page){
                $.ajax({
                      url:"{{route('user.pagination')}}?page="+page,
                      success:function(r){
                        $('#table-data').html(r);
                      }
                });
        }    
 //========================Product Pagination End=================================>      

//================Profile delete Start============================>
//================Profile delete End============================>



   });

</script>