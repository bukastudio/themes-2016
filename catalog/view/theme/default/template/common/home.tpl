<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarRight";} else {$slotclass = "sidebarNone";};?>

<div id="homePage" class="contentSlot">
  <div class="container">
    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnCenter">
          <?php echo $content_top ;?>
          <div id="homeBanner">
            <div class="wrapper">
              <div class="homeBanner_left">
                <?php echo $content_left ;?>
              </div>
              <div class="homeBanner_right">
                <?php echo $content_right ;?>
              </div>
            </div>
          </div>
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
