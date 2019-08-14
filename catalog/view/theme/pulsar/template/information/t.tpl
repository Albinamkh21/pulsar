@media screen and (max-width: 425px) {


<?php if ($products) { ?>
<ul class="product-list__items-mob">
    <?php foreach ($products as $product) { ?>
    <li class="product-list__item"><a class="product-list__item-link" href="<?php echo $product['href']; ?>">
            <div class="product-list__item-group"><?php echo $product['name']; ?></div>
            <div class="product-list__item-name"><?php echo $product['model']; ?></div>
            <div class="product-list__item-info-title">Дополнительные характеристики</div>
        </a>
        <div class="product-list__item-info">
            <div class="product-list__item-left">
                <div class="product-list__item-info__row"><span class="product-list__item-code">Артикул:</span><span class="product-list__item-code-v"><?php echo $product['sku']; ?></span></div>
                <div class="product-list__item-info__row"><span class="product-list__item-year">Год закладки:</span><span class="product-list__item-year-v"><?php echo $product['year']; ?></span></div>
                <div class="product-list__item-info__row"><span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
            </div>
            <div class="product-list__item-right">
                <div class="product-list__item-anable"><?php echo $product['stock_status']; ?></div>
                <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?> </div>
                <div class="basket-unit"><?php echo $product['units']; ?></div>
                <div class="product-list__item-basket">
                    <div class="basket-counts">
                        <a href="#" onclick="minusNumber('<?php echo $product["product_id"];?>')"><span class="basket-minus">-</span></a>
                        <span class="basket-number"><input name="product_quantity" id="product_quantity_<?=$product['product_id'];?>" value="1"></span>
                        <a href="#" onclick="plusNumber('<?php echo $product["product_id"];?>')"><span class="basket-plus">+</span></a>
                    </div>
                    <a  href="#" onclick="add('<?php echo $product["product_id"];?>');">
                    <div class="basket-icon-wrapp">
                        <svg class="basket-icon22">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#basket-white"></use>
                        </svg>
                    </div>
                    </a>

                </div>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
<?php } ?>



<ul class="basket-list__items-mob">
    <?php foreach ($products as $product) { ?>
    <li class="product-list__item"><a class="product-list__item-link" href="<?php echo $product['href']; ?>">
            <div class="product-list__item-left">
                <div class="product-list__item-group"><?php echo $product['name']; ?></div>
                <div class="product-list__item-name"><?php echo $product['model']; ?></div>
                <div class="product-list__item-info-title">Дополнительные характеристики</div>
                <div class="product-list__item-info">
                    <div class="product-list__item-info__row"><span class="product-list__item-code">Артикул:</span><span class="product-list__item-code-v"><?php echo $product['sku']; ?></span></div>
                    <div class="product-list__item-info__row"><span class="product-list__item-year">Год закладки:</span><span class="product-list__item-year-v"><?php echo $product['year']; ?></span></div>
                    <div class="product-list__item-info__row"><span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
                </div>
            </div>
            <div class="product-list__item-right">
                <div class="basket-wrap">
                    <div class="basket-unit"><?php echo $product['units']; ?></div>
                    <div class="basket-counts">
                        <a href="#" onclick="minusNumber('<?php echo $product["cart_id"];?>')"><span class="basket-minus">-</span></a>
        <span class="basket-number">
                                            <input id="quantity_<?=$product['cart_id']; ?>" value="<?=$product['quantity'];?>"
                                                   type="text" name="quantity[<?php echo $product['cart_id']; ?>]" size="1">
                                             </span>
        <a href="#" onclick="plusNumber('<?php echo $product["cart_id"];?>')"><span class="basket-plus">+</span></a>

        </div>
        <button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary">
            <svg class="basket-update-icon">
                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#update"></use>
            </svg>
        </button>


        </div>
        <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?></div>
        </div>

        <a class="basket-item__close" href="#" onclick="cart.remove('<?php echo $product['cart_id']; ?>');">
            <svg class="basket-close-icon">
                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#close"></use>
            </svg>
        </a>
        </a>
    </li>
    <?php } ?>
</ul>