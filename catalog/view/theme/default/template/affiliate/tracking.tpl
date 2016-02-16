<?php echo $header; ?>

<div id="affiliateTrackingPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow">
      <?php echo $content_top ;?>
    </div>

    <div class="contentRow sidebarNone">
      <div class="row">

        <div class="columnCenter">

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <div id="pageContent">
            <div class="row">

              <div class="column">
                <p><?php echo $text_description; ?></p>
                <form action="" class="horizontal">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><?php echo $text_code; ?></label>
                      <div class="control">
                        <textarea cols="40" rows="1"><?php echo $code; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $text_generator; ?></label>
                      <div class="control">
                        <input type="text" name="product" value="" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $text_link; ?></label>
                      <div class="control">
                        <textarea name="link" cols="40" rows="5"></textarea>
                      </div>
                    </div>
                  </fieldset>

                  <div class="button-block">
                    <a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a> <a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                  </div>
                </form>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=affiliate/tracking/autocomplete&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.link
					}
				}));
			}
		});
	},
	select: function(event, ui) {
		$('input[name=\'product\']').attr('value', ui.item.label);
		$('textarea[name=\'link\']').attr('value', ui.item.value);

		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
//--></script>
<?php echo $footer; ?>
