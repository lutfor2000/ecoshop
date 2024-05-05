<script>
$(document).ready(function() {
	//====================Cart Item Delete Start=========================>
$(document).on('click','#carddelete',function(e){
		e.preventDefault();
	 let cart_id = $(this).data('id');
	  if(confirm('You are sure to Delete Your Cart Item ?')){
		  $.ajax({
		url:"{{route('card.delete')}}",
		method:'GET',
		data:{cart_id:cart_id},
		success:function(res){
			  if (res.status=='success') { 
				  $('.card_table').load(location.href+' .card_table');
			  }
		}
	
	  });
	  }
	  
	});     
//====================Cart Item Delete End=========================>
    
	

//====================Cart Apply Coupon Start=========================>
$('#apply_coupon_btn').click(function(){
	var coupon_name = $('#coupon_input').val();
	var go_to_link = "{{route('cart')}}/" + coupon_name;
	window.location.href = go_to_link; 
});
//====================Cart Apply Coupon End=========================>

 //========================Product Data Search Start=================================>
 $(document).on('keyup',function(e){
        e.preventDefault();
        let search_string = $('.customer_search').val();
        $.ajax({
            url:"{{ route('coustomerproduct.search') }}",
            method:'GET',
            data:{search_string:search_string},
            success:function(res){
                $('.coustomer_search').html(res);
                if (res.status == "nothing_found"){
                    $('.coustomer_search').html('<span class ="text-danger text-center">'+'Nothing found'+'</span>');
                }
            }

        });
});       
 //========================Product Data Search End=================================>      


//====================Cart Apply Coupon Start=========================>
//====================Cart Apply Coupon End=========================>
	
//====================Cart Apply Coupon Start=========================>
//====================Cart Apply Coupon End=========================>
	
//====================Cart Apply Coupon Start=========================>
//====================Cart Apply Coupon End=========================>
	
	   
	})
	
</script>