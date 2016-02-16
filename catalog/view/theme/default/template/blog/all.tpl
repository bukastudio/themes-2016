<?php echo $header; ?>

<div id="blogAllPage" class="contentSlot blogPage">
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
          </div>

          <div id="pageContent">

            <?php if ($blog) { ?>
              <div id="blogFilter">
                <div class="wrapper">
                  <div class="limit">
                    <strong><?php echo $text_limit; ?></strong>
                    <select onchange="location = this.value;">
                      <?php foreach ($limits as $limits) { ?>
                      <?php if ($limits['value'] == $limit) { ?>
                      <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if ($blog) { ?>
              <div id="blogList">
                <?php foreach ($blog as $blog_item) { ?>
                  <div class="blogArticle">
                    <div class="blogArticle_title">
                      <h2>
                        <a href="<?php echo $blog_item['href']; ?>"><?php echo $blog_item['name']; ?></a>
                      </h2>
                    </div>
                    <div class="blogArticle_date"><?php echo $blog_item['date_added']; ?></div>
                    <div class="blogArticle_description">
                      <p><?php echo $blog_item['short_description']; ?></p>
                      <p class="read-more"><a href="<?php echo $blog_item['href']; ?>">Read more...</a></p>
                    </div>
                  </div>
                <?php } ;?>
              </div>
              <div class="pagination"><?php echo $pagination; ?></div>
            <?php } ;?>

            <?php if (!$blog) { ?>
              <?php echo $text_empty; ?>
            <?php } ?>

            <?php echo $content_bottom ;?>
          </div>
          </div>
        </div>

        <div class="columnRight sideBar">
          <div id="blogSearch">
            <input type="text" name="filter_name_blog" /><a id="button-search-blog" class="button"><i class="icon-search"></i><span><?php echo $button_search; ?></span></a>
          </div>
          <?php echo $column_right ;?>
        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('#blogSearch input[name=\'filter_name_blog\']').keydown(function(e) {
  if (e.keyCode == 13) {
    $('#button-search-blog').trigger('click');
  }
});

$('#button-search-blog').bind('click', function() {
  url = 'index.php?route=blog/search';

  var filter_name_blog = $('#blogSearch input[name=\'filter_name_blog\']').attr('value');

  if (filter_name_blog) {
    url += '&filter_name_blog=' + encodeURIComponent(filter_name_blog);
  }

  location = url;
});

//--></script>

<?php echo $footer; ?>
