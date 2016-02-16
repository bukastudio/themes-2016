<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div><!-- breadcrumb -->
		
	<?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>	
	
	<div class="box">
		<div class="heading">
		  <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
		  <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
		</div><!-- end of .heading -->

		<div class = "content">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class = "form">
				<tr>
					<td colspan="2"><?php echo $description; ?></td>
				</tr>
				<tr>
					<td><?php echo $entry_custom; ?><br /><span class = "help"><?php echo $entry_custom_description; ?></span></td>
					<td>
					<input type="text" id="ast_custom" name="ast_custom" size="50" value="<?php echo $ast_custom; ?>" onchange="set_example();" />
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_custom1; ?><br /><span class = "help"><?php echo $entry_custom1_description; ?></span></td>
					<td>
					<input type="text" id="ast_custom1" name="ast_custom1" size="50" value="<?php echo $ast_custom1; ?>" onchange="set_example();" />
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_custom2; ?><br /><span class = "help"><?php echo $entry_custom2_description; ?></span></td>
					<td>
					<input type="text" id="ast_custom2" name="ast_custom2" size="50" value="<?php echo $ast_custom2; ?>" onchange="set_example();" />
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_sorder; ?><br /><span class = "help"><?php echo $entry_sorder_description; ?></span></td>
					<td>
					<?php $smax=3; for($s=0;$s<$smax;$s++) { ?>
					<select id="ast_sorder<?php echo $s; ?>" name="ast_sorder[<?php echo $s; ?>]">
						<option value="0" <?php if($ast_sorder[$s]=='0') echo 'selected="selected"'; ?>><?php echo $order_nothing; ?></option>
						<option value="1" <?php if($ast_sorder[$s]=='1') echo 'selected="selected"'; ?>><?php echo $order_sitename; ?></option>
						<option value="2" <?php if($ast_sorder[$s]=='2') echo 'selected="selected"'; ?>><?php echo $order_pagename; ?></option>
						<option value="3" <?php if($ast_sorder[$s]=='3') echo 'selected="selected"'; ?>><?php echo $order_custom; ?></option>
						<option value="4" <?php if($ast_sorder[$s]=='4') echo 'selected="selected"'; ?>><?php echo $order_custom1; ?></option>
						<option value="5" <?php if($ast_sorder[$s]=='5') echo 'selected="selected"'; ?>><?php echo $order_custom2; ?></option>
					</select>
					<?php if($s<($smax-1)) { ?><input type="text" id="ast_ssep<?php echo $s; ?>" name="ast_ssep[<?php echo $s; ?>]" size="2" value="<?php echo $ast_ssep[$s]; ?>" /><?php } ?>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_horder; ?><br /><span class = "help"><?php echo $entry_horder_description; ?></span></td>
					<td>
					<?php $hmax=3; for($h=0;$h<$hmax;$h++) { ?>
					<select id="ast_horder<?php echo $h; ?>" name="ast_horder[<?php echo $h; ?>]">
						<option value="0" <?php if($ast_horder[$h]=='0') echo 'selected="selected"'; ?>><?php echo $order_nothing; ?></option>
						<option value="1" <?php if($ast_horder[$h]=='1') echo 'selected="selected"'; ?>><?php echo $order_sitename; ?></option>
						<option value="2" <?php if($ast_horder[$h]=='2') echo 'selected="selected"'; ?>><?php echo $order_custom; ?></option>
						<option value="3" <?php if($ast_horder[$h]=='3') echo 'selected="selected"'; ?>><?php echo $order_custom1; ?></option>
						<option value="4" <?php if($ast_horder[$h]=='4') echo 'selected="selected"'; ?>><?php echo $order_custom2; ?></option>
					</select>
					<?php if($h<($hmax-1)) { ?><input type="text" id="ast_hsep<?php echo $h; ?>" name="ast_hsep[<?php echo $h; ?>]" size="2" value="<?php echo $ast_hsep[$h]; ?>" /><?php } ?>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_order; ?><br /><span class = "help"><?php echo $entry_order_description; ?></span></td>
					<td>
					<?php $max=8; for($i=0;$i<$max;$i++) { ?>
					<select id="ast_order<?php echo $i; ?>" name="ast_order[<?php echo $i; ?>]" onchange="set_example();">
						<option value="0" <?php if($ast_order[$i]=='0') echo 'selected="selected"'; ?>><?php echo $order_nothing; ?></option>
						<option value="1" <?php if($ast_order[$i]=='1') echo 'selected="selected"'; ?>><?php echo $order_sitename; ?></option>
						<option value="2" <?php if($ast_order[$i]=='2') echo 'selected="selected"'; ?>><?php echo $order_brand; ?></option>
						<option value="3" <?php if($ast_order[$i]=='3') echo 'selected="selected"'; ?>><?php echo $order_price; ?></option>
						<option value="4" <?php if($ast_order[$i]=='4') echo 'selected="selected"'; ?>><?php echo $order_special; ?></option>
						<option value="5" <?php if($ast_order[$i]=='5') echo 'selected="selected"'; ?>><?php echo $order_product; ?></option>
						<option value="6" <?php if($ast_order[$i]=='6') echo 'selected="selected"'; ?>><?php echo $order_cat; ?></option>
						<option value="7" <?php if($ast_order[$i]=='7') echo 'selected="selected"'; ?>><?php echo $order_custom; ?></option>
						<option value="8" <?php if($ast_order[$i]=='8') echo 'selected="selected"'; ?>><?php echo $order_custom1; ?></option>
						<option value="9" <?php if($ast_order[$i]=='9') echo 'selected="selected"'; ?>><?php echo $order_custom2; ?></option>
						<option value="10" <?php if($ast_order[$i]=='10') echo 'selected="selected"'; ?>><?php echo $order_model; ?></option>
						<option value="11" <?php if($ast_order[$i]=='11') echo 'selected="selected"'; ?>>SKU</option>
						<option value="12" <?php if($ast_order[$i]=='12') echo 'selected="selected"'; ?>>EAN</option>
						<option value="13" <?php if($ast_order[$i]=='13') echo 'selected="selected"'; ?>>UPC</option>
						<option value="14" <?php if($ast_order[$i]=='14') echo 'selected="selected"'; ?>>JAN</option>
						<option value="15" <?php if($ast_order[$i]=='15') echo 'selected="selected"'; ?>>ISBN</option>
						<option value="16" <?php if($ast_order[$i]=='16') echo 'selected="selected"'; ?>>MPN</option>
					</select>
					<?php if($i<($max-1)) { ?><input type="text" id="ast_sep<?php echo $i; ?>" name="ast_sep[<?php echo $i; ?>]" size="2" value="<?php echo $ast_sep[$i]; ?>" onchange="set_example();" /><?php } ?>
					<?php } ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $entry_example; ?><br /><span class = "help"><?php echo $entry_example_description; ?></span></td>
					<td>
					<div id="example"></div>
					</td>
				</tr>
			</table>
			</form>
		</div> <!-- end of .content -->
		
	</div><!-- end of .box -->
<div align="center">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - make a donation!">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

<script type="text/javascript">
function set_example() {
	var text = "";
	ast_val = new Array("", "<?php echo $this->config->get('config_title'); ?>", "Apple", "130.50&euro;", "SPECIAL!", "iPhone 4S 16gb", "Smartphone", document.getElementById('ast_custom').value,document.getElementById('ast_custom1').value,document.getElementById('ast_custom2').value,"A1387","SKU #","EAN #","UPC #","JAN #","ISBN #","MPN #");
	for (var i=0;i<<?php echo $max; ?>;i++) { 
		text += ast_val[document.getElementById('ast_order'+i).value];
		if(i<(<?php echo $max; ?>-1)) text += document.getElementById('ast_sep'+i).value;
	}
	document.getElementById('example').innerHTML = text;
}
set_example(); 
</script>
</div> <!-- end of #content -->
