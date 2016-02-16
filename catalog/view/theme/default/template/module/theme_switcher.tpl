<?php if ($themes) { ?>
<div class="module">
  <div class="module_header"><?php echo $heading_title; ?></div>
  <div class="module_content">
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="module_theme_switcher">
      <div align="center" id="tab_general" class="page">
      <select name="product" onchange="location=this.value">
            <?php foreach ($themes as $theme) { ?>
            <?php if (isset($this->session->data['theme'])) { ?>
            <option value="<?php echo $theme['href']; ?>" <?php echo (ucwords($this->session->data['theme']) == $theme['name']) ? 'selected="selected"' : ''?>><?php echo $theme['name']; ?></option>
            <?php } else { ?>
			      <option value="<?php echo $theme['href']; ?>" <?php echo (ucwords($this->config->get('config_template'))) == $theme['name'] ? 'selected="selected"' : ''?>><?php echo $theme['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
      </div>
    </form>
  </div>
</div>
<?php } ?>
