<div id="order_wrapper">
    <div class="order_form">
        <h3>Update Order</h3><hr>        
        <div class="message_wrapper"></div>        
        <div class="grid">
            <div class="row">                
                <div class="span3">
                    <span class="label2">Select Customer</span>
                </div>
                <div class="span4">
                    <div class="input-control checkbox">
                        <label>
                            <input name="is_guest" value="1" type="checkbox" />
                            <span class="check"></span>
                            Guest Customer
                        </label>                                                
                    </div>                    
                    <span class="sep_or">OR</span>
                    <div data-role="input-control" class="input-control text">
                        <input id="customer_name" type="text" name="customer_name" placeholder="Type and Select Customer ">
                        <input type="hidden" name="customer_id" />
                    </div>
                </div>
                <!-- END .span4 -->
            </div>
            <!-- END .row -->     
            <div class="row">
                <div class="span3">
                    <span class="label2">Payment Gateways</span>
                </div>
                <div class="span4">
                    <div class="input-control checkbox">
                        <label>
                            <input checked name="pg_type" value="pos" type="radio" />
                            <span class="check"></span>
                            POS
                        </label>                                                
                    </div>                    
                    &nbsp;&nbsp;
                    <div class="input-control checkbox">
                        <label>
                            <input name="pg_type" value="opencart" type="radio" />
                            <span class="check"></span>
                            Opencart
                        </label>                                                
                    </div>                    
                </div>
            </div>
            
            <div class="row" id="opencart_payment" style="display:none;">
                <div class="span3">
                    <span class="label2">Payment method</span>
                </div>
                <div class="span4">
                    <div style="float: left !important" class="css3-metro-dropdown">
                        <select name="payment_method">
                            <?php foreach($payment_methods as $method){ ?>
                                <option value="<?= $method['code'] ?>"><?= $method['title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>                        
                </div>
                <!-- END .span4 -->
            </div>
            <!-- END .row -->
            
            <div class="row" id="pos_payment">
                <div class="span3">
                    <span class="label2">Payment method</span>
                </div>
                <div class="span4">
                    <div style="float: left !important" class="css3-metro-dropdown">
                        <select name="payment_method">
                            <option>Cash</option>
                            <option>Card</option>
                        </select>
                    </div>                        
                    <span style="float: left !important" class="label2">&nbsp;&nbsp;&nbsp;Card last 4 digits&nbsp;</span>
                    <input class="mask-card" type="text" name="card" />
                </div>
                <!-- END .span4 -->
            </div>
            <!-- END .row -->
            <div class="row">
                <div class="span3">
                    <span class="label2">Calculate change</span>
                </div>
                <div class="span1">
                   <div data-role="input-control" class="input-control text">
                      <input type="text" name="paid" placeholder="paid" />                      
                   </div>                          
                </div>
                <div class="span3">
                    <span style="color: red;" class="label2 change_amount"></span>
                </div>
                <!-- END .span2 -->
            </div>
            <!-- END .row -->
            <div class="row">
                <div class="span3">
                    <span class="label2">Comment</span>
                </div>
                <div class="span4">
                   <div data-role="input-control" class="input-control textarea">
                       <textarea name="order_comment"></textarea>
                   </div>                          
                   <button class="button" id="order_update">Submit</button>                   
                </div>
                <!-- END .span4 -->
            </div>
            <!-- END .row -->
        </div>
        <!-- END .grid --> 
    </div>
</div>

<script>
     
$('input[name="pg_type"]').change(function(){
    $('#opencart_payment, #pos_payment').hide();
    $('#'+$(this).val()+'_payment').show();
});

//autocomplete attribute name 
$("#customer_name").autocomplete({
    source: function(request, response) {
            $.ajax({
                    url: 'index.php?route=pos/pos/searchCustomer&token=<?php echo $token; ?>&q=' +  encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function(json) {	
                            response($.map(json, function(item) {
                                    return {
                                       label: item.firstname +' '+item.lastname,
                                       value: item.customer_id
                                    }
                            }));
                    }
            });
    }, 
    select: function(event, ui) {
            $('input[name=\'customer_name\']').attr('value', ui.item.label);
            $('input[name=\'customer_id\']').attr('value', ui.item.value);

            return false;
    },
    focus: function(event, ui) {
            return false;
    }
});
     
$(".mask-card").mask("9999");     

$('input[name="paid"]').keyup(function(){    
    $.get('index.php?route=pos/pos/get_total&token=<?php echo $token; ?>',function(data){
        var paid = parseFloat($('input[name="paid"]').val()) || 0;     
        var total = data;     
        var change = paid - total;
        $('.change_amount').html('Change = '+ paid+'-'+total+' = '+change);
    });
});

</script>