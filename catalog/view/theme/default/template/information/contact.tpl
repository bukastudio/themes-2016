<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarLeft";} else {$slotclass = "sidebarNone";};?>

<div id="informationContactPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnLeft sideBar">
          <?php echo $column_left ;?>
        </div>

        <div class="columnCenter">
          <?php echo $content_top ;?>

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <div id="contactBox">
            <div class="row">
              <div id="contactForm">

                <form class="form--horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <fieldset>
                    <legend>
                      Please fill in the form below.
                    </legend>
                    <div class="form-group">
                      <label for=""><?php echo $entry_name; ?></label>
                      <div class="form-control">
                        <input type="text" name="name" value="<?php echo $name; ?>" />
                      </div>
                      <?php if ($error_name) { ?>
                        <span class="error"><?php echo $error_name; ?></span>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $entry_email; ?></label>
                      <div class="form-control">
                        <input type="text" name="email" value="<?php echo $email; ?>" />
                      </div>
                      <?php if ($error_email) { ?>
                        <span class="error"><?php echo $error_email; ?></span>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for=""><?php echo $entry_enquiry; ?></label>
                      <div class="form-control">
                        <textarea name="enquiry" cols="40" rows="5" style="width: 99%;"><?php echo $enquiry; ?></textarea>
                      </div>
                      <?php if ($error_enquiry) { ?>
                        <span class="error"><?php echo $error_enquiry; ?></span>
                      <?php } ?>
                    </div>
                    <div class="form-group captcha">
                      <label for="">&nbsp;</label>
                      <div class="form-control">
                        <?php echo $entry_captcha; ?>
                        <img src="index.php?route=information/contact/captcha" alt="Captcha" /><input type="text" name="captcha" value="<?php echo $captcha; ?>" />
                      </div>
                      <?php if ($error_captcha) { ?>
                        <span class="error"><?php echo $error_captcha; ?></span>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <label for="">&nbsp;</label>
                      <div class="form-control">
                        <div class="button-block"><input type="submit" value="<?php echo $button_continue; ?>" class="btn" />
                        </div>
                      </div>
                    </div>

                  </fieldset>
                </form>

              </div>
              <div id="contactAddress">
                <div><strong><?php echo $text_address; ?></strong><br>
                  <?php echo $this->config->get('config_address') ;?></div>

                <?php if ($telephone) { ?>
                  <div><strong><?php echo $text_telephone; ?></strong><br>
                    <?php echo $telephone; ?></div>
                <?php } ?>

                <?php if ($fax) { ?>
                  <div><strong><?php echo $text_fax; ?></strong><br>
                    <?php echo $fax; ?></div>
                <?php } ?>

                <?php if($this->config->get('config_whatsapp')) { ;?>
                  <div><strong>WhatsApp</strong><br>
                  <?php echo $this->config->get('config_whatsapp') ;?>
                <?php } ;?></div>
                <?php if($this->config->get('config_blackberry')) { ;?>
                  <div><strong>Blackberry</strong><br>
                    <?php echo $this->config->get('config_blackberry') ;?>
                  </div>
                <?php } ;?>
                <?php if($this->config->get('config_lineapp')) { ;?>
                  <div><strong>LINE</strong><br>
                   <?php echo $this->config->get('config_lineapp') ;?></div>
                <?php } ;?>
                <div><strong>Email</strong><br>
                  <?php echo $this->config->get('config_email') ;?>
                </div>
              </div>
            </div>
          </div>

          <?php echo $content_bottom ;?>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>







<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarLeft";} else {$slotclass = "sidebarNone";};?>

<!-- /CONTENT -->
<div id="content-slot" class="information-page <?php echo $slotclass ;?>">

  <div class="container">
    <div id="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
    </div>

    <div class="row">

      <?php echo $column_left ;?>

      <!-- /Contents -->
      <div id="main-content">

        <div id="contact-background" style="background-image:url('image/data/dummy/bg-contact-page.jpg')">
          <h1><?php echo $heading_title; ?></h1>
          <div class="row">

            <div id="contact-form">
              <div class="wrapper">

              </div>
            </div>

            <div id="contact-info">

            </div>

          </div>
        </div>

        <?php echo $content_bottom ;?>
      </div>

    </div>

  </div>
</div>

<?php echo $footer; ?>
