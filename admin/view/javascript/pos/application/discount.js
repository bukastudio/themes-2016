 
function discount(){
 $.post('index.php?route=pos/pos/discount&token='+token+'',{ discount_type: $('#discount_type').val(), discount_amount: $('#discount_amount').val() }, function(data){        
        var json = JSON.parse(data);
        
        var html = '<div class="pull-right">';
        for(var i=0; i < json['total_data'].length; i++){
            html += '<div><b>'+json['total_data'][i].title +'</b><br><span id="cart-total">'+json['total_data'][i].text+'</span></div>';
        }
        html += '</div>';
        $('.total_wrapper').html(html);
 });
}

function coupon(){
 $.post('index.php?route=pos/pos/coupon&token='+token+'',{ coupon: $('#coupon').val() }, function(data){        
        var json = JSON.parse(data);
        
        var html = '<div class="pull-right">';
        for(var i=0; i < json['total_data'].length; i++){
            html += '<div><b>'+json['total_data'][i].title +'</b><br><span id="cart-total">'+json['total_data'][i].text+'</span></div>';
        }
        html += '</div>';
        $('.total_wrapper').html(html);
 });
}

function voucher(){
 $.post('index.php?route=pos/pos/voucher&token='+token+'',{ voucher: $('#voucher').val() }, function(data){        
        var json = JSON.parse(data);
        
        var html = '<div class="pull-right">';
        for(var i=0; i < json['total_data'].length; i++){
            html += '<div><b>'+json['total_data'][i].title +'</b><br><span id="cart-total">'+json['total_data'][i].text+'</span></div>';
        }
        html += '</div>'; 
        $('.total_wrapper').html(html);
 });
}
