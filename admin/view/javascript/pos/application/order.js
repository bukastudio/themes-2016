
$('.pagination a').live('click',function(){
    get_orders($(this).attr('href'));
    return false;
}); 

$('.order_list .edit').live('click', function(){
    $.get('index.php?route=pos/pos/getOrder&order_id='+$(this).attr('data-order-id')+'&token='+token+'',function(data){
        var data = JSON.parse(data);
        update_cart(data['products'], data['total_data']);
          
        //change pop up to order edit mode 
        $('#order').attr('href','index.php?route=pos/pos/updateConfirm&token='+token+'');
        $('input[name="order_id"]').val(data['order_id']);
        
        if(data['customre']){
            $('input[name="customer_name"]').val(data['customer']['customer_name']);
            $('input[name="customer_id"]').val(data['customer']['customer_id']);
        }else{
            $('input[name="is_guest"]').prop('checked', true);
        }
        $('.fancybox-close').trigger('click');
    });    
});

$('#order_confirm').live('click',function(){
    $(this).val('Sending data...');
    $pg_type = $('input[name="pg_type"]:checked').val();
    
    if($pg_type == 'opencart'){
        $payment_method = $('#opencart_payment select[name="payment_method"]').val();
    }else{
        $payment_method = $('#pos_payment select[name="payment_method"]').val();    
    }
    
    $.post('index.php?route=pos/pos/addOrder&token='+token+'', {
        card_no: $('.mask-card').val(),
        pg_type: $pg_type,
        customer_id: $('input[name="customer_id"]').val(), 
        is_guest: $('input[name="is_guest"]').is(':checked') ,
        payment_method: $payment_method, 
        comment: $('textarea[name="order_comment"]').val() 
    }, function(data){
         var data = JSON.parse(data);
         var html = '';
         
         if(data['errors']){
             $('.message_wrapper').html("<div class='warning'>"+data['errors']+"</div>");             
         }
         
         if(data['success']){
            //$('.message_wrapper').html("<div class='success'>"+data['success']+"</div>");             
             $('.fancybox-close').trigger('click');
            //alert('New order placed with ID: '+data.order_id);
            $('#order_confirm').val('Done');            
            $('textarea[name="order_comment"]').val('').html('');
            $('.order_head .order_id').html('Order: '+data['order_id']);
            $('.balance').html('Cash : '+data['cash']+'<br>Card : '+data['card']);
            $('.order_customer_name').html(data['customer_name']+'<span class="pull-right">'+x.toDateString() + ', ' +  x.toLocaleTimeString()+'</span>');

            if(data['payment_link']){
                save_invoice();//save invoice html to print after payment success
                window.open(data['payment_link'],'_blank');     

                //remove order data 
                $('.cart_table tbody').html('');

                $html  = '<div class="pull-right">';
                $html += '<div>';
                $html += '<b>Sub total</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '<div>';
                $html += '<b>TAX</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '<div>';
                $html += '<b>Order Totals</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '</div>';

                $('.total_wrapper').html($html);
            }else{             
                print();//print invoice if pos gateways used 
                clearCart();   
            }
        }
    });
});

function save_invoice(){
    $html  = '<div class="order_head">'+$(".order_head").html()+'</div>';
    $html += '<table class="table table-bordered cart_table">'+$(".cart_table").html()+'</table>';
    $html += '<div class="total_wrapper">'+$(".total_wrapper").html()+'</div>';
    $.post('index.php?route=pos/pos/saveInvoice&token='+token+'',{ html : $html });//save invoice html  
}

$('#order_update').live('click',function(){
    $(this).val('Sending data...');
    $pg_type = $('input[name="pg_type"]:checked').val();
    
    if($pg_type == 'opencart'){
        $payment_method = $('#opencart_payment select[name="payment_method"]').val();
    }else{
        $payment_method = $('#pos_payment select[name="payment_method"]').val();    
    }
    
    $.post('index.php?route=pos/pos/editOrder&token='+token+'', { 
        card_no: $('.mask-card').val(),
        pg_type: $pg_type,
        order_id: $('input[name="order_id"]').val(), 
        customer_id: $('input[name="customer_id"]').val(), 
        is_guest: $('input[name="is_guest"]').is(':checked') ,
        payment_method: $payment_method, 
        comment: $('textarea[name="order_comment"]').val() 
    }, function(data){
         var data = JSON.parse(data);
         var html = '';
         
         if(data['errors']){
             $('.message_wrapper').html("<div class='warning'>"+data['errors']+"</div>");             
         }
         
         if(data['success']){
            $('.fancybox-close').trigger('click');
        
            //change pop up to order edit mode 
            $('#order').attr('href','index.php?route=pos/pos/confirm&token='+token+'');
        
            $('.order_head .order_id').html('Order: '+data['order_id']);
            $('.balance').html('Cash : '+data['cash']+'<br>Card : '+data['card']);     
            $('.order_customer_name').html(data['customer_name']+'<span class="pull-right">'+x.toDateString() + ', ' +  x.toLocaleTimeString()+'</span>');           

            if(data['payment_link']){
                save_invoice();//save invoice html to print after payment success
                window.open(data['payment_link'],'_blank');     

                //remove order data 
                $('.cart_table tbody').html('');

                $html  = '<div class="pull-right">';
                $html += '<div>';
                $html += '<b>Sub total</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '<div>';
                $html += '<b>TAX</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '<div>';
                $html += '<b>Order Totals</b><br>';
                $html += '<span id="cart-total">'+zero_price+'</span>';
                $html += '</div>';
                $html += '</div>';

                $('.total_wrapper').html($html);
            }else{             
                print();//print invoice if pos gateways used 
                clearCart();   
            }
         }
    });
});

function get_orders($url){
    $.get($url, function(data){
        var data = JSON.parse(data);
        var html = '';
        
        if(data['rows'].length ==0){
            html += '<tr><td colspan="7">No order(s) found!</td></tr>';            
        }
        
        for($i = 0; $i < data['rows'].length; $i++){
            html += "<tr class='data_row'>";
            html += "<td align='right'>"+data['rows'][$i]['order_id']+"</td>";
            html += "<td>"+data['rows'][$i]['customer']+"</td>"; 
            html += "<td>"+data['rows'][$i]['status']+"</td>"; 
            html += "<td align='right' class='td_total'>"+data['rows'][$i]['total']+"</td>"; 
            html += "<td>"+data['rows'][$i]['date_added']+"</td>";
            html += "<td>"+data['rows'][$i]['date_modified']+"</td>";
            html += "<td align='center'> [<a class='edit' data-order-id="+data['rows'][$i]['order_id']+" href='#'>Edit</a>]</td>";
            html += "</tr>";
        }
        
        $('.pagination').html(data['pagination']);
        $('.data_row').remove();
        $('.order_list table .filter').after(html);
    });
}