<?php if (count($languages) > 1) { ?>
  <div id="language">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">

        <div class="selection">
          <?php foreach ($languages as $language) { ?>
            <img width="16" height="16" src="<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" onclick="$('input[name=\'language_code\']').attr('value', '<?php echo $language['code']; ?>'); $(this).parent().parent().submit();" />

          <?php } ?>
        </div>

        <div class="selected">
          <?php foreach ($languages as $language) { ?>
            <?php if ($language['code'] == $language_code) { ?>
            <img width="16" height="16" src="<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" onclick="$('input[name=\'language_code\']').attr('value', '<?php echo $language['code']; ?>'); $(this).parent().parent().submit();" />
            <?php } ?>
          <?php } ?>
        </div>

      <input type="hidden" name="language_code" value="" />
      <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
    </form>
  </div>
<?php } ?>
