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
    <div class="pages-catalog-list">
        <div class="container">
            <?php echo $column_right; ?>
            <div class="pages-catalog__left">
                <div class="product-filter">
                    <div class="product-filter__available">
                        <label class="checkbox_container" for="inStore">В наличии
                            <?php $cur_sort = "Без сортировки"; foreach ($sorts as $srts) { ?>
                            <?php if($srts['value'] == $sort . '-' . $order)  $cur_sort = $srts['text']; }?>

                            <input class="contact-form_times" id="inStore" type="checkbox" name="inStore" onclick="filterDataInStore()" <?=$instore?> >
                            <div class="checkmark__outer">
                                <div class="checkmark"></div>
                            </div>
                        </label>
                    </div>
                    <div class="product-sort">
                        <div class="product-sort-wrap"><a class="product-sort__link"><?=$cur_sort ?>
                                <svg class="arrow-down__icon2">
                                    <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                                </svg></a>
                        </div>
                        <ul class="product-sort__items">

                            <?php foreach($sorts as $sorts) { ?>
                                 <a href="<?=$sorts['href']; ?>"><li class="product-sort__item"> <?php echo $sorts['text']; ?> </li></a>
                            <?php } ?>
                        </ul>
                    </div>


                </div>
                <?php if ($products) { ?>
                <ul class="product-list__items">
                    <?php foreach ($products as $product) { ?>
                        <li class="product-list__item" id = "'<?php echo $product["product_id"];?>'" >
                            <a class="product-list__item-link" href="<?php echo $product['href']; ?>">
                                <div class="product-list__item-left">
                                    <div class="product-list__item-group"><?php echo $product['name']; ?></div>
                                    <div class="product-list__item-name"><?php echo $product['model']; ?></div>
                                    <div class="product-list__item-info-title">Дополнительные характеристики</div>
                                    <div class="product-list__item-info"><span class="product-list__item-code">
                                            Артикул:</span><span class="product-list__item-code-v"><?php echo $product['sku']; ?></span>
                                            <span class="product-list__item-year">Год закладки:</span><span class="product-list__item-year-v"><?php echo $product['year']; ?></span>
                                            <span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
                                </div>
                            </a>
                                <div class="product-list__item-right">
                                    <div class="product-list__item-anable"><?php echo $product['stock_status']; ?></div>
                                    <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?> </div>
                                    <div class="product-list__item-basket">
                                        <div class="basket-unit"><?php echo $product['units']; ?></div>
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

                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>

<!--
                <div class="product-list__navigator navigator">
                    <svg class="arrow-left1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>
                    <div class="navigator__result">Найдено <?php echo $products_count;?></php> </div>
                    <svg class="arrow-right1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>
                </div>

  -->                       <?php echo $pagination; ?>



            </div>
        </div>
    </div>
</div>
<input type =hidden  id="filter_clear" value = "<?=$filter_clear;?>" />
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
    function filterDataInStore() {
       let el = document.getElementById("inStore");
       var isStore = 0, sep= "?";
        if(el.checked) {
            isStore=1
        }
        if(window.location.search) {sep = "&" }

        console.log(window.location);
        location = window.location.href+sep+"instore="+isStore;


    }

</script>

<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=e410b4c7-5818-428f-ae3c-8b660074d81d" type="text/javascript"></script>
<?php echo $footer; ?>
</body>
</html>