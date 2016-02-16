<?php echo $header; ?>

<div id="testimonialPage" class="contentSlot">
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

                  <fieldset>
                    <div class="form-group">
                      <label for=""><?php echo $entry_testimonial; ?></label>
                      <div class="control">
                        <textarea name="testimonial" cols="40" rows="5" style="width: 99%;"><?php echo $testimonial; ?></textarea>
                        <?php if ($error_testimonial) { ?>
                          <span class="error"><?php echo $error_testimonial; ?></span>
                        <?php } ?>
                      </div>
                    </div>

                    <div class="form-group captcha">
                      <label for=""><?php echo $entry_captcha; ?></label>
                      <div class="control">
                        <img src="index.php?route=information/contact/captcha" alt="" />
                        <input type="text" name="captcha" value="<?php echo $captcha; ?>" />
                        <?php if ($error_captcha) { ?>
                          <span class="error"><?php echo $error_captcha; ?></span>
                        <?php } ?>
                      </div>
                    </div>

                    <div class="form-group">
                        <div class="button-block">
                          <input type="submit" value="<?php echo $button_submit; ?>" class="button" /> <a href="<?php echo $continue; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
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
