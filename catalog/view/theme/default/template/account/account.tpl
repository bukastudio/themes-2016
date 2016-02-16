<?php echo $header; ?>

<div id="accountPage" class="contentSlot">
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
                  <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                  <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                  <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                </ul>
              </div>

              <div class="column">
                <h3><?php echo $text_my_orders; ?></h3>
                <ul>
                  <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                  <!-- <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li> -->
                  <?php if ($reward) { ?>
                  <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
                  <?php } ?>
                  <?php if($this->config->get('config_footer_return')) { ;?>
                    <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                  <?php } ;?>
                  <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                  <!-- <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li> -->
                </ul>
              </div>

              <div class="column">
                <h3><?php echo $text_my_newsletter; ?></h3>
                <ul>
                  <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
                  <?php if($this->config->get('config_footer_testimonial')) { ;?>
                  <li><a href="<?php echo $testimonial; ?>"><?php echo $text_testimonial; ?></a></li>
                  <?php } ;?>
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
