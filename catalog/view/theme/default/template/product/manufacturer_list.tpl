<?php echo $header; ?>

<?php if($column_left) {$slotclass = "sidebarRight";} else {$slotclass = "sidebarNone";};?>

<div id="manufacturerPage" class="contentSlot">
  <div class="container">

    <div id="contentRow-1" class="contentRow">
        <div id="breadCrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?><?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php } ?>
        </div>
    </div>

    <div class="contentRow">
      <?php echo $content_top ;?>
    </div>

    <div class="contentRow <?php echo $slotclass ;?>">
      <div class="row">

        <div class="columnCenter">

          <div class="categoryHeader">
            <h1><?php echo $heading_title; ?></h1>
          </div>

          <?php if (!$categories) { ?>
            <br><br><?php echo $text_empty; ?><br><br><br><br>
          <?php } ?>

          <?php if ($categories) { ?>
            <div id="manufacturerList">

              <div class="row">
                <?php foreach ($categories as $category) { ?>
                  <?php if ($category['manufacturer']) { ?>
                    <?php for ($i = 0; $i < count($category['manufacturer']);) { ?>
                      <?php $j = $i + ceil(count($category['manufacturer'])); ?>
                      <?php for (; $i < $j; $i++) { ?>
                        <?php if (isset($category['manufacturer'][$i])) { ?>
                          <div>
                            <a href="<?php echo $category['manufacturer'][$i]['href']; ?>">
                              <img src="<?php echo $category['manufacturer'][$i]['image']; ?>" alt="<?php echo $category['manufacturer'][$i]['name']; ?>">
                              <span><?php echo $category['manufacturer'][$i]['name']; ?></span>
                            </a>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              </div>

            </div>
          <?php } ?>
        </div>

        <div class="columnRight sideBar">
          <?php echo $column_left ;?>
        </div>

      </div>

    </div>
  </div>
</div>

<?php echo $footer; ?>
