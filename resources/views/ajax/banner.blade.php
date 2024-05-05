<script>
    $(document).ready(function(){

//=================Banner Insert Datav Start=========================================================>    
         $("#bannerfrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('bannerpost') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#addModal').modal('hide');
                    $('.table').load(location.href+' .table');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#error').text(response.responseJSON.message);
                }

              });

         })
//=================Banner Insert Datav End=========================================================>  

//=================Banner Item Edit Start=========================================================>    
         $(document).on('click','.banner_edit_btn',function(){
                  let id = $(this).data('id');
                  let banner_title = $(this).data('banner_title');
                  let banner_desc = $(this).data('banner_desc');
                  let banner_photo = $(this).data('banner_photo');

                  $('#id').val(id);
                  $('#banner_title').val(banner_title);
                  $('#banner_desc').val(banner_desc);
                  $('#banner_photo').val(banner_photo);
            });

//=================Banner Item End=========================================================>   

//=================Banner Item Update Start=========================================================>
$("#bannerupdatefrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#banner_error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('bannerupdate') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#bannerUpdateModal').modal('hide');
                    $('.table').load(location.href+' .table');
                    alert('Full upload Successfull');
                  }
                },
                error:function(response){
                   $('#banner_error').text(response.responseJSON.message);
                }

              });

         })    
//=================Banner Item Update End=========================================================> 

//=================Banner Item Delete Start=========================================================>
$(document).on('click','.banner_delete_btn',function(e){
                  e.preventDefault();
                  let banner_id = $(this).data('id');

                if(confirm('You are sure to Delete Your Product ?')){
                    $.ajax({
                  url:"{{route('banner.delete')}}",
                  method:'get',
                  data:{banner_id:banner_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('.table').load(location.href+' .table');
                        }
                  }

                });
                }
                
              });      
//=================Banner Item Delete End=========================================================>  

//=================Banner Item Edit=========================================================>  
            $(document).on('keyup',function(e){
                            e.preventDefault();
                            let search_string = $('#all_search').val();
                            $.ajax({
                                url:"{{ route('banner.search') }}",
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
//=================Banner Item Edit=========================================================>  

//=================Banner Item Edit=========================================================>    
//=================Banner Item Edit=========================================================>    
//=================Banner Item Edit=========================================================>    
//=================Banner Item Edit=========================================================>    




    });





</script>