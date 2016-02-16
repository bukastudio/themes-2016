
var oScrollbar1, oScrollbar2 = null;

//$(".scrollbar_wrapper").tinyscrollbar();
//oScrollbar1.tinyscrollbar_update();

$(document).ready(function(){

 oScrollbar1 = $("#scrollbar1");
 oScrollbar1.tinyscrollbar();

 oScrollbar2 = $("#scrollbar2");
 oScrollbar2.tinyscrollbar();

  $('.top_category_list').bxSlider({
      mode: 'horizontal',
      minSlides: 6,
      infiniteLoop: false,
      pager: false,
  });
});


