<style type="text/css">#out-of-stock-enquiry-form input {  width: 99%;}#out-of-stock-enquiry-form textarea {  width: 99%;  height: 50px;}.out-of-stock-enquiry-label {  color: red;}a.out-of-stock-enquiry-enquiry {  background: orange;}</style><form id="out-of-stock-enquiry-form" title="<?php echo $heading_title;?>">  <table class="form">    <tr>      <td><?php echo $entry_name; ?><span class="required">*</span></td>      <td><input type="text" name="name" class="name" value="<?php echo $name;?>" /></td>    </tr>    <tr>      <td><?php echo $entry_email; ?><span class="required">*</span></td>      <td><input type="text" name="email" class="email" value="<?php echo $email;?>" /></td>    </tr>    <tr>      <td><?php echo $entry_phone; ?></td>      <td><input type="text" name="phone" class="phone" value="" /></td>    </tr>    <tr>      <td><?php echo $entry_subject; ?><span class="required">*</span></td>      <td><input type="text" name="subject" class="subject" readonly /></td>    </tr>    <tr>      <td><?php echo $entry_enquiry; ?><span class="required">*</span></td>      <td><textarea name="enquiry" class="enquiry" maxlength="3000"></textarea></td>    </tr>  </table></form><script type='text/javascript'>$(function() {  $(".out-of-stock-enquiry").each(function() {    outofstockenquiry = $(this).html();    product_id = $(this).data("product_id");    $("[onclick^='addToCart(\'" + product_id + "\'']").after($(this).html()).remove();    $(this).remove();  });  outofstockenquiry = $(".out-of-stock-enquiry-product-page").html();  if (outofstockenquiry) {    $("#button-cart").after(outofstockenquiry).remove();    $("input[name=quantity]").attr("disabled", "disabled").val(0);    $(".out-of-stock-enquiry-product-page").remove();  }});function outOfStockEnquiry(obj) {console.log(obj);  error_required = '<span class="error"><?php echo $error_required;?></span>';  $("#out-of-stock-enquiry-form").find(".error, .warning, .attention, .success").remove();  $("#out-of-stock-enquiry-form .subject").val($(obj).data("subject"));  $("#out-of-stock-enquiry-form").dialog({    width: "460",    height: "370",    modal: true,    buttons: {      "<?php echo $button_save;?>": function() {        $("#out-of-stock-enquiry-form").find(".error, .warning, .attention, .success").remove();        if (!$.trim($("#out-of-stock-enquiry-form .name").val())) $("#out-of-stock-enquiry-form .name").after(error_required);        if (!$.trim($("#out-of-stock-enquiry-form .email").val())) $("#out-of-stock-enquiry-form .email").after(error_required);        if (!$.trim($("#out-of-stock-enquiry-form .subject").val())) $("#out-of-stock-enquiry-form .subject").after(error_required);        if (!$.trim($("#out-of-stock-enquiry-form .enquiry").val())) $("#out-of-stock-enquiry-form .enquiry").after(error_required);        if ($("#out-of-stock-enquiry-form .error").length) return false;        $.ajax({          url: "index.php?route=module/out-of-stock-enquiry/send",          data: $("#out-of-stock-enquiry-form").serialize(),          type: "post",          dataType: "json",          success: function(json) {          	if (json.success) {          	  $("#out-of-stock-enquiry-form").dialog("close");          	  alert(json.success);          	}          }        })      }    }  });}</script>