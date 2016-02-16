 <?php echo $header; ?>
<div id="content">
  <?php if ($success) { ?>
  <div class="success">Success: POS Settings Updated Successfully!</div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/setting.png" alt="" />Settings</h1>
      <div class="buttons">
          <a onclick="$('#form').submit();" class="button">Save</a>
          <a href="<?php echo $cancel; ?>" class="button">Cancel</a>
      </div>      
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" id="form">
          <table class="form">
            <tr>
            <td>POS tin no</td>
              <td>
                <input type="text" value="<?= $pos_tin_no ?>" name="pos_tin_no">
              </td>
            </tr>
            
            <tr>
            <td>POS show store address?</td>
              <td>
                <select name="pos_show_address">
                    <?php if($pos_show_address){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    <?php }else{  ?>
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    <?php } ?>
                </select>
              </td>
            </tr>
            
            <tr>
            <td>POS show telephone?</td>
              <td>
                <select name="pos_show_telephone">
                    <?php if($pos_show_telephone){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    <?php }else{  ?>
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    <?php } ?>
                </select>
              </td>
            </tr>
            
            <tr>
            <td>POS show store name?</td>
              <td>
                <select name="pos_show_store_name">
                    <?php if($pos_show_store_name){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    <?php }else{  ?>
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    <?php } ?>
                </select>
              </td>
            </tr>
            <td>POS show tin no?</td>
              <td>
                <select name="pos_show_tin_no">
                    <?php if($pos_show_tin_no){ ?>
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    <?php }else{  ?>
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
            <td>POS user group id</td>
              <td>
                 <select name="pos_user_group_id">
                  <?php foreach ($user_groups as $user_group) { ?>
                  <?php if ($user_group['user_group_id'] == $pos_user_group_id) { ?>
                  <option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
            <td>POS default store</td>
              <td>
                 <select name="pos_default_store">
                     
                  <?php if($pos_default_store==0){ ?>  
                    <option value="0" selected="selected"><?php echo $config_name; ?></option>
                  <?php }else{ ?>
                    <option value="0"><?php echo $config_name; ?></option>
                  <?php } ?>
                  
                  <?php foreach ($stores as $store) { ?>                  
                  <?php if ($store['store_id'] == $pos_default_store) { ?>
                    <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
          </table>
      </form>
    </div>
  </div><!-- END box -->
</div><!-- END content -->

<?php echo $footer; ?>

                