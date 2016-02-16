<?php echo $header; ?>

<div id="loginPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
      <?php } ?>
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

              <div class="contentLeft">
                <!-- <h3><?php echo $text_returning_customer; ?></h3> -->
                <form id="login" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                  <fieldset>
                    <legend><?php echo $text_returning_customer; ?></legend>
                    <div class="form-group">
                      <label><?php echo $entry_email; ?></label>
                      <input type="text" name="email" value="<?php echo $email; ?>" />
                    </div>
                    <div class="form-group">
                      <label><?php echo $entry_password; ?></label>
                      <input type="password" name="password" value="<?php echo $password; ?>" />
                    </div>
                    <div class="form-group">
                      <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="<?php echo $button_login; ?>" class="button" />
                      <?php if ($redirect) { ?>
                        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                      <?php } ?>
                    </div>
                  </fieldset>
                </form>
              </div>

              <div class="contentRight">
                <h3><?php echo $text_register; ?></h3>
                <p><?php echo $text_register_account; ?></p>
                <a href="<?php echo $register; ?>" class="button btn--neutral"><?php echo $button_register; ?></a>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
