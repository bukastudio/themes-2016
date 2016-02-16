<!DOCTYPE html>
<html>
    <head>
        <title>POS</title>
        <link rel="stylesheet" href="admin/view/stylesheet/pos/style.css">
        <link rel="stylesheet" href="admin/view/stylesheet/pos/iconFont.css">
        <link rel="stylesheet" href="admin/view/stylesheet/pos/metro-bootstrap.css">
        <script type="text/javascript" src="admin/view/javascript/pos/jquery.min.js"></script>
    </head>
    <body class="metro">
        <div class="container"> 
            <div class="padding20">
                <h3>Make payment</h3><hr>        
                <div class="message_wrapper"></div>        
                <div class="grid">
                    <div class="row">  
                        <div class="payment">
                            <?php echo $payment; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<style>
    html, body{
        background: white;
    }
</style>