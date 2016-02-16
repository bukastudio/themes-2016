<?php echo $header; ?>

<div id="rewardPage" class="contentSlot">
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
            <?php if ($rewards) { ?>
              <p><?php echo $text_total; ?><b> <?php echo $total; ?></b>.</p>

              <div id="table-reward-point" class="table table-clean table-noborder table-hover">
                <div class="tableHead hide_mobile">
                  <div class="tableRow">
                    <div class="nowrap"><?php echo $column_date_added; ?></div>
                    <div><?php echo $column_description; ?></div>
                    <div class="right"><?php echo $column_points; ?></div>
                  </div>
                </div>
                <div class="tableBody">
                  <?php foreach ($rewards  as $reward) { ?>
                    <div class="tableRow">
                      <div><strong class="show_mobile"><?php echo $column_date_added; ?>: </strong> <?php echo $reward['date_added']; ?></div>
                      <div>
                        <?php if ($reward['order_id']) { ?>
                          <strong class="show_mobile"><?php echo $column_description; ?>: </strong> <a href="<?php echo $reward['href']; ?>"><?php echo $reward['description']; ?></a>
                        <?php } else { ?>
                          <strong><?php echo $column_description; ?>: </strong> <?php echo $reward['description']; ?>
                        <?php } ?>
                      </div>
                      <div class="right"><strong class="show_mobile"><?php echo $column_points; ?>: </strong> <?php echo $reward['points']; ?></div>
                    </div>
                  <?php } ;?>
                </div>
              </div>

              <div class="pagination"><?php echo $pagination; ?></div>
            <?php } else { ?>
              <?php echo $text_empty; ?><br><br>
            <?php } ;?>

            <div class="button-block">
              <a href="<?php echo $continue; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
