<!DOCTYPE html>
<html>
    <head>
        <title><?= $heading_title ?></title>
        <link rel="stylesheet" href="admin/view/stylesheet/pos/style.css">
        <link rel="stylesheet" href="admin/view/stylesheet/pos/iconFont.css">
        <link rel="stylesheet" href="admin/view/stylesheet/pos/metro-bootstrap.css">
        <script type="text/javascript" src="admin/view/javascript/pos/jquery.min.js"></script>        
        <script type="text/javascript" src="admin/view/javascript/pos/print/printThis.js"></script>
    </head>
    <body class="metro">
        <div class="container"> 
            <div class="padding20">
                <h3><?= $heading_title ?></h3><hr>        
                <div class="message_wrapper"></div>        
                <div class="grid">
                    <div class="row">  
                        <div class="payment">
                            <?php echo $text_message; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hide">
            <?= $html ?>
        </div>
        
    </body>
</html>

<script>
    $(function() {    
       $(".order_head,.cart_table, .total_wrapper").printThis({
           debug: false, // show the iframe for debugging
           importCSS: true, // import parent page css
           printContainer: true, // print outer container/$.selector
           //loadCSS: "view/javascript/pos/print/print.css", // load an additional css file
           pageTitle: "INVOICE", // add title to print page
           removeInline: false, // remove all inline styles
           cleardata: true
       }); 
       return true;
    });
</script> 
<style>
    html, body{
        background: white;
    }
</style>