<div id="carousel-<?php echo $module; ?>" class="module carousel">
  <?php foreach ($banners as $banner) { ?>
    <?php if ($banner['link']) { ?>
      <div class="item">
        <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" /></a>
      </div>
    <?php } else { ?>
      <div class="item">
        <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
      </div>
    <?php } ?>
  <?php } ?>
</div>