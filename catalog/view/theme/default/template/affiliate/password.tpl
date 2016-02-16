<?php echo $header; ?>

<div id="affiliatePasswordPage" class="contentSlot">
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
                <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <fieldset>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_password; ?></label>
                      <div class="control"><input type="password" name="password" value="<?php echo $password; ?>" />
                      <?php if ($error_password) { ?>
                        <span class="error"><?php echo $error_password; ?></span>
                      <?php } ?></div>
                    </div>
                    <div class="form-group">
                      <label for=""><span class="required">*</span><?php echo $entry_confirm; ?></label>
                      <div class="control"><input type="password" name="confirm" value="<?php echo $confirm; ?>" /><?php if ($error_confirm) { ?>
                        <span class="error"><?php echo $error_confirm; ?></span>
                      <?php } ?></div>

                    </div>
                    <div class="form-group">

                      <div class="button-block">
                        <input type="submit" value="<?php echo $button_continue; ?>" class="button" /><a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
                      </div>
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
