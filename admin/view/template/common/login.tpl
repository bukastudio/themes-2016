<?php echo $header; ?>
<style>
  html {
    /*background-color: #37BCCF;*/
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    background: #37bccf; /* Old browsers */
    background: -moz-linear-gradient(top, #37bccf 0%, #137e93 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #37bccf 0%,#137e93 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #37bccf 0%,#137e93 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  }
  *,*:before,*:after {
      -webkit-box-sizing: inherit;
      -moz-box-sizing: inherit;
      box-sizing: inherit;
  }
  body #container {
    /*background-color: #37BCCF;*/
    background: #37bccf; /* Old browsers */
    background: -moz-linear-gradient(top, #37bccf 0%, #137e93 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(top, #37bccf 0%,#137e93 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to bottom, #37bccf 0%,#137e93 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  }
  #content {
    min-width: initial;
  }
  #footer {
    /*background-color: #37BCCF;*/
    background-color: transparent;
    visibility: hidden;
    color: #37BCCF;
    /*display: none;*/
  }
  #footer a {
    color: #37BCCF;
  }
  .box{
    /*background-color: #071139;*/
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    /*padding: 10px;*/
  }
  .box > .content {
    padding-top: 0;
  }
  .box .header {
    text-align: center;
    padding: 30px 0;
  }
  .form-group {
    /*background-color: rgba(204, 204, 0, 0.2);*/
    /*padding: 10px;*/
    margin-bottom: 10px;
    display: block;
  }
  .form-group:last-of-type {
    text-align: right;
  }
  label {
    color: #071139;
    font-size: .9em;
    display: block;
  }
  input[type="text"],
  input[type="password"] {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;

    font-size: 16px;
    width: 100%;
    background-color: white;
    border-top: solid 1px #2da1b3;
    border-left: solid 1px #2da1b3;
    border-right: solid 1px #2da1b3;
    border-bottom: solid 1px #2da1b3;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    padding: 10px 8px 11px;
  }
  .forgotten {
    margin-top: 15px;
  }
  .forgotten a {
    color: #071139;
  }
  a.button {
    background-color: #071139;
    color: white;
    font-size: 16px;
    margin-top: 20px;
    padding: 12px 20px;
    letter-spacing: 5px;
    /*border: 1px solid #30a8bb;*/
    border: none;
    width: 100%;
    text-align: center;
    text-transform: uppercase;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
  }
  a.button:hover {
    background-color: black;
  }
</style>
<div id="content" >
  <div class="box" style="width: 300px; min-height: 200px; margin-top: 100px; margin-left: auto; margin-right: auto;">

    <div class="header">
      <img src="/admin/view/image/bukatoko-logo.png" alt="Logo Bukatoko">
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      <?php if ($success) { ?>
      <div class="success"><?php echo $success; ?></div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="warning"><?php echo $error_warning; ?></div>
      <?php } ?>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

        <div class="form-group">
          <label for=""><?php echo $entry_username; ?></label>
          <input type="text" name="username" value="<?php echo $username; ?>" style="margin-top: 4px;" />
        </div>
        <div class="form-group">
          <label for=""><?php echo $entry_password; ?></label>
          <input type="password" name="password" value="<?php echo $password; ?>" style="margin-top: 4px;" />
          <?php if ($forgotten) { ?>
          <div class="forgotten">
            <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
          </div>
          <?php } ?>
        </div>
        <div class="form-group">
          <a onclick="$('#form').submit();" class="button"><?php echo $button_login; ?></a>
        </div>

        <?php if ($redirect) { ?>
        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script>
<?php echo $footer; ?>
