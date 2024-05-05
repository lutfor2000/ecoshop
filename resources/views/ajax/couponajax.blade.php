<script>
 $(document).ready(function(){
   
//========================Coupon Data Insert Start=================================> 
$("#couponfrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('coupon.insert') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#addcoupontModal').modal('hide');
                    $('.table').load(location.href+' .table');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#error').text(response.responseJSON.message);
                }

              });

         })  
 //========================Coupon Data Insert End=================================>  

//====================Coupon Item Edit Start=========================>
$(document).on('click','.coupon_edit_btn',function(){
             let id = $(this).data('id');
             let coupon_name = $(this).data('coupon_name');
             let discount_amount = $(this).data('discount_amount');
             let expire_date = $(this).data('expire_date');
             let uses_limit = $(this).data('uses_limit');
             
             $('#id').val(id);
             $('#coupon_name').val(coupon_name);
             $('#discount_amount').val(discount_amount);
             $('#expire_date').val(expire_date);
             $('#uses_limit').val(uses_limit);
      });
//====================Coupon Item Edit End=========================>

//========================Coupon Update Start=================================>    
$("#couponupdatefrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#up_error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('coupon.update') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#updatecoupontModal').modal('hide');
                    $('.table').load(location.href+' .table');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#up_error').text(response.responseJSON.message);
                }

              });

         })  
//========================Coupon Update End=================================> 

//========================Coupon Data Delete Start=================================>  
$(document).on('click','.cupon_delete_btn',function(e){
                  e.preventDefault();
                  let coupon_id = $(this).data('id');
                if(confirm('You are sure to Delete Your Product ?')){
                    $.ajax({
                  url:"{{route('coupon.delete')}}",
                  method:'get',
                  data:{coupon_id:coupon_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('.table').load(location.href+' .table');
                        }
                  }

                });
                }
                
          });      
//========================Coupon Data Delete End=================================>  

//========================Coupon Data Search Start=================================>
 $(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('#search_page').val();
        $.ajax({
            url:"{{ route('coupon.search') }}",
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
//========================Coupon Data Search End=================================>  
$(document).on('click','.pagination a',function(e){
                  e.preventDefault();
                  var page = $(this).attr('href').split('page=')[1]
                  product(page);
        });

        function product(page){
                $.ajax({
                      url:"{{route('coupon.pagination')}}?page="+page,
                      success:function(r){
                        $('#table-data').html(r);
                      }
                });
        }    
//========================Coupon Pagination Start=================================>  

//========================Coupon Pagination End=================================>  

 });

</script>