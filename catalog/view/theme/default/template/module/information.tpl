<div id="moduleInformation" class="module module--menu">
  <div class="module_header">
      <?php echo $heading_title; ?>
    </div>
  <div class="module_content">
    <ul>
      <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
      <!-- <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li> -->
    </ul>
  </div>
</div>
