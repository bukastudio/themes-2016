<div class="blogModule">
  <div class="blogModule_header">
    <?php echo $heading_title; ?>
  </div>
  <div class="blogModule_content">
    <ul>
      <?php foreach ($blog as $blog_item) { ?>
        <li>
          <a href="<?php echo $blog_item['href']; ?>"><?php echo $blog_item['name']; ?></a>
        </li>
      <?php } ?>
    </ul>
  </div>
</div>
