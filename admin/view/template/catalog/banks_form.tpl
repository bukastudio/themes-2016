<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
        <!--
<tr>
            <td><//?php echo $entry_bank_logo; ?></td>
            <td><input type="hidden" name="bank_logo_image" value="<//?php echo $bank_logo_image; ?>" id="bank_logo_image" />
              <img src="<//?php echo $bank_logo_preview; ?>" alt="" id="bank_logo_preview" class="bank_logo_image" onclick="image_upload('bank_logo_image', 'bank_logo_preview');" /></td>
        </tr>
-->
        <tr>
          <td><span class="required">*</span> <?php echo $entry_name; ?></td>
          <td><input name="name" value="<?php echo $name; ?>" size="32" />
            <?php if ($error_name) { ?>
            <span class="error"><?php echo $error_name; ?></span>
            <?php } ?></td>
        </tr>      
        <tr>
          <td><span class="required">*</span> <?php echo $entry_branch; ?></td>
          <td><input name="branch" value="<?php echo $branch; ?>" size="32" />
            <?php if ($error_branch) { ?>
            <span class="error"><?php echo $error_branch; ?></span>
            <?php } ?></td>
        </tr> 
        <tr>
          <td><span class="required">*</span> <?php echo $entry_account_number; ?></td>
          <td><input name="account_number" value="<?php echo $account_number; ?>" size="32" />
            <?php if ($error_account_number) { ?>
            <span class="error"><?php echo $error_account_number; ?></span>
            <?php } ?></td>
        </tr> 
        <tr>
          <td><span class="required">*</span> <?php echo $entry_account_holder; ?></td>
          <td><input name="account_holder" value="<?php echo $account_holder; ?>" size="32" />
            <?php if ($error_account_holder) { ?>
            <span class="error"><?php echo $error_account_holder; ?></span>
            <?php } ?></td>
        </tr>                  
        <tr>
          <td><?php echo $entry_sort_order; ?></td>
          <td><input name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<script type="text/javascript" src="view/javascript/jquery/ui/ui.draggable.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/ui.resizable.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/ui.dialog.js"></script>
<script type="text/javascript" src="view/javascript/jquery/ui/external/bgiframe/jquery.bgiframe.js"></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script>
<?php echo $footer; ?>