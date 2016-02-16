<?php echo $header; ?>

<div id="affiliateForgottenPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
      <?php } ?>

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
                <p><?php echo $text_email; ?></p>

                <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><?php echo $entry_email; ?></label>
                      <div class="control"><input type="text" name="email" value="" /></div>
                    </div>
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <div class="control"><input type="submit" value="<?php echo $button_continue; ?>" class="button" /> <a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a></div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
