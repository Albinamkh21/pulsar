<?php  if($cart_count>0) { ?>
   <span  class="make-order-label__link"> <a href="<?php echo $cart; ?>"> <span class="make-order-label make-order-label_active">Оформить заказ</span> </a> </span>
<?php } else { ?>
<span  class="make-order-label__link">  <a href="<?php echo $catalog; ?>" ><span class="make-order-label">Сформируйте новый заказ</span> </a> </span>
<?php }  ?>

<a href="<?php echo $cart; ?>">
          <span class="">
          <svg class="basket">
            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#basket"></use>
          </svg>
          <span class="basket-count" id="basket-count"><?=$cart_count;?></span>
          </span>
</a>