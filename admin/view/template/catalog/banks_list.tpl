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
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<div class="box">
 
  <div class="heading">
    <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a><a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="list">
        <thead>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left"><?php if ($sort == 'name') { ?>
              <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
              <?php } ?></td>
            <td class="left"><?php if ($sort == 'branch') { ?>
              <a href="<?php echo $sort_branch; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_branch; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_branch; ?>"><?php echo $column_branch; ?></a>
              <?php } ?></td>
            <td class="left"><?php if ($sort == 'account_number') { ?>
              <a href="<?php echo $sort_acount_number; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_account_number; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_account_number; ?>"><?php echo $column_account_number; ?></a>
              <?php } ?></td>
            <td class="left"><?php if ($sort == 'account_holder') { ?>
              <a href="<?php echo $sort_account_holder; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_account_holder; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_account_holder; ?>"><?php echo $column_account_holder; ?></a>
              <?php } ?></td>
            <td class="right"><?php if ($sort == 'sort_order') { ?>
              <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
              <?php } else { ?>
              <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
              <?php } ?></td>
            <td class="right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($banks) { ?>
          <?php foreach ($banks as $bank) { ?>
          <tr>
            <td style="text-align: center;"><?php if ($bank['selected']) { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $bank['bank_id']; ?>" checked="checked" />
              <?php } else { ?>
              <input type="checkbox" name="selected[]" value="<?php echo $bank['bank_id']; ?>" />
              <?php } ?></td>
            <td class="left"><?php echo $bank['name']; ?></td>
            <td class="left"><?php echo $bank['branch']; ?></td>
            <td class="left"><?php echo $bank['account_number']; ?></td>
            <td class="left"><?php echo $bank['account_holder']; ?></td>
            <td class="right"><?php echo $bank['sort_order']; ?></td>
            <td class="right"><?php foreach ($bank['action'] as $action) { ?>
              [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
              <?php } ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
    <div class="pagination"><?php echo $pagination; ?></div>
  </div>
</div>
</div>
<?php echo $footer; ?>