<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarRight";} else {$slotclass = "sidebarNone";};?>

<div id="informationInformationPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnCenter">
          <?php echo $content_top ;?>

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <?php echo $description; ?>

          <?php echo $content_bottom ;?>
        </div>

        <div class="columnRight sideBar">
          <?php echo $column_left ;?>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>
