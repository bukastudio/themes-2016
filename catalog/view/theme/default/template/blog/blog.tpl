<?php echo $header; ?>

<div id="blogBlogPage" class="contentSlot blogPage">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
      <div id="breadCrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
      </div>
    </div>

    <div class="contentRow sidebarRight">
      <div class="row">
        <div class="columnCenter">
          <div class="sideLine">
          <?php echo $content_top ;?>

          <div id="pageHeader">
            <h1><?php echo $heading_title; ?></h1>
              <small class="article-date"><?php echo $date_added; ?></small>
          </div>

          <div id="pageContent">
            <div class="article-description"><?php echo $description; ?></div>

            <?php if ($tags) { ?>
            <div class="article-tags"><b><?php echo $text_tags; ?></b>
              <?php foreach ($tags as $tag) { ?>
              <a href="<?php echo $tag['href']; ?>"><?php echo $tag['tag']; ?></a>,
              <?php } ?>
            </div>
            <?php } ?>

            <?php if ($blog) { ?>
              <div class="article-module">
                <h4><?php echo $tab_related; ?></h4>
                <ul>
                  <?php foreach ($blog as $related_blog) { ?>
                    <li style="padding: 2px;"><a href="<?php echo $related_blog['href']; ?>"><?php echo $related_blog['name']; ?></a> <span style="color: gray; font-size: 11px;">(<?php echo $related_blog['date_added']; ?>)</span></li>
                  <?php } ?>
                </ul>
              </div>
             <?php } ?>

            <?php echo $content_bottom ;?>
          </div>
          </div>
        </div>

        <div class="columnRight sideBar">
          <?php echo $column_right ;?>
        </div>

      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>
