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
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table id="module" class="list">
        <thead>
          <tr>
          	<td class="left"><?php echo $entry_testimonial; ?></td>
            <td class="left"><?php echo $entry_limit; ?></td>
            <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="right"><?php echo $entry_sort_order; ?></td>
            <td></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { ?>

        <?php
        if(isset($module['testimonials'])) {
        	$all_testimonials = $module['testimonials'];
        } else {
       		$all_testimonials = array();
        }
        ?>

        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
          	<td class="left">
              <div class="scrollbox" style="min-width:430px; min-height:200px;">
              <?php $class = 'odd'; ?>
              <?php foreach ($testimonials as $testimonial) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                      <?php if (in_array($testimonial['testimonial_id'], $all_testimonials)) { ?>
                      	<input type="checkbox" name="po_testimonials_module[<?php echo $module_row; ?>][testimonials][]" value="<?php echo $testimonial['testimonial_id']; ?>" checked="checked" />
                      	<?php echo utf8_substr(strip_tags(html_entity_decode($testimonial['text'], ENT_QUOTES, 'UTF-8')), 0, 130) . '..'; ?>
                      <?php } else { ?>
                      	<input type="checkbox" name="po_testimonials_module[<?php echo $module_row; ?>][testimonials][]" value="<?php echo $testimonial['testimonial_id']; ?>" />
                      	<?php echo utf8_substr(strip_tags(html_entity_decode($testimonial['text'], ENT_QUOTES, 'UTF-8')), 0, 130) . '..'; ?>
                      <?php } ?>
                  </div>
              <?php } ?>
              </div>
            </td>
            <td class="left"><input type="text" name="po_testimonials_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" size="1" /></td>
            <td class="left"><select name="po_testimonials_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td class="left"><select name="po_testimonials_module[<?php echo $module_row; ?>][position]">
                <?php if ($module['position'] == 'content_top') { ?>
                <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                <?php } else { ?>
                <option value="content_top"><?php echo $text_content_top; ?></option>
                <?php } ?>
                <?php if ($module['position'] == 'content_bottom') { ?>
                <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                <?php } else { ?>
                <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                <?php } ?>
                <?php if ($module['position'] == 'column_left') { ?>
                <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                <?php } else { ?>
                <option value="column_left"><?php echo $text_column_left; ?></option>
                <?php } ?>
                <!--
                <?php if ($module['position'] == 'column_right') { ?>
                <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                <?php } else { ?>
                <option value="column_right"><?php echo $text_column_right; ?></option>
                <?php } ?>
                -->
              </select></td>
            <td class="left"><select name="po_testimonials_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
            <td class="right"><input type="text" name="po_testimonials_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } ?>
        <tfoot>
          <tr>
            <td colspan="6"></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left">';
	html += '		<div class="scrollbox" style="min-width:430px; min-height:200px;">';
	<?php $class = 'odd'; ?>
	<?php foreach ($testimonials as $testimonial) { ?>
	<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
	html += '			<div class="<?php echo $class; ?>">';

	html += '				<input type="checkbox" name="po_testimonials_module[' + module_row + '][testimonials][]" value="<?php echo $testimonial['testimonial_id']; ?>" />';
	html += '<?php echo utf8_substr(strip_tags(html_entity_decode($testimonial['text'], ENT_QUOTES, 'UTF-8')), 0, 130) . '..'; ?>';

	html += '    		</div>';
	<?php } ?>
	html += '    	</div>';
    html += '    </td>';
	html += '    <td class="left"><input type="text" name="po_testimonials_module[' + module_row + '][limit]" value="5" size="1" /></td>';
	html += '    <td class="left"><select name="po_testimonials_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="po_testimonials_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	//html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="po_testimonials_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="po_testimonials_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}
//--></script>
<?php echo $footer; ?>