<div class="grid">
    <div class="row">
        <div class="span3">
            <div class="image">
            <?php if ($thumb) { ?>
                <img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" />            
            <?php }else{ ?>
                <img src="image/no_image.jpg" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" />            
            <?php } ?>
            </div>
        </div>
        <div class="span4">

            <div class="product_title">                
                <h3><?php echo $heading_title; ?></h3>
            </div>

            <?php if ($price) { ?>
            <div class="price"><?php echo $text_price; ?>
                <?php if (!$special) { ?>
                    <?php echo $price; ?>
                <?php } else { ?>
                    <span class="price-old"><?php echo $price; ?></span>
                    <span class="price-new"><?php echo $special; ?></span>
                <?php } ?>
                <br />
                <?php if ($tax) { ?>
                    <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
                <?php } ?>
            </div>
            <?php } ?>
            
            
            <div class="description">
                <?php if ($description) { ?>
                <p><?php echo $description; ?></p> 
                <?php } ?>
                <span><?php echo $text_model; ?></span> <?php echo $model; ?><br />
                <span><?php echo $text_stock; ?></span> <?php echo $stock; ?>
            </div>

        </div><!-- END .span7 -->
    </div><!-- END row -->
</div><!-- END grid -->