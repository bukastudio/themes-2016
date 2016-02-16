
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});

//load next page
$('.product_pager button').click(function(){
    $q = $(this).attr('data-q');
    $category_id = $(this).attr('data-category-id');
    $is_search = $(this).attr('data-is-search');
    $page = $(this).attr('data-page');

    if($is_search == 'true'){
        search($q,$page);
    }else{
        getItems($category_id,$page);
    }
});

function search($q, $page){
    var html = '';

    //get category list
    $.post('index.php?route=pos/pos/searchProducts&token='+token+'',{ q: $q, page: $page }, function(data){

        var data = JSON.parse(data);

        for(var i = 0; i < data.products.length; i++){
           html += '<div data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[i]['hasOptions']+'"  class="product">';
           html += '<a data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[i]['hasOptions']+'" class="btn_cart"><div class="tile" data-title="'+data.products[i]['name']+'" data-price="'+data.products[i]['price_text']+'">';
           html += '<div class="tile-content image">';
           html += '<img src="'+data.products[i]['image']+'">';
           html += '</div><div class="brand"><span class="text">';
           html += data.products[i]['name'];
           html += '</span></div>';//END Brand
           html += '</div></a>';//END tile

           //html += '<div class="btn-group tile-content">';
           //html += '<a href="index.php?route=pos/pos/product&product_id='+data.products[i]['id']+'//&token='+token+'" class="btn btn_info fancybox.ajax">';
           //html += '<i class="icon-info"></i>';
           //html += '&nbsp;Info';
           //html += '</a>';
           //html += '<a data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[//i]['hasOptions']+'" class="btn btn_cart" btn-success">';
           //html += '<i class="icon-cart"></i>';
           //html += '&nbsp;Cart';
           //html += '</a>';
           //html += '</div>'; //END tile-content

           html += '</div>';
        }

        $page++;

        if(data['has_more']){
            //set attribute
            $button = $('.product_pager button');
            $button.attr('data-q',$q);
            $button.attr('data-category-id','');
            $button.attr('data-is-search',true);
            $button.attr('data-page',$page);
            $('.product_pager').removeClass('hide');
        }else{
            $('.product_pager').addClass('hide');
        }

        //check is start page
        if($page == 2){
            $('.product_list .overview').html(html);
            oScrollbar1.tinyscrollbar_update('top');
        }else{
            $('.product_list .overview').append(html);
            oScrollbar1.tinyscrollbar_update('bottom');
        }

    });
}

//list category products
$('.top_category_list li, .product_list .category').live('click',function(){
    getItems($(this).attr('data-category-id'),1);
});

$( "#barcode" ).on( "keydown", function(event) {
  if(event.which == 13 && $(this).val().length > 0) {
     $.post('index.php?route=pos/pos/getProductByBarcode&token='+token+'',{ barcode: $(this).val() }, function(data){

        var data = JSON.parse(data);

        $('.product-info .product_id').val(data.product_id);

        if(data.has_option==1){
            $('.product_list_bottom').removeClass('hide');
            get_option(data.product_id);
        }else{
            $('.product_list_bottom').addClass('hide');
            addToCart();
        }

        $("#barcode").val('');
    });
  }
});

$( "#q" ).on( "keydown", function(event) {
  if(event.which == 13)
    search($(this).val(),1);
});

$('.btn-search').click(function(){
    search($('#q').val(),1);
});

function getItems($id, $page){

    var html = '';

    //get category list
    $.post('index.php?route=pos/pos/getCategoryItems&token='+token+'',{ category_id: $id, page: $page }, function(data){

        var data = JSON.parse(data);

        for(var i = 0; i < data.categories.length; i++){
           html += '<div data-category-id="'+data.categories[i]['id']+'" class="category"><div class="tile"><div class="tile-content image">';
           html += '<img src="'+data.categories[i]['image']+'">';
           html += '</div><div class="brand"><span class="text">';
           html += data.categories[i]['name'];
           html += '</span></div></div></div>';
        }

        for(var i = 0; i < data.products.length; i++){
           html += '<div data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[i]['hasOptions']+'"  class="product">';
           html += '<a data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[i]['hasOptions']+'" class="btn_cart"><div class="tile" data-title="'+data.products[i]['name']+'" data-price="'+data.products[i]['price_text']+'">';
           html += '<div class="tile-content image">';
           html += '<img src="'+data.products[i]['image']+'">';
           html += '</div><div class="brand"><span class="text">';
           html += data.products[i]['name'];
           html += '</span></div>';//END Brand
           html += '</div></a>';//END tile

           //html += '<div class="btn-group tile-content">';
           //html += '<a href="index.php?route=pos/pos/product&product_id='+data.products[i]['id']+'//&token='+token+'" class="btn btn_info fancybox.ajax">';
           //html += '<i class="icon-info"></i>';
           //html += '&nbsp;Info';
           //html += '</a>';
           //html += '<a data-product-id="'+data.products[i]['id']+'"  data-has-option="'+data.products[//i]['hasOptions']+'" class="btn btn_cart" btn-success">';
           //html += '<i class="icon-cart"></i>';
           //html += '&nbsp;Cart';
           //html += '</a>';
           //html += '</div>'; //END tile-content

           html += '</div>';//END .product
        }

        $page++;

        if(data['has_more']){
            //set attribute
            $button = $('.product_pager button');
            $button.attr('data-q','');
            $button.attr('data-category-id',$id);
            $button.attr('data-is-search',false);
            $button.attr('data-page',$page);
            $('.product_pager').removeClass('hide');
        }else{
            $('.product_pager').addClass('hide');
        }

        //check is start page
        if($page == 2){
            $('.product_list .overview').html(html);
            oScrollbar1.tinyscrollbar_update('top');
        }else{
            $('.product_list .overview').append(html);
            oScrollbar1.tinyscrollbar_update('bottom');
        }
    });
}

function filter($page) {
	url = 'index.php?route=pos/pos/ordersAJAX&token='+token+'';

	var filter_order_id = $('input[name=\'filter_order_id\']').attr('value');

	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}

	var filter_customer = $('input[name=\'filter_customer\']').attr('value');

	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}

	var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');

	if (filter_order_status_id != '*') {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}

	var filter_total = $('input[name=\'filter_total\']').attr('value');

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}

	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');

	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

	var filter_date_modified = $('input[name=\'filter_date_modified\']').attr('value');

	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}

	get_orders(url);
}
