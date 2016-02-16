<?php echo $header; ?>

<div id="addressListPage" class="contentSlot">
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
            <div class="table">
              <div class="tableBody">
                <?php foreach ($addresses as $result) { ?>
                  <div class="tableRow">
                    <div><?php echo $result['address']; ?></div>
                    <div class="action"><a href="<?php echo $result['update']; ?>"><i class="icon-edit"></i><?php echo $button_edit; ?></a><a href="<?php echo $result['delete']; ?>" > <i class="icon-trash-bin"></i><?php echo $button_delete; ?></a>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="button-block">
              <a href="<?php echo $insert; ?>" class="button"><?php echo $button_new_address; ?></a> <a href="<?php echo $back; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
