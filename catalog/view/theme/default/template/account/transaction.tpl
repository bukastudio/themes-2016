<?php echo $header; ?>

<div id="transactionPage" class="contentSlot">
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
            <?php if ($transactions) { ?>
              <p><?php echo $text_total; ?><strong> <?php echo $total; ?></strong>.</p>

              <div id="table-transaction" class="table table-clean table-noborder table-hover">
                <div class="tableHead">
                  <div class="tableRow">
                    <div><?php echo $column_date_added; ?></div>
                    <div><?php echo $column_description; ?></div>
                    <div class="right"><?php echo $column_amount; ?></div>
                  </div>
                </div>
                <div class="tableBody">
                  <?php foreach ($transactions  as $transaction) { ?>
                    <div class="tableRow">
                      <div><strong class="show_mobile"><?php echo $column_date_added; ?>: </strong> <?php echo $transaction['date_added']; ?></div>
                      <div>
                        <strong class="show_mobile"><?php echo $column_description; ?>: </strong> <?php echo $transaction['description']; ?>
                      </div>
                      <div class="right"><strong class="show_mobile"><?php echo $column_amount; ?>: </strong> <?php echo $transaction['amount']; ?></div>
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
