
function removeFromCart($key){
    $.ajax({
        url: 'index.php?route=pos/pos/removeFromCart&token='+token+'',
        type: 'post',
        data: { remove: $key },
        dataType: 'json',
        success: function(json) {
            //total data
            var html = '<div class="pull-right">';
            $total_data = json['total_data'];
            for(var i=0; i < $total_data.length; i++){
                html += '<div><b>'+$total_data[i].title +'</b><br><span id="cart-total">'+$total_data[i].text+'</span></div>';
            }
            html += '</div>';
            $('.total_wrapper').html(html);
        }
    });
}

function addToCart(){
    $.ajax({
            url: 'index.php?route=pos/pos/addToCart&token='+token+'',
            type: 'post',
            data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea'),
            dataType: 'json',
            success: function(json) {
                $('.success, .warning, .attention, information, .error').remove();

                if (json['error']) {

                        show_errors(json['error']);

                        if (json['error']['option']) {
                                for (i in json['error']['option']) {
                                        $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                                }
                        }
                }

                if (json['success']) {
                    update_cart(json['products'], json['total_data']);

                    oScrollbar2.tinyscrollbar_update('bottom');
                    $('.total_wrapper .pull-right div').fadeOut().delay(50).fadeIn('slow');
                    $('.product_list_bottom').addClass('hide');
                }
            }
        });
}

function clearCart(){
    $.ajax({
        url: 'index.php?route=pos/pos/clearCart&token='+token+'',
        type: 'post'
    });
}

function update_cart($products, $total_data){
    var html  = '';

    for(var i=0; i< $products.length; i++){
        html += '<tr><td>'+$products[i]['name']+'<br />';
        //option
        for(var j=0; j < $products[i]['option'].length; j++) {
            html += '<small>- '+$products[i]['option'][j]['name']+': '+ $products[i]['option'][j]['value']+ '</small><br />';
        }
        html += '</td class="center"><td class="qty"><span class="minus"><i class="icon-remove-delete-minus"></i></span><input data-key="'+$products[i]['key']+'" class="qty" value="'+$products[i]['quantity']+'"></input><span class="plus"><i class="icon-add-new-plus"></i></span></td>';
        html += '<td class="right">'+$products[i]['price']+'</td>';
        //html += '<td>'+$products[i]['tax']+'</td>';
        html += '<td class="right">'+$products[i]['total']+'</td>';
        html += '<td><a class="cart_remove" data-key="'+$products[i]['key']+'"><i class="icon-remove-error-warning-exit"></i></a></td>';
        html += '</tr>';
    }

    $('.cart_table tbody').html(html);

    //total data
    var html = '';
    for(var i=0; i < $total_data.length; i++){
        html += '<div><span id="cart-total">'+$total_data[i].text+'</span><strong>'+$total_data[i].title +'</strong></div>';
    }
    html += '';
    $('.total_wrapper').html(html);
}

function get_option($id){
  $.post('index.php?route=pos/pos/getProductOptions&token='+token+'',{ product_id: $id }, function(data){
    var html = '';
    var data= JSON.parse(data);
    var product_option = data['option_data'];

    for (var i = 0; i < product_option.length; i++) {
            var option = product_option[i];

            if (option['type'] == 'select') {
                    html += '<div class="option-item" id="option-' + option['product_option_id'] + '"><label>';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '</label>';
                    html += '<div class="dropdown">';
                    html += '<select name="option[' + option['product_option_id'] + ']">';
                    // html += '<option value=""><?php echo $text_select; ?></option>';

                    for (j = 0; j < option['option_value'].length; j++) {
                            option_value = option['option_value'][j];

                            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

                            if (option_value['price']) {
                                    html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
                            }

                            html += '</option>';
                    }

                    html += '</select>';
                    html += '</div></div>';
            }

            if (option['type'] == 'radio') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<div class="css3-metro-dropdown">';
                    html += '<select name="option[' + option['product_option_id'] + ']">';
                    //html += '<option value=""><?php echo $text_select; ?></option>';

                    for (j = 0; j < option['option_value'].length; j++) {
                            option_value = option['option_value'][j];

                            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

                            if (option_value['price']) {
                                    html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
                            }

                            html += '</option>';
                    }

                    html += '</select>';
                    html += '</div></div>';
                    html += '<br />';
            }

            if (option['type'] == 'checkbox') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';

                    for (j = 0; j < option['option_value'].length; j++) {
                            option_value = option['option_value'][j];

                            html += '<div data-role="input-control" class="input-control checkbox"><label>';
                            html += '<input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" id="option-value-' + option_value['product_option_value_id'] + '" />';
                            html += '<span class="check"></span>';
                            html += option_value['name'];

                            if (option_value['price']) {
                                    html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
                            }

                            html += '</label></div>';
                            html += '<br />';
                    }

                    html += '</div>';
                    html += '<br />';
            }

            if (option['type'] == 'image') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<select name="option[' + option['product_option_id'] + ']">';
                    // html += '<option value=""><?php echo $text_select; ?></option>';

                    for (j = 0; j < option['option_value'].length; j++) {
                            option_value = option['option_value'][j];

                            html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];

                            if (option_value['price']) {
                                    html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
                            }

                            html += '</option>';
                    }

                    html += '</select>';
                    html += '</div>';
                    html += '<br />';
            }

            if (option['type'] == 'text') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" />';
                    html += '</div>';
                    html += '<br />';
            }

            if (option['type'] == 'textarea') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<textarea name="option[' + option['product_option_id'] + ']" cols="40" rows="5">' + option['option_value'] + '</textarea>';
                    html += '</div>';
                    html += '<br />';
            }


            if (option['type'] == 'date') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="date" />';
                    html += '</div>';
                    html += '<br />';
            }

            if (option['type'] == 'datetime') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="datetime" />';
                    html += '</div>';
                    html += '<br />';
            }

            if (option['type'] == 'time') {
                    html += '<div id="option-' + option['product_option_id'] + '">';

                    if (option['required']) {
                            html += '<span class="required">*</span> ';
                    }

                    html += option['name'] + '<br />';
                    html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="time" />';
                    html += '</div>';
                    html += '<br />';
            }

    }//foreach option

    html += '<button onclick="addToCart();"class="button">Add to cart<span class="icon-cart on-right"></span></button>';

    $('#option').html(html);

    $('.date').datepicker({dateFormat: 'yy-mm-dd'});
    $('.datetime').datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'h:m'
    });
    $('.time').timepicker({timeFormat: 'h:m'});

  });//end $.post
}

//add product to cart
$('.product_list .btn_cart').live('click',function(){

    $('.product_list .selected').removeClass('selected');
    $(this).parents('.tile').addClass('selected');
    $('.product-info .product_id').val($(this).attr('data-product-id'));

    var has_option = $(this).attr('data-has-option');//getProductOptions

    if(has_option==1){
        $('.product_list_bottom').removeClass('hide');
        get_option($(this).attr('data-product-id'));
    }else{
        $('.product_list_bottom').addClass('hide');
        addToCart();
    }
});

//put cart to hold on
$('#hold_carts_wrapper .select').live('click',function(){
  $this = $(this);
  $.post('index.php?route=pos/pos/hold_cart_select&token='+token+'',{ cart_holder_id: $this.attr('data_cart_holder_id') }, function(data){
     var json = JSON.parse(data);

     //delete from db
     $.post('index.php?route=pos/pos/hold_cart_delete&token='+token+'',{ cart_holder_id: $this.attr('data_cart_holder_id') }, function(data){
        $this.parent().parent().remove();
        $('.btn_cart_hold_count').html('HOLD: '+ --total_hold);
     });

     //update cart from hold
     update_cart(json['products'], json['total_data']);

     //close fancybox
     $('.fancybox-close').trigger('click');
  });
});

$('#hold_carts_wrapper .delete').live('click',function(){
  $this = $(this);
  $.post('index.php?route=pos/pos/hold_cart_delete&token='+token+'',{ cart_holder_id: $this.attr('data_cart_holder_id') }, function(data){
     $this.parent().parent().remove();
     $('.btn_cart_hold_count').html('HOLD: '+ --total_hold);
   });
});

$('#hold_confirm').click(function(){
 $.post('index.php?route=pos/pos/hold_cart&token='+token+'',{ name: $('#hold_name').val() }, function(data){
     var data = JSON.parse(data);

     if(data['error']){
         $('.message_wrapper').html('<div class="warning">'+data['error']+'</div>');
     }

     if(data['success']){
         $('.fancybox-close').trigger('click');
         $('#hold_carts_wrapper table tr').last().after(data['html']);
         total_hold++;
         $('.btn_cart_hold_count').html('HOLD: '+total_hold);
     }

     $('#hold_name').val('');
 });
});

$(".btn_cart_hold_add").fancybox({
    maxWidth	: 370,
    maxHeight	: 420,
    autoSize	: true,
});

$(".btn_cart_hold_count").fancybox({
    maxWidth	: 470,
    maxHeight	: 420,
    autoSize	: false,
});

function cleardata(){
    //update total
    $html  = '<div class="pull-right"><div><b>Sub total</b><br><span id="cart-total">';
    $html += zero_price;
    $html += '</span></div><div><b>Order Totals</b><br><span id="cart-total">';
    $html += zero_price;
    $html += '</span></div></div>';
    $('.total_wrapper').html($html);

    //remove order data
    $('.order_customer_name').html('Customer name');
    $('.order_head .order_id').html('Order: Order ID');

    //remove cart
    $('.cart_table tbody tr').remove();
}

//cart qty update
$('.cart_table .minus').live('click',function(){
    $qty = $(this).parent().find('.qty');
    $qty_value = parseInt($qty.val());
    $key = $qty.attr('data-key');

    if($qty_value == 1) return false;

    $qty.val($qty_value--);

    $.post('index.php?route=pos/pos/updateCart&token='+token+'',{ key: $key , quantity: $qty_value }, function(data){
        var json = JSON.parse(data);
        if(json.error){
            show_errors(json.error);
        }
        update_cart(json['products'], json['total_data']);
    });
});

//cart qty update
$('.cart_table input.qty').live('change',function(){
    $qty = $(this);
    $qty_value = parseInt($qty.val());
    $key = $qty.attr('data-key');
    $.post('index.php?route=pos/pos/updateCart&token='+token+'',{ key: $key , quantity: $qty_value }, function(data){
        var json = JSON.parse(data);
        if(json.error){
            show_errors(json.error);
        }
        update_cart(json['products'], json['total_data']);
    });
});

$('.cart_table .plus').live('click',function(){
    $qty = $(this).parent().find('.qty');
    $qty_value = parseInt($qty.val());
    $key = $qty.attr('data-key');
    $qty.val($qty_value++);

    $.post('index.php?route=pos/pos/updateCart&token='+token+'',{ key: $key , quantity: $qty_value }, function(data){
        var json = JSON.parse(data);
        if(json.error){
            show_errors(json.error);
        }
        update_cart(json['products'], json['total_data']);
    });

});

function show_errors($errors){

    $html = '';
    for($i=0; $i<$errors.length; $i++){
        $html += ($i+1)+') '+$errors[$i]+'<br />';
    }

    $.Dialog({
        shadow: true,
        overlay: true,
        icon: '<span class="icon-info"></span>',
        title: 'Errors!',
        content: $html,
        padding: 10,
        onShow: function(_dialog){
            console.log(_dialog);
        }
    });
}

//remove items from cart
$('.cart_remove').live('click',function(){
    removeFromCart($(this).attr('data-key'));
    $(this).parentsUntil('tbody').remove();
    oScrollbar2.tinyscrollbar_update('top');
});
