<?php echo $header; ?>

<div id="blogSearchPage" class="contentSlot blogPage">
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
            <fieldset>
              <div class="form-group">
                <?php if ($filter_name_blog) { ?>
                  <input type="text" name="filter_name_blog" value="<?php echo $filter_name_blog; ?>" />
                  <?php } else { ?>
                  <input type="text" name="filter_name_blog" value="<?php echo $filter_name_blog; ?>" onclick="this.value = '';" onkeydown="this.style.color = '000000'" style="color: #999;" />
                <?php } ?>
                <select name="filter_blog_category_id">
                  <option value="0"><?php echo $text_blog_category; ?></option>
                  <?php foreach ($categories as $category_1) { ?>
                  <?php if ($category_1['blog_category_id'] == $filter_blog_category_id) { ?>
                  <option value="<?php echo $category_1['blog_category_id']; ?>" selected="selected"><?php echo $category_1['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category_1['blog_category_id']; ?>"><?php echo $category_1['name']; ?></option>
                  <?php } ?>
                  <?php foreach ($category_1['children'] as $category_2) { ?>
                  <?php if ($category_2['blog_category_id'] == $filter_blog_category_id) { ?>
                  <option value="<?php echo $category_2['blog_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category_2['blog_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_2['name']; ?></option>
                  <?php } ?>
                  <?php foreach ($category_2['children'] as $category_3) { ?>
                  <?php if ($category_3['blog_category_id'] == $filter_blog_category_id) { ?>
                  <option value="<?php echo $category_3['blog_category_id']; ?>" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $category_3['blog_category_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category_3['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <div class="checkbox">
                  <label for="sub_blog_category">
                    <?php if ($filter_sub_blog_category) { ?>
                    <input type="checkbox" name="filter_sub_blog_category" value="1" id="sub_blog_category" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="filter_sub_blog_category" value="1" id="sub_blog_category" />
                    <?php } ?>
                    <?php echo $text_sub_blog_category; ?>
                  </label>
                </div>
                <div class="checkbox">
                  <label for="description">
                    <?php if ($filter_description) { ?>
                      <input type="checkbox" name="filter_description" value="1" id="description" checked="checked" />
                      <?php } else { ?>
                      <input type="checkbox" name="filter_description" value="1" id="description" />
                      <?php } ?>
                    <?php echo $entry_description; ?>
                  </label>
                </div>
              </div>

              <div class="form-group">
                <input type="button" value="<?php echo $button_search; ?>" id="button-search" class="button" />
              </div>

            </fieldset>

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
$('#pageContent input[name=\'filter_name_blog\']').keydown(function(e) {
  if (e.keyCode == 13) {
    $('#button-search').trigger('click');
  }
});

$('#button-search').bind('click', function() {
  url = 'index.php?route=blog/search';

  var filter_name_blog = $('#pageContent input[name=\'filter_name_blog\']').attr('value');

  if (filter_name_blog) {
    url += '&filter_name_blog=' + encodeURIComponent(filter_name_blog);
  }

  var filter_blog_category_id = $('#pageContent select[name=\'filter_blog_category_id\']').attr('value');

  if (filter_blog_category_id > 0) {
    url += '&filter_blog_category_id=' + encodeURIComponent(filter_blog_category_id);
  }

  var filter_sub_blog_category = $('#pageContent input[name=\'filter_sub_blog_category\']:checked').attr('value');

  if (filter_sub_blog_category) {
    url += '&filter_sub_blog_category=true';
  }

  var filter_description = $('#pageContent input[name=\'filter_description\']:checked').attr('value');

  if (filter_description) {
    url += '&filter_description=true';
  }

  location = url;
});

//--></script>

<?php echo $footer; ?>
