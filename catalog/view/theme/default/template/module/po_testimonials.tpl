<?php if (isset($testimonials)) { ?>
  <div id="moduleTestimonial" class="module module--paragraph">
    <div class="module_header">
        <?php echo $heading_title; ?>
    </div>
    <div class="module_content">

      <div class="row"><?php foreach ($testimonials as $testimonial) { ?>
          <div class="column">
            <blockquote>
              <p><?php echo $testimonial['text']; ?></p>
              <footer><?php echo $testimonial['author']; ?></footer>
            </blockquote>
          </div>
        <?php } ?></div>
      <div class="view-all">
        <a href="<?php echo $view_all; ?>"><?php echo $text_view_all; ?></a>
      </div>

    </div>
  </div>
<?php } ?>
