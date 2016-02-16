//@codekit-prepend "Javascripts/jquery-1.7.1.min.js";
//@codekit-prepend "Javascripts/jquery-ui-1.8.16.custom.min.js";
//@codekit-prepend "Javascripts/jquery-ui-timepicker-addon.js";
//@codekit-prepend "Javascripts/jquery.total-storage.min.js";
//@codekit-prepend "Javascripts/jquery.cycle.js";
//@codekit-prepend "Javascripts/jquery.flexslider-min.js";
//@codekit-prepend "Javascripts/slick.min.js";
//@codekit-prepend "Javascripts/jquery.placeholder.min.js";
//@codekit-prepend "Javascripts/jquery.colorbox-min.js";
//@codekit-prepend "Javascripts/tabs.js";


 $(document).click(function(e) {

     // check that your clicked
     // element has no id=info
     // and is not child of info
     if (e.target.id != 'search' && !$('#search').find(e.target).length) {
         $("#search").removeClass('active');
     }
     if (e.target.id != 'cart' && !$('#cart').find(e.target).length) {
         $("#cart").removeClass('active');
     }
 });


$(document).ready(function() {

  /* Top Menu */
  $('#top-menu li#search-menu').bind('click', function() {
    $(this).removeClass('active');
    $('#search').addClass('active');
    $('#mobileMenu li').removeClass('active');
    $('#mobileMenu li#mobileMenu_search').addClass('active');
    return false;
  });


  /* Mobile menu */
  $('#mobileMenu li#mobileMenu_home').bind('click', function() {
    $(this).siblings().removeClass('active');
    $(this).toggleClass('active');
    $('#mainMenu').toggleClass('active');
    $('#localInfo').removeClass('active');
    $('#search').removeClass('active');
    $('#cart').removeClass('active');
    return false;
  });
  $('#mobileMenu li#mobileMenu_local').bind('click', function() {
    $(this).siblings().removeClass('active');
    $(this).toggleClass('active');
    $('#localInfo').toggleClass('active');
    $('#mainMenu').removeClass('active');
    $('#search').removeClass('active');
    $('#cart').removeClass('active');
    return false;
  });
  $('#mobileMenu li#mobileMenu_search').bind('click', function() {
    $(this).siblings().removeClass('active');
    $(this).toggleClass('active');
    $('#search').toggleClass('active');
    $('#localInfo').removeClass('active');
    $('#mainMenu').removeClass('active');
    $('#cart').removeClass('active');
    return false;
  });
  $('#mobileMenu li#mobileMenu_cart').bind('click', function() {
    $('#cart').load('index.php?route=module/cart #cart > *');
    $(this).siblings().removeClass('active');
    $(this).toggleClass('active');
    $('#cart').toggleClass('active');
    $('#search').removeClass('active');
    $('#localInfo').removeClass('active');
    $('#mainMenu').removeClass('active');
    return false;
  });


  /* Main Menu */
  $('#mainMenu > ul > li').bind('mouseover', function() {
    $(this).addClass('active');
    $(this).prev().addClass('hide-divider');
  });
  $('#mainMenu > ul > li').bind('mouseout', function() {
    $(this).removeClass('active');
    $(this).prev().removeClass('hide-divider');
  });

  $('.module--banner div:first-child').css('display', 'block');
  var banner = function() {
    $('.module--banner').cycle({
      before: function(current, next) {
        $(next).parent().height($(next).outerHeight());
      }
    });
  }
  setTimeout(banner, 2000);

  $('.carousel').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 7,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,

      responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 6
          }
        },
        {
          breakpoint: 979,
          settings: {
            slidesToShow: 5
          }
        },
        {
          breakpoint: 739,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    });

  $('.flexslider').flexslider({
    animation: "slide",
    easing: "swing",
    direction: "horizontal",
    pauseOnHover: true,
  });


  $('#mobileMenu span').bind('click', function() {
    $("#mainMenu").slideToggle();
  });

  /* Search */
  $('.button-search').bind('click', function() {
    url = $('base').attr('href') + 'index.php?route=product/search';

    var search = $('input[name=\'search\']').attr('value');

    if (search) {
      url += '&search=' + encodeURIComponent(search);
    }

    location = url;
  });

  $('#header input[name=\'search\']').bind('keydown', function(e) {
    if (e.keyCode == 13) {
      url = $('base').attr('href') + 'index.php?route=product/search';

      var search = $('input[name=\'search\']').attr('value');

      if (search) {
        url += '&search=' + encodeURIComponent(search);
      }

      location = url;
    }
  });

  /* Ajax Cart */
  $('#cart > .heading a').live('click', function() {
    $('#cart').toggleClass('active');
    //$('#cart').load('index.php?route=module/cart #cart > *');
    //$('#cart .content').slideToggle();

    $('#cart').load('index.php?route=module/cart #cart > *');

    //$('#cart').live('mouseleave', function() {
    //  $(this).removeClass('active');
    //});
  });

  /* Mega Menu */
  $('#menu ul > li > a + div').each(function(index, element) {
    // IE6 & IE7 Fixes
    if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
      var category = $(element).find('a');
      var columns = $(element).find('ul').length;

      $(element).css('width', (columns * 143) + 'px');
      $(element).find('ul').css('float', 'left');
    }

    var menu = $('#menu').offset();
    var dropdown = $(this).parent().offset();

    i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

    if (i > 0) {
      $(this).css('margin-left', '-' + (i + 5) + 'px');
    }
  });

  // IE6 & IE7 Fixes
  if ($.browser.msie) {
    if ($.browser.version <= 6) {
      $('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');

      $('#column-right + #content').css('margin-right', '195px');

      $('.box-category ul li a.active + ul').css('display', 'block');
    }

    if ($.browser.version <= 7) {
      $('#menu > ul > li').bind('mouseover', function() {
        $(this).addClass('active');
      });

      $('#menu > ul > li').bind('mouseout', function() {
        $(this).removeClass('active');
      });
    }
  }

  $('.success i, .warning i, .attention i, .information i').live('click', function() {
    $(this).parent().fadeOut('slow', function() {
      $(this).remove();
    });
  });
});

function getURLVar(key) {
  var value = [];

  var query = String(document.location).split('?');

  if (query[1]) {
    var part = query[1].split('&');

    for (i = 0; i < part.length; i++) {
      var data = part[i].split('=');

      if (data[0] && data[1]) {
        value[data[0]] = data[1];
      }
    }

    if (value[key]) {
      return value[key];
    } else {
      return '';
    }
  }
}

function addToCart(product_id, quantity) {
  quantity = typeof(quantity) != 'undefined' ? quantity : 1;

  $.ajax({
    url: 'index.php?route=checkout/cart/add',
    type: 'post',
    data: 'product_id=' + product_id + '&quantity=' + quantity,
    dataType: 'json',
    success: function(json) {
      $('.success, .warning, .attention, .information, .error').remove();

      if (json['redirect']) {
        location = json['redirect'];
      }

      if (json['success']) {
        $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<i class="icon-close-remove-exit close"></i></div>');

        $('.success').fadeIn('slow');

        $('#cart-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    }
  });
}
function addToWishList(product_id) {
  $.ajax({
    url: 'index.php?route=account/wishlist/add',
    type: 'post',
    data: 'product_id=' + product_id,
    dataType: 'json',
    success: function(json) {
      $('.success, .warning, .attention, .information').remove();

      if (json['success']) {
        $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<i class="icon-close-remove-exit close"></i></div>');

        $('.success').fadeIn('slow');

        $('#wishlist-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    }
  });
}

function addToCompare(product_id) {
  $.ajax({
    url: 'index.php?route=product/compare/add',
    type: 'post',
    data: 'product_id=' + product_id,
    dataType: 'json',
    success: function(json) {
      $('.success, .warning, .attention, .information').remove();

      if (json['success']) {
        $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<i class="icon-close-remove-exit close"></i></div>');

        $('.success').fadeIn('slow');

        $('#compare-total').html(json['total']);

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }
    }
  });
}
