
function print_link() {
      $(".order_head,.cart_table, .total_wrapper, .thanks").printThis({
       debug: false, // show the iframe for debugging
       importCSS: true, // import parent page css
       printContainer: true, // print outer container/$.selector
       //loadCSS: "view/javascript/pos/print/print.css", // load an additional css file
       pageTitle: "INVOICE", // add title to print page
       removeInline: false, // remove all inline styles
       cleardata: false
   });
}

function print() {
   $(".order_head,.cart_table, .total_wrapper, .thanks").printThis({
       debug: false, // show the iframe for debugging
       importCSS: true, // import parent page css
       printContainer: true, // print outer container/$.selector
       //loadCSS: "view/javascript/pos/print/print.css", // load an additional css file
       pageTitle: "INVOICE", // add title to print page
       removeInline: false, // remove all inline styles
       cleardata: true
   });
   return true;
}

