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

  <?php if (isset($success)) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>

  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
		<a onclick="$('#stayid').attr('value', '0'); $('#form').submit();" class="button"><span><?php echo $button_save_go; ?></span></a>
		<a onclick="$('#stayid').attr('value', '1'); $('#form').submit();" class="button"><span><?php echo $button_save_stay; ?></span></a>
		<a href="<?php echo $cancel; ?>" class="button"><span><?php echo $button_cancel; ?></span></a>
	  </div>
    </div>
    <div class="content">
	  <div class="htabs">
		    <a href="#tab-product-settings"><?php echo $tab_product_settings; ?></a>
		    <a href="#tab-category-settings"><?php echo $tab_category_settings; ?></a>
		    <a href="#tab-help"><?php echo $tab_help; ?></a>
      </div>

      <form action="<?php echo $action; ?>" method="post" id="form">
	  <input type="hidden" name="stay" id="stayid" value="1">
	  <div id="tab-product-settings">
        <table class="form">
          <tbody>
            <tr>
				<td><?php echo $entry_show_in_product; ?></td>
				<td>
					<select name="countdowntimer_product">
					<?php if ($countdowntimer_product) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_text_timer; ?><br><span class="help"><?php echo $entry_text_timer_help; ?></span></td>
				<td>
					<select name="countdowntimer_product_texttimer">
					<?php if ($countdowntimer_product_texttimer) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_days_timer; ?></td>
				<td>
					<select name="countdowntimer_product_days">
					<?php if ($countdowntimer_product_days) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_countdays_timer; ?><br><span class="help"><?php echo $entry_countdays_timer_help; ?></span></td>
				<td>
					<select name="countdowntimer_product_countdays">
					<?php if ($countdowntimer_product_countdays) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_sec_timer; ?></td>
				<td>
					<select name="countdowntimer_product_seconds">
					<?php if ($countdowntimer_product_seconds) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
	  </div>

	  <div id="tab-category-settings">
        <table class="form">
          <tbody>
            <tr>
				<td><?php echo $entry_show_in_category; ?></td>
				<td>
					<select name="countdowntimer_category">
					<?php if ($countdowntimer_category) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_text_timer; ?><br><span class="help"><?php echo $entry_text_timer_help; ?></span></td>
				<td>
					<select name="countdowntimer_category_texttimer">
					<?php if ($countdowntimer_category_texttimer) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
            <tr>
				<td><?php echo $entry_days_timer; ?></td>
				<td>
					<select name="countdowntimer_category_days">
					<?php if ($countdowntimer_category_days) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
				<td><?php echo $entry_countdays_timer; ?><br><span class="help"><?php echo $entry_countdays_timer_help; ?></span></td>
				<td>
					<select name="countdowntimer_category_countdays">
					<?php if ($countdowntimer_category_countdays) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			<tr>
			</tr>
            <tr>
				<td><?php echo $entry_sec_timer; ?></td>
				<td>
					<select name="countdowntimer_category_seconds">
					<?php if ($countdowntimer_category_seconds) { ?>
						<option value="1" selected="selected"
						><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					<?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"
						><?php echo $text_disabled; ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
		</table>
	  </div>
      </form>

	  <div id="tab-help">
		<? echo $text_description; ?>
	  </div>

	  <div style="margin-top:25px;border-top:1px dashed #ccc;padding-top:15px;text-align:center;"><? echo $text_help; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('.htabs a').tabs();
//--></script>
<?php echo $footer; ?>