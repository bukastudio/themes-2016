<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, user-scalable=no" />
  <base href="<?php echo $base; ?>" />
  <title><?php echo $title; ?></title>
  <?php if ($description) { ?><meta name="description" content="<?php echo $description; ?>" /><?php } ?>
  <?php if ($keywords) { ?><meta name="keywords" content="<?php echo $keywords; ?>" /><?php } ?>

  <!-- /Apple, Android & Windows Icons -->
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="icon" type="image/png" href="<?php echo $icon; ?>" />
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
  <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
  <meta name="msapplication-square70x70logo" content="/smalltile.png" />
  <meta name="msapplication-square150x150logo" content="/mediumtile.png" />
  <meta name="msapplication-wide310x150logo" content="/widetile.png" />
  <meta name="msapplication-square310x310logo" content="/largetile.png" />

  <!-- /Facebook Related -->
  <meta property="og:title" content="<?php echo $title; ?>" />
  <meta property="og:type" content="website" />
  <meta property="fb:admins" content="100006533707003"/>
  <?php if ($og_descr) { ?>
  <meta property="og:description" content="<?php echo $og_descr; ?>" /><?php } else { ?><meta property="og:description" content="<?php echo $description; ?>" /><?php } ?>
  <?php if ($og_image) { ?>
  <meta property="og:image" content="<?php echo $og_image; ?>" /><?php } else { ?><meta property="og:image" content="<?php echo $logo; ?>" />
  <?php } ?>
  <?php $pageURL = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];;?>
  <meta property="og:url" content="<?php echo $pageURL; ?>" />

  <!-- /Google Plus -->
  <?php if ($this->config->get('config_googleplus')) { ?><link href="https://plus.google.com/<?php echo html_entity_decode($this->config->get('config_googleplus'), ENT_QUOTES, 'UTF-8') ;?>" rel="author" /><?php } ;?>

  <!-- /Google Web Fonts -->
  <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/> -->

  <!-- /Stylesheets -->
  <?php foreach ($links as $link) { ?><link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" /><?php } ?>
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $base; ?>catalog/view/theme/default/stylesheet/bukatoko.css" />
  <?php foreach ($styles as $style) { ?><link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" /><?php } ?>

  <!-- /Additional Styles -->
  <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />

  <!-- /Main Script -->
  <script type="text/javascript" src="catalog/view/theme/default/js/bukatoko-min.js"></script>

  <?php foreach ($scripts as $script) { ?>
    <script type="text/javascript" src="<?php echo $script; ?>"></script>
  <?php } ?>

  <?php if ($stores) { ?><script type="text/javascript"><!--$(document).ready(function() {<?php foreach ($stores as $store) { ?>$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');<?php } ?>});//--></script><?php } ?>

  <!-- /Google Analytic -->
  <?php if ($google_analytics) { ?><?php echo $google_analytics; ?><?php } ;?>

  <!-- /Zopim -->
  <?php if($this->config->get('config_zopim')) { ;?>
    <?php echo html_entity_decode($this->config->get('config_zopim'), ENT_QUOTES, 'UTF-8') ;?>
  <?php } ;?>

</head>

<body>

  <div id="notification"></div>

  <!-- /MOBILE HEADER -->
  <div class="mobileHeaderSlot">

    <div class="mobileHeaderRow">
        <div class="wrapper">

          <div id="mobileStoreLogo" class="left">
            <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
          </div>

          <div id="mobileMenu" class="right">
            <ul>
              <li id="mobileMenu_home"><a href="/">&#9776;</a></li>
              <li id="mobileMenu_search"><a href="/"><i class="icon-search"></i></a></li>
              <li id="mobileMenu_login"><a href="<?php echo $account; ?>"><i class="icon-user"></i></a></li>
              <li id="mobileMenu_cart"><a href="/"><i class="icon-basket""></i></a></li>
            </ul>
          </div>

        </div>

    </div>
  </div>

  <div class="container">
    <div class="headerSlot">

      <!-- Row-1 -->
      <div id="headerRow-1" class="headerRow twoCols equal">
        <div class="row">

          <div class="headerCol left">
            <div id="contactInfo">
              <span><?php echo $text_need_help ;?></span>
              <?php if($this->config->get('config_telephone')) { ;?>
                <div><i class="icon-mobile"></i><?php echo $this->config->get('config_telephone') ;?></div>
              <?php } ;?>
              <?php if($this->config->get('config_whatsapp')) { ;?>
                <div><i class="icon-whatsapp"></i><?php echo $this->config->get('config_whatsapp') ;?></div>
              <?php } ;?>
              <?php if($this->config->get('config_blackberry')) { ;?>
                <div><i class="icon-blackberry"></i><?php echo $this->config->get('config_blackberry') ;?></div>
              <?php } ;?>
              <?php if($this->config->get('config_lineapp')) { ;?>
                <div><i class="icon-lineapp"></i><?php echo $this->config->get('config_lineapp') ;?></div>
              <?php } ;?>
            </div>
          </div>

          <div class="headerCol right">
            <div id="topMenu">
              <ul>
                <?php if (!$logged) { ?>
                  <li><?php echo $text_welcome; ?></li>
                <?php } else { ?>
                  <li><?php echo $text_logged; ?></li>
                  <li>
                    <a href="<?php echo $account; ?>"><?php echo $text_account; ?></a>
                  </li>
                <?php } ?>
                <li>
                  <a href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
                </li>
              </ul>
            </div>
            <div id="localInfo">
              <?php echo $currency; ?>
              <?php echo $language; ?>
            </div>
          </div>

        </div>
      </div>

      <!-- Row-2 -->
      <div id="headerRow-2" class="headerRow table">
        <div class="row">

          <!-- Left -->
          <div class="headerCol left">
            <div id="search">
              <div class="wrapper">
                <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
                <div class="button-search button"><i class="icon-search"></i></div>
              </div>
            </div>
          </div>

          <!-- Center -->
          <div class="headerCol center">
            <div id="storeLogo">
              <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
            </div>
          </div>

          <!-- Right -->
          <div class="headerCol right">
              <?php echo $cart; ?>
          </div>

        </div>
      </div>

      <!-- Row-3 -->
      <div id="headerRow-3" class="headerRow">
        <div id="mainMenu">
          <ul>
            <?php if($display_home == 1) {;?>
              <li id="menu-home"><a href="<?php echo $home; ?>"><span><?php echo $text_home ;?></span></a></li>
            <?php } ;?>
            <?php if($display_new_arrivals == 1) {;?>
              <li id="menu-new-arrivals"><a href="<?php echo $new_arrivals; ?>"><span><?php echo $text_new_arrivals; ?></span></a></li>
            <?php } ;?>
            <?php if($display_shop_by_brand == 1) {;?>
              <li id="menu-shop-by-brand"><a href="<?php echo $shop_by_brand; ?>"><span><?php echo $text_shop_by_brand; ?></span></a></li>
            <?php } ;?>

            <?php if ($categories) { ?>
              <?php foreach ($categories as $category) { ?>
                <li <?php if ($category['children']) { echo "class='has-children'"; }?>><a href="<?php echo $category['href']; ?>"><span><?php echo $category['name']; ?></a>
                  <?php if ($category['children']) { ?>

                    <!-- /Second Level -->
                    <div class="level-2 column-<?php echo $category['column'] ;?>">
                      <?php for ($i = 0; $i < count($category['children']);) { ?>
                        <ul>
                          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
                          <?php for (; $i < $j; $i++) { ?>
                            <?php if (isset($category['children'][$i])) { ?>
                              <li><a href="<?php echo $category['children'][$i]['href']; ?>" class="<?php if ($category['children'][$i]['children']) echo 'has-children'; ?>"><?php echo $category['children'][$i]['name']; ?></a>
                                <?php if ($category['children'][$i]['children']) { ?>

                                  <!-- /Third Level -->
                                  <div class="level-3">
                                    <?php $per_col = ceil(count($category['children'][$i]['children']) / $category['children'][$i]['column']); ?>
                                    <?php for ($m = 0, $index = 0; $m < $category['children'][$i]['column']; $m++) { ?>
                                      <ul>
                                        <?php for ($k = 0; $k < $per_col && isset($category['children'][$i]['children'][$index]); $k++, $index++) { ?>
                                          <li><a href="<?php echo $category['children'][$i]['children'][$index]['href']; ?>"><?php echo $category['children'][$i]['children'][$index]['name']; ?></a></li>
                                        <?php } ?>
                                      </ul>
                                    <?php } ?>
                                  </div>

                                <?php } ?>
                              </li>
                            <?php } ?>
                          <?php } ?>
                        </ul>
                      <?php } ?>
                    </div>

                  <?php } ?>

                </li>
              <?php } ?>
            <?php } ?>

            <?php if($display_special == 1) {;?>
              <li id="menu-sale"><a href="<?php echo $sale; ?>"><span><?php echo $text_sale; ?></span></a></li>
            <?php } ;?>
            <?php if($display_blog == 1) {;?>
              <li id="menu-blog"><a href="<?php echo $blog; ?>"><span><?php echo $text_blog; ?></span></a></li>
            <?php } ;?>

            <!-- <li id="last-menu"><span>&nbsp;</span></li> -->

          </ul>
        </div>

      </div>

    </div>
  </div>
