<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
	  <!--<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="formsendsms">-->
	  <form action="" method="post" enctype="multipart/form-data" id="formsendsms">
	  
	  	<?php if ($success) { ?>
	    <span class="success"><?php echo $success; ?></span><br /><br />
	    <?php } ?>
	    
	    <?php if ($error) { ?>
	    <span class="error"><?php echo $error; ?></span><br />
	    <?php } ?>
	    
	    <?php if ($error_limit) { ?>
	    <span class="error"><?php echo $error_limit; ?></span><br />
	    <?php } ?>
	    
	    <?php if ($error_nohp) { ?>
	    <span class="error"><?php echo $error_nohp; ?></span><br />
	    <?php } ?>
	    
	    <?php if ($error_message) { ?>
      <span class="error"><?php echo $error_message; ?></span><br />
      <?php } ?>
	      
	  	<?php echo $text_nohp; ?><br />
	  	<input type="text" name="nohp" value="" onkeyup="this.value = this.value.replace (/\D+/, '')"><br />
		  	
	  	<?php echo $text_message; ?>
	  	<textarea name="message" rows="6" maxlength="150"></textarea><br /><?php echo $text_characters; ?><br />
	  	<a onclick="$('#formsendsms').submit();" class="button"><?php echo $button_send; ?></a>
	  </form>  	
  </div>
</div>
