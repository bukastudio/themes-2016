
<!-- FOOTER -->
  <div class="footerSlot">

    <div id="footerRow-1" class="footerRow fiveCols">
      <div class="container">
        <div class="row">

          <div class="footerCol">
            <h4><?php echo $text_information; ?></h4>
            <ul>
              <?php if ($informations) { ?>
                <?php foreach ($informations as $information) { ?>
                <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
                <?php } ?>
              <?php if(!$footer_column) {?><li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li><?php } ;?>
            </ul>
          </div>

          <div class="footerCol">
            <h4><?php echo $text_pages; ?></h4>
            <ul>
              <?php if($display_shop_by_brand) { ;?>
                <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
              <?php } ;?>
              <?php if($display_special) { ;?>
                <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
              <?php } ;?>
              <?php if($display_blog == 1) {;?>
                <li id="menu-blog"><a href="<?php echo $blog; ?>"><span><?php echo $text_blog; ?></span></a></li>
              <?php } ;?>
              <?php if($display_testimonial) { ;?>
                <li><a href="<?php echo $testimonial; ?>"><?php echo $text_testimonial; ?></a></li>
              <?php } ?>
            </ul>
          </div>

          <div class="footerCol">
            <h4><?php echo $text_extra; ?></h4>
            <ul>
              <?php if ($logged) { ?>
                <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
              <?php } ;?>
              <?php if($display_gift_voucher) { ;?>
                <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
              <?php } ;?>
              <?php if($display_affiliate) { ;?>
                <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
              <?php } ;?>

              <?php if($display_return) { ;?>
                <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
              <?php } ;?>
              <li><a href="<?php echo str_replace('&', '&amp;', $payment_confirmation); ?>"><?php echo $text_payment_confirmation; ?></a></li>
            </ul>
          </div>

          <div class="footerCol">
            <h4><?php echo $text_service; ?></h4>
            <ul>
              <li><i class="icon-mobile"></i><span><?php echo $this->config->get('config_telephone') ;?></span></li>
              <?php if($this->config->get('config_whatsapp')) { ;?>
                <li><i class="icon-whatsapp"></i><?php echo $this->config->get('config_whatsapp') ;?></li>
              <?php } ;?>
              <?php if($this->config->get('config_blackberry')) { ;?>
                <li><i class="icon-blackberry"></i><?php echo $this->config->get('config_blackberry') ;?></li>
              <?php } ;?>
              <?php if($this->config->get('config_lineapp')) { ;?>
                <li><i class="icon-lineapp"></i><?php echo $this->config->get('config_lineapp') ;?></li>
              <?php } ;?>
            </ul>
          </div>

          <div id="footerAddress" class="footerCol">
            <?php if($footer_column) {?>
            <?php echo $footer_column ;?>
            <?php } else { ;?>
              <h4>&nbsp;</h4>
              <ul>
                <li>
                  <?php echo $this->config->get('config_address') ;?>
                </li>
                <li><span><?php echo $this->config->get('config_email') ;?></span></li>
                <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
              </ul>
            <?php } ;?>
          </div>

        </div>
      </div>
    </div>

    <div id="footerRow-2" class="footerRow">
      <div class="container">
        <div id="socialMedia">
          <h5><?php echo $text_social_media ;?></h5>
          <ul>
            <?php if($this->config->get('config_facebook')) { ;?>
              <li><a href="http://facebook.com/<?php echo $this->config->get('config_facebook') ;?>" target="_blank"><i class="icon-facebook"></i></a></li>
            <?php } ;?>
            <?php if($this->config->get('config_twitter')) { ;?>
              <li><a href="http://twitter.com/<?php echo $this->config->get('config_twitter') ;?>" target="_blank"><i class="icon-twitter"></i></a></li>
            <?php } ;?>
            <?php if($this->config->get('config_pinterest')) { ;?>
              <li><a href="http://pinterest.com/<?php echo $this->config->get('config_pinterest') ;?>" target="_blank"><i class="icon-pinterest"></i></a></li>
            <?php } ;?>
            <?php if($this->config->get('config_googleplus')) { ;?>
              <li><a href="http://plus.google.com/<?php echo $this->config->get('config_googleplus') ;?>?rel=publisher"  rel="license" target="_blank"><i class="icon-google-plus"></i></a></li>
            <?php } ;?>
            <?php if($this->config->get('config_instagram')) { ;?>
              <li><a href="http://instagram.com/<?php echo $this->config->get('config_instagram') ;?>" target="_blank"><i class="icon-instagram"></i></a></li>
            <?php } ;?>
          </ul>
        </div>
      </div>
    </div>

    <div id="footerRow-3" class="footerRow twoCols">
      <div class="container">
        <div class="row">

          <div id="footerBanks" class="footerCol">
            <?php if($footericons_1 || $footericons_2 || $footericons_3 || $footericons_4 || $footericons_5){ ;?>
              <div id="footer--banks">
                <span>We accept:</span>
                <ul>
                  <?php if($footericons_1){ ;?>
                    <li><img height="30" width="50" src="data: image/jpeg;base64,<?php echo $footericons_1 ;?>" alt="Payment 1" /></li>
                  <?php } ;?>
                  <?php if($footericons_2){ ;?>
                    <li><img height="30" width="50" src="data: image/jpeg;base64,<?php echo $footericons_2 ;?>" alt="Payment 2" /></li>
                  <?php } ;?>
                  <?php if($footericons_3){ ;?>
                    <li><img height="30" width="50" src="data: image/jpeg;base64,<?php echo $footericons_3 ;?>" alt="Payment 3" /></li>
                  <?php } ;?>
                  <?php if($footericons_4){ ;?>
                    <li><img height="30" width="50" src="data: image/jpeg;base64,<?php echo $footericons_4 ;?>" alt="Payment 4" /></li>
                  <?php } ;?>
                  <?php if($footericons_5){ ;?>
                    <li><img height="30" width="50" src="data: image/jpeg;base64,<?php echo $footericons_5 ;?>" alt="Payment 5" /></li>
                  <?php } ;?>
                </ul>
              </div>
            <?php } ;?>
          </div>

          <div id="footerCopyright" class="footerCol">
            <?php echo $powered; ?>
          </div>

        </div>
      </div>
    </div>

  </div>


</div>

</body></html>
