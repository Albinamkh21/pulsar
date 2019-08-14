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
<div class="pages-catalog-product">
    <div class="container">
        <?php echo $column_right; ?>
        <div class="pages-catalog__left">
            
                <div class="product">
                    <div class="product-left">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                        <div class="product-group"><?php echo $name; ?></div>
                        <div class="product-name"><?php echo $model; ?></div>
                        <div class="product-info-title">Дополнительные характеристики</div>
                        <div class="product-info">
                            <div class="product-info-row"><span class="product-code">Артикул:</span><span class="product-code-v"><?php echo $sku; ?></span></div>
                            <div class="product-info-row"><span class="product-year">Год закладки:</span><span class="product-year-v"><?php echo $year; ?></span></div>
                            <div class="product-info-row"><span class="product-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-gost-v"><?php echo $gost; ?></span></div>
                        </div>
                    </div>
                    <div class="product-right">
                        <div class="product-right-text">
                            <div class="product-anable"> <?php echo $stock; ?></div>
                            <div class="product-price"><?php if($price > 0 ) {echo $price; } else { echo "Цена по запросу"; } ?> </div>
                            <div class="product-basket">
                                <div class="basket-unit"><?php echo $units; ?></div>
                                <div class="basket-counts">
                                    <a href="#" onclick="minusNumber('<?=$product_id;?>')"><span class="basket-minus">-</span></a>
                                    <span class="basket-number"><input name="product_quantity" id="product_quantity_<?= $product_id;?>" value="1"></span>
                                    <a href="#" onclick="plusNumber('<?=$product_id;?>')"><span class="basket-plus">+</span></a>
                                </div>

                            </div>
                        </div>
                       <!-- <div class="product-basket-order button_orange button_orange_wd">Оставить заявку</div>-->
                        <div class="product-basket-add button_orange button_orange_wd">
                        <a class="product-basket-add__link"  href="#" onclick="add('<?=$product_id ?>');">
                            Добавить в корзину
                            <svg class="product-basket-add__icon">
                                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#basket-white"></use>
                            </svg>
                        </a>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>
<script>
    function minusNumber(product_id) {
        num = $('#product_quantity_'+product_id).val();
        if(num>0)
            $('#product_quantity_'+product_id).val(num-1)


    }
    function plusNumber(product_id) {
        num = $('#product_quantity_'+product_id).val();
        $('#product_quantity_'+product_id).val(parseInt(num)+1)
    }
    function add(product_id) {
        num = $('#product_quantity_'+product_id).val();
        cart.add(product_id, num)


    }
</script>


<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=e410b4c7-5818-428f-ae3c-8b660074d81d" type="text/javascript"></script>
<?php echo $footer; ?>
</body>
</html>