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
      <h1><img src="view/image/information.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-links"><?php echo $tab_links; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="blog_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
               <tr>
              <td><?php echo $entry_short_description; ?></td>
              <td><textarea name="blog_description[<?php echo $language['language_id']; ?>][short_description]" cols="97" rows="5"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['short_description'] : ''; ?></textarea></td>
            </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="blog_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_tag; ?></td>
                <td><input type="text" name="blog_tag[<?php echo $language['language_id']; ?>]" value="<?php echo isset($blog_tag[$language['language_id']]) ? $blog_tag[$language['language_id']] : ''; ?>" size="80" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="blog_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_keyword; ?></td>
                <td><textarea name="blog_description[<?php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><?php echo isset($blog_description[$language['language_id']]) ? $blog_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>
          <?php } ?>
        </div>
        <div id="tab-links">
          <table class="form">
            <tr>
              <td><?php echo $entry_category; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($categories as $category) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($category['blog_category_id'], $blog_category)) { ?>
                    <input type="checkbox" name="blog_category[]" value="<?php echo $category['blog_category_id']; ?>" checked="checked" />
                    <?php echo $category['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="blog_category[]" value="<?php echo $category['blog_category_id']; ?>" />
                    <?php echo $category['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $blog_store)) { ?>
                    <input type="checkbox" name="blog_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="blog_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $blog_store)) { ?>
                    <input type="checkbox" name="blog_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="blog_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <input type="hidden" name="keyword" value="<?php echo $keyword; ?>" />
            <tr>
              <td><?php echo $entry_image; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                <br /><a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>
            <tr>
              <td><?php echo $entry_date_available; ?></td>
              <td><input type="text" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_related; ?></td>
              <td><input type="text" name="related" value="" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><div class="scrollbox" id="blog-related">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($blog_related as $blog_related) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="blog-related<?php echo $blog_related['blog_id']; ?>" class="<?php echo $class; ?>"> <?php echo $blog_related['name']; ?><img src="view/image/delete.png" />
                    <input type="hidden" name="blog_related[]" value="<?php echo $blog_related['blog_id']; ?>" />
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$('input[name=\'related\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/blog/autocomplete&token=<?php echo $token; ?>',
			<?php if($version < '1.5.1.3') { ?>
			type: 'POST',
			<?php } ?>
			dataType: 'json',
			data: 'filter_name=' +  encodeURIComponent(request.term),
			success: function(data) {
				response($.map(data, function(item) {
					return {
						label: item.name,
						value: item.blog_id
					}
				}));
			}
		});

	},
	select: function(event, ui) {
		$('#blog-related' + ui.item.value).remove();

		$('#blog-related').append('<div id="blog-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="blog_related[]" value="' + ui.item.value + '" /></div>');

		$('#blog-related div:odd').attr('class', 'odd');
		$('#blog-related div:even').attr('class', 'even');

		return false;
	}
});

$('#blog-related div img').live('click', function() {
	$(this).parent().remove();

	$('#blog-related div:odd').attr('class', 'odd');
	$('#blog-related div:even').attr('class', 'even');
});
//--></script>
<script type="text/javascript"><!--

$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';

		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');

				currentCategory = item.category;
			}

			self._renderItem(ul, item);
		});
	}
});

//--></script>

<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();

	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script>

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs();
$('#languages a').tabs();
$('#vtab-option a').tabs();
//--></script>
<?php echo $footer; ?>