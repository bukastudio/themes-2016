<div id="moduleCategory" class="module module--menu">
  <div class="module_header"><?php echo $heading_title; ?></div>
  <div class="module_content">
    <ul>
      <li><a href="<?php echo $new_arrivals; ?>"><span><?php echo $text_new_arrivals; ?></span></a></li>
      <li><a href="<?php echo $sale; ?>"><span><?php echo $text_sale; ?></span></a></li>
      <?php foreach ($categories as $category) { ?>

        <?php if ($category['category_id'] == $category_id) { ?>
          <li class="active <?php if ($category['children']) { echo 'has-children'; };?>">
            <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

        <?php } else { ?>
          <li class="<?php if ($category['children']) { echo 'has-children'; };?>">
            <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

        <?php } ?>

        <?php if ($category['children']) { ?>
          <ul>
            <?php foreach ($category['children'] as $child) { ?>

              <?php if ($child['category_id'] == $child_id) { ?>
                <li><a href="<?php echo $child['href']; ?>" class="active"><span>-</span> <?php echo $child['name']; ?></a></li>
              <?php } else { ?>
                <li><a href="<?php echo $child['href']; ?>"><span>-</span> <?php echo $child['name']; ?></a></li>
              <?php } ?>
            <?php } ?>
          </ul>
        <?php } ?>
        </li>

      <?php } ?>
    </ul>
  </div>
</div>
