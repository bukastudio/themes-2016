<?php echo $header; ?>

<div id="returnListPage" class="contentSlot">
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
            <?php if ($returns) { ?>

            <div id="return-list" class="table table-noborder table-hover table-striped table-clean">
              <div class="tableHead">
                <div class="tableRow">
                  <div><?php echo $text_return_id; ?></div>
                  <div><?php echo $text_status; ?></div>
                  <div><?php echo $text_date_added; ?></div>
                  <div><?php echo $text_order_id; ?></div>
                  <div><?php echo $text_customer; ?></div>
                  <div class="action">&nbsp;</div>
                </div>
              </div>
              <div class="tableBody">
                <?php foreach ($returns as $return) { ?>
                  <div class="tableRow">
                    <div><strong class="show_mobile"><?php echo $text_return_id; ?>: </strong> #<?php echo $return['return_id']; ?></div>
                    <div><strong class="show_mobile"><?php echo $text_status; ?>: </strong> <?php echo $return['status']; ?></div>
                    <div><strong class="show_mobile"><?php echo $text_date_added; ?>: </strong> <?php echo $return['date_added']; ?></div>
                    <div><strong class="show_mobile"><?php echo $text_order_id; ?>: </strong> <?php echo $return['order_id']; ?></div>
                    <div><strong class="show_mobile"><?php echo $text_customer; ?>: </strong> <?php echo $return['name']; ?></div>
                    <div class="action"><a href="<?php echo $return['href']; ?>"><i class="icon-view"></i><?php echo $button_view; ?></a></div>
                  </div>
                <?php } ?>
              </div>

            </div>

            <div class="pagination"><?php echo $pagination; ?></div>

              <div class="button-block">
              <a href="<?php echo $continue; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
            </div>
            <?php } else { ?>
              <?php echo $text_empty; ?><br><br>
              <div class="button-block">
                <a href="<?php echo $continue; ?>" class="button btn--neutral"><?php echo $button_back; ?></a>
              </div>
            <?php } ?>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
