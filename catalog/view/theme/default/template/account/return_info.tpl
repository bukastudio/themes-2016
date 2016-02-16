<?php echo $header; ?>

<div id="returnInfoPage" class="contentSlot">
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
            <h2><?php echo $text_return_detail; ?></h2>
            <div class="table">
              <div class="tableBody">
                <div class="tableRow">
                  <div class="half">
                    <strong><?php echo $text_return_id; ?></strong> #<?php echo $return_id; ?><br />
                    <strong><?php echo $text_date_added; ?></strong> <?php echo $date_added; ?>
                  </div>
                  <div class="half">
                    <strong><?php echo $text_order_id; ?></strong> #<?php echo $order_id; ?><br />
                    <strong><?php echo $text_date_ordered; ?></strong> <?php echo $date_ordered; ?>
                  </div>
                </div>
              </div>
            </div>

            <h2><?php echo $text_product; ?></h2>
            <div class="table">
              <div class="tableBody">
                <div class="tableRow">
                  <div class="third"><strong><?php echo $column_product; ?></strong><br><?php echo $product; ?></div>
                  <div class="third"><strong><?php echo $column_model; ?></strong><br><?php echo $model; ?></div>
                  <div class="third"><strong><?php echo $column_quantity; ?></strong><br><?php echo $quantity; ?></div>
                </div>
              </div>
            </div>
            <div class="table">
              <div class="tableBody">
                <div class="tableRow">
                  <div class="third"><strong><?php echo $column_reason; ?></strong><br><?php echo $reason; ?></div>
                  <div class="third"><strong><?php echo $column_opened; ?></strong><br><?php echo $opened; ?></div>
                  <div class="third"><strong><?php echo $column_action; ?></strong><br><?php echo $action; ?></div>
                </div>
              </div>
            </div>

            <?php if ($comment) { ?>
              <h2><?php echo $text_comment; ?></h2>
              <?php echo $comment; ?><br><br>
            <?php } ?>
            <?php if ($histories) { ?>
              <h2><?php echo $text_history; ?></h2>
              <div class="table">
                <div class="tableHead">
                  <div class="tableRow">
                    <div><?php echo $column_date_added; ?></div>
                    <div><?php echo $column_status; ?></div>
                    <div><?php echo $column_comment; ?></div>
                  </div>
                </div>
                <div class="tableBody">
                  <?php foreach ($histories as $history) { ?>
                    <div class="tableRow">
                      <div><?php echo $history['date_added']; ?></div>
                      <div><?php echo $history['status']; ?></div>
                      <div><?php echo $history['comment']; ?></div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>

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
