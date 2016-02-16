<?php echo $header; ?>

<div id="affiliateAccountPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">

      <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
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

              <div class="column">
                <h3><?php echo $text_my_account; ?></h3>
                <ul>
                  <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                  <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                  <li><a href="<?php echo $payment; ?>"><?php echo $text_payment; ?></a></li>
                  <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                </ul>
              </div>

              <div class="column">
                <h3><?php echo $text_my_tracking; ?></h3>
                <ul>
                  <li><a href="<?php echo $tracking; ?>"><?php echo $text_tracking; ?></a></li>
                </ul>
              </div>

              <div class="column">
                <h3><?php echo $text_my_transactions; ?></h3>
                <ul>
                  <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                </ul>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
