<?php echo $header; ?>

<div id="notFoundPage" class="contentSlot">
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

          <div id="pageContent">
            <h1><?php echo $heading_title; ?></h1>
            - - - - -
            <p><?php echo $text_error; ?></p>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
