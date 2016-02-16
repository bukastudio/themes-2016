<!DOCTYPE html>
<html>
<head>
    <title>POS | Login</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" href="view/stylesheet/pos/style.css">
    <link rel="stylesheet" href="view/stylesheet/pos/iconFont.css">
    <link rel="stylesheet" href="view/stylesheet/pos/metro-bootstrap.css">
    <link rel="stylesheet" href="view/stylesheet/pos/jquery.bxslider.css">
    <link rel="stylesheet" href="view/stylesheet/pos/themes/ui-lightness/jquery-ui-1.8.16.custom.css">
    <link rel="stylesheet" href="view/javascript/pos/tinyscrollbar/tinyscrollbar.css">
    <link rel="stylesheet" href="view/javascript/pos/fancybox/jquery.fancybox.css">
    <script type="text/javascript" src="view/javascript/pos/jquery.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/print/printThis.js"></script>
    <script type="text/javascript" src="view/javascript/pos/tinyscrollbar/jquery.tinyscrollbar.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.bxslider.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.keyboard.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="view/javascript/pos/fancybox/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="view/javascript/pos/jquery.maskedinput-1.3.js"></script>
    <link rel="stylesheet" href="view/stylesheet/pos/bukatoko.css" media="screen">
</head>
<body class="metro page-pos-login">
 <div class="container">
  <div class="grid">
    <div class="row">

       <div class="login_wrapper">
          <div class="message_wrapper">
            <?php if ($error_warning) { ?>
              <div class="warning"><?php echo $error_warning; ?></div>
            <?php } ?>
          </div>
          <div class="form_wrapper">
          <div class="panel-header">
            <img src="/admin/view/image/pos/pos-logo.png" alt="POS Logo">
          </div>
          <form action="index.php?route=common/login" method="post" enctype="multipart/form-data" id="form">
            <input type="hidden" name="is_pos" value="1" />
            <table style="width: 100%;">
              <tr>
                <td>
                  <label for=""><?php echo $entry_username; ?></label>
                    <div class="input_wrapper">
                        <div>
                          <select name="username">
                            <?php foreach($users as $user){ ?>
                              <option><?= $user['username'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      <label for=""><?php echo $entry_password; ?></label>
                      <input type="password" name="password" />
                  </div>
                  <!-- END .input_wrapper -->
                  </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                  <td style="text-align: right;">
                      <button type="submit" ><?php echo $button_login; ?></button>
                  </td>
              </tr>
            </table>
            <?php if ($redirect) { ?>
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
            <?php } ?>
          </form>
          </div>
          <!-- END .form-wrapper
        </div>
        <!-- END .login_wrapper -->
    </div>
    <!-- END .row -->
  </div>
  <!-- END .grid -->
 </div>
 <!-- END .container -->
</body>
</html>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
	//	login();
	}
});

function login(){
    $.post('index.php?route=common/login/validate_ajax', $('#form input,#form select'),function(data){
         var data = JSON.parse(data);

         if(data['error']){
            $('.message_wrapper').html('<div class="warning">Invalid username or password.</div>');
         }

         if(data['success']){
             location = 'index.php?route=pos/pos&token='+data['token'];
         }
    });
}
//--></script>