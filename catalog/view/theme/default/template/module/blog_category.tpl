<div class="blogModule blog-menu">
  <div class="blogModule_header">
    <?php echo $heading_title; ?>
  </div>
  <div class="blogModule_content">
    <ul>
      <?php foreach ($categories as $category) { ?>
        <li>
          <?php if ($category['blog_category_id'] == $blog_category_id) { ?>
          <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
          <?php } ?>
          <?php if ($category['children']) { ?>
          <ul>
            <?php foreach ($category['children'] as $child) { ?>
            <li>
              <?php if ($child['blog_category_id'] == $child_id) { ?>
              <a href="<?php echo $child['href']; ?>" class="active"> + <?php echo $child['name']; ?></a>
              <?php } else { ?>
              <a href="<?php echo $child['href']; ?>"> + <?php echo $child['name']; ?></a>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
