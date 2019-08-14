<?php echo $header; ?>
<div class="pages__title">
  <div class="container">
    <div class="title"><?php echo $heading_title; ?> </div>
    <ul class="breadcrumbs">
      <?php $i=1; foreach ($breadcrumbs as $breadcrumb) { ?>
      <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
      <?php if( $i < count($breadcrumbs)) { echo " - "; }  $i++; ?>
      <?php } ?>
    </ul>
  </div>
</div>
<div class="pages-basket">
  <div class="container">

    <?php echo $column_right; ?>
    <div class="pages-catalog__left">
       <div class="news_list__item-title"><?php echo $heading_title; ?></div>
       <div class="news_list__item-desc"><?php echo $text_message; ?> </div>
       <div class="buttons">
           <a href="<?php echo $continue; ?>" class="button_orange"><?php echo $button_continue; ?></a>
        </div>

    </div>
</div>
</div>
</div>
<?php echo $footer; ?>