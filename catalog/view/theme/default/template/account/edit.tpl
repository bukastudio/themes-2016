<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarLeft";} else {$slotclass = "sidebarNone";};?>

<!-- /CONTENT -->
<div id="content-slot" class="account-page <?php echo $slotclass ;?>">

  <div class="container">

    <?php if ($error_warning) { ?>
      <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div id="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
    </div>

    <div class="row">

      <?php echo $column_left ;?>

      <!-- /Contents -->
      <div id="main-content">
        <?php echo $content_top ;?>

        <h1><?php echo $heading_title; ?></h1>

        <div class="row">
          <div class="form-wrapper">
            <form class="horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

              <fieldset>
                <div class="form-group">
                  <label for=""><span class="required">*</span><?php echo $entry_firstname; ?></label>
                  <div class="control">
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                  <?php if ($error_firstname) { ?>
                    <span class="error"><?php echo $error_firstname; ?></span>
                  <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for=""><span class="required">*</span><?php echo $entry_lastname; ?></label>
                  <div class="control">
                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                  <?php if ($error_lastname) { ?>
                    <span class="error"><?php echo $error_lastname; ?></span>
                  <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for=""><span class="required">*</span><?php echo $entry_email; ?></label>
                  <div class="control">
                    <input type="text" name="email" value="<?php echo $email; ?>" />
                  <?php if ($error_email) { ?>
                    <span class="error"><?php echo $error_email; ?></span>
                  <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for=""><span class="required">*</span><?php echo $entry_telephone; ?></label>
                  <div class="control">
                    <input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                  <?php if ($error_telephone) { ?>
                    <span class="error"><?php echo $error_telephone; ?></span>
                  <?php } ?>
                </div>
                  </div>

                <div class="form-group">
                  <label for=""><?php echo $entry_fax; ?></label>
                  <div class="control">
                    <input type="text" name="fax" value="<?php echo $fax; ?>" />
                  </div>
                </div>
              </fieldset>
              <div class="button-block">
                <input type="submit" value="<?php echo $button_continue; ?>" class="btn" /><a href="<?php echo $back; ?>" class="btn btn-neutral"><?php echo $button_back; ?></a>
              </div>

            </form>
          </div>
        </div>

        <?php echo $content_bottom ;?>
      </div>

    </div>

  </div>
</div>

<?php echo $footer; ?>