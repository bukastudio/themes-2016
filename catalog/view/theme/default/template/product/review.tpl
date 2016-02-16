<?php if ($reviews) { ?>
  <?php foreach ($reviews as $review) { ?>
    <div class="review-list">
      <div class="wrapper">
        <div class="author"><strong><?php echo $review['author']; ?></strong> <?php echo $text_on; ?> <?php echo $review['date_added']; ?></div>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $review['rating'] . '.png'; ?>" alt="<?php echo $review['reviews']; ?>" /></div>
      </div>
      <div class="text"><?php echo $review['text']; ?></div>
    </div>
  <?php } ?>
  <div class="pagination"><?php echo $pagination; ?></div>
<?php } else { ?>
  <div class="content" style="text-align:center"><?php echo $text_no_reviews; ?></div>
<?php } ?>
