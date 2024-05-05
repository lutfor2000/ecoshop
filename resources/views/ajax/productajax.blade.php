<script>
$(document).ready(function(){

 //========================Product Data Insert Start=================================> 
      $("#productfrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('product.insert') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    // $('#addctegoryModals').modal('hide');
                    $('.table').load(location.href+' .table');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#error').text(response.responseJSON.message);
                }

              });

         })  
 //========================Product Data Insert End=================================>   

 //========================Product Data Edite Start=================================> 
      $(document).on('click','.product_edit_btn',function(){
             let id = $(this).data('id');
             let category_id = $(this).data('category_id');
             let product_name = $(this).data('product_name');
             let product_sort_des = $(this).data('product_sort_des');
             let product_price = $(this).data('product_price');
             let product_quantity = $(this).data('product_quantity');
             let product_alert_quantity = $(this).data('product_alert_quantity');
             let product_model = $(this).data('product_model');
             let product_description = $(this).data('product_description');
             
             $('#id').val(id);
             $('#category_id').val(category_id);
             $('#product_name').val(product_name);
             $('#product_sort_des').val(product_sort_des);
             $('#product_price').val(product_price);
             $('#product_quantity').val(product_quantity);
             $('#product_alert_quantity').val(product_alert_quantity);
             $('#product_model').val(product_model);
             $('#product_description').val(product_description);
      });     
 //========================Product Data Edite End=================================>  

 //========================Product Update Start=================================>    
      $("#productupdatefrom").submit(function(e){
              e.preventDefault();
              var formdata = new FormData(this);
              $('#up_error').text('');
              $.ajax({
                method:'POST',
                url:"{{ route('product.update') }}",
                data:formdata,
                contentType:false,
                processData:false,
                success:(response)=>{
                  if(response){
                    this.reset();
                    $('#updateproductModal').modal('hide');
                    $('.table').load(location.href+' .table');
                     $(window).reload();
                  }
                },
                error:function(response){
                   $('#up_error').text(response.responseJSON.message);
                }

              });

         })  
 //========================Product Update End=================================> 

 //========================Product Data Delete Start=================================>  
 $(document).on('click','.product_delete_btn',function(e){
                  e.preventDefault();
                  let product_id = $(this).data('id');
                if(confirm('You are sure to Delete Your Product ?')){
                    $.ajax({
                  url:"{{route('product.delete')}}",
                  method:'get',
                  data:{product_id:product_id},
                  success:function(res){
                        if (res.status=='success') { 
                            $('.table').load(location.href+' .table');
                        }
                  }

                });
                }
                
          });      
 //========================Product Data Delete End=================================>      

 //========================Product Pagination Start=================================>  
 $(document).on('click','.pagination a',function(e){
                  e.preventDefault();
                  var page = $(this).attr('href').split('page=')[1]
                  product(page);
        });

        function product(page){
                $.ajax({
                      url:"{{route('product.pagination')}}?page="+page,
                      success:function(r){
                        $('#table-data').html(r);
                      }
                });
        }    
 //========================Product Pagination End=================================>      

 //========================Product Data Search Start=================================>
 $(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('#search_page').val();
        $.ajax({
            url:"{{ route('product.search') }}",
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
 //========================Product Data Search End=================================>      

 //========================Product Data Insert Start=================================>      
 //========================Product Data Insert End=================================>      






});
</script>