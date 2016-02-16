<?php echo $header; ?>

<div id="informationTestimonialPage" class="contentSlot">
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
            <div class="row">

              <?php foreach($testimonials as $testimonial) { ?>
                <div class="column">
                  <blockquote>
                    <p><?php echo $testimonial['text'] ?></p>
                    <footer><?php echo $testimonial['author'] ?></footer>
                  </blockquote>
                </div>
                <?php } ?>
              <?php echo $content_bottom ;?>
            </div>
            <div class="pagination"><?php echo $pagination; ?></div>
          </div>

        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
