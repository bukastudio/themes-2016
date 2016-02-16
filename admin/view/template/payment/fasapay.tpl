<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><span class="required">*</span> <?php echo $entry_akun; ?></td>
            <td><input type="text" name="fasapay_akun" value="<?php echo $fasapay_akun; ?>" /> <br>
			<i> Nomor Akun Fasapay </i>
			</td>
             
          </tr>
         <tr>
            <td><span class="required">*</span> <?php echo $entry_store; ?></td>
            <td><input type="text" name="fasapay_store" value="<?php echo $fasapay_store; ?>" /> <br>
			<i> Isikan Nama Store pada setting-an SCI Anda di Fasapay. <br>
			Jika Anda sudah membuat store di FasaPay (khusus anggota FasaPay berstatus Store) maka dia dapat memanfaatkan advance mode. Buat store
			<a href='https://www.fasapay.com/store'> disini </a> 
			</i>
             </td>
          </tr>
		  
		  <tr>
            <td><span class="required">*</span> <?php echo $entry_secretword; ?></td>
            <td><input type="text" name="fasapay_sword" value="<?php echo $fasapay_sword; ?>" /> <br>
			<i> Security Word pada setting-an Store di Fasapay  </i>
             </td>
          </tr>
		  <tr> 
		  <td> </td>
		  <td>  <b>Success url : </b><br> <?php echo $base.'index.php?route=payment/fasapay/success'; ?>  <br>
			   <b> Fail url : </b> <br>   <?php echo $base.'index.php?route=payment/fasapay/fail'; ?> <br> 
			   <b> Status url : </b> <br>   <?php echo $base.'index.php?route=payment/fasapay/confirm'; ?>  <br></td>
		  </tr>
		  
          <tr>
            <td><?php echo $entry_test; ?></td>
            <td><?php if ($fasapay_test) { ?>
              <input type="radio" name="fasapay_test" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="fasapay_test" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="fasapay_test" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="fasapay_test" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
        <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="fasapay_status">
                <?php if ($fasapay_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="fasapay_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $fasapay_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
		  <td><?php echo $entry_failed_status; ?></td>
		  <td><select name="fasapay_failed_status">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $fasapay_failed_status) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select> <br>
			  <i> Status Order jika transaksi pembayaran di Fasapay Gagal</i>
		  </td>
          <tr>
		  <tr>
		  <td><?php echo $entry_success_status; ?></td>
		  <td><select name="fasapay_success_status">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $fasapay_success_status) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select> <br>
			  <i> Status Order jika transaksi pembayaran di Fasapay Sukses </i></td>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="fasapay_sort_order" value="<?php echo $fasapay_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 