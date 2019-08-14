<?php echo $header; ?>
<div class="pages__title">
    <div class="container">
        <div class="title">  <?php echo $heading_title; ?> </div>
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
        <?php if(isset($products)) { ?>
                <div class="basket-list">
                <div class="basket__title">Оформить заказ</div>
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <ul class="basket-list__items">
                        <?php foreach ($products as $product) { ?>
                        <li class="product-list__item">
                            <a class="product-list__item-link" href="<?php echo $product['href']; ?>">
                                <div class="product-list__item-left">

                                    <div class="product-list__item-group"><?php echo $product['name']; ?></div>

                                    <div class="product-list__item-name"><?php echo $product['model']; ?></div>
                                    <div class="product-list__item-info-title">Дополнительные характеристики</div>
                                    <div class="product-list__item-info"><span class="product-list__item-code">Артикул:</span>
                                        <span class="product-list__item-code-v"><?php echo $product['sku']; ?></span>
                                        <span class="product-list__item-year">Год закладки:</span>
                                        <span class="product-list__item-year-v"><?php echo $product['year']; ?></span>
                                        <span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span>
                                        <span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
                                </div>
                                <div class="product-list__item-right">
                                    <?php if (!$product['stock']) { ?>
                                    <div class="text-danger" style="text-align: center; margin: 10px 0px">Нет данного количества товара! </div>
                                    <?php } ?>
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
                                    <div>

                                    </div>

                                <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?>

                                </div>
                                </div>

                            </a>
                            <a class="basket-item__close" href="#" onclick="cart.remove('<?php echo $product['cart_id']; ?>');">
                                <svg class="basket-close-icon">
                                    <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#close"></use>
                                </svg>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>

                </div>
                <div class="basket__red_line-margin">
                    <div class="red_line_total"></div>
                </div>
                <div class="basket__comment">Для окончательного расчета необходимо заполнить ваши контакты.</div>
                <div class="basket__buttom">

                    <div class="basket__buttom-back">
                        <a class="" href="index.php?route=common/catalog">
                            <svg class="arrow-left-orange">
                                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                            </svg>
                        </a>
                        <a class="basket__buttom-back__title" href="index.php?route=common/catalog">Назад</a>
                    </div>
                    <a class="basket__buttom-btn button_orange" href="<?php echo $checkout; ?>"><?php echo $text_checkout_continue; ?></a></p>
                </div>
        </form>
        <?php } else { ?>
            <div class="basket-list2">
                <div class="basket__title">Ваша корзина пуста</div>
            </div>
            <div class="basket__buttom-catalog-wrap"><a class="button_orange" href="index.php?route=common/catalog">Перейти в каталог</a></div>
            <?php echo $count_form; ?>
        <?php } ?>
    </div>
</div>
<script>

    function minusNumber(product_id) {
        num = $('#quantity_'+product_id).val();
        if(num>0)
        $('#quantity_'+product_id).val(num-1)


    }
    function plusNumber(product_id) {
        num = $('#quantity_'+product_id).val();
        $('#quantity_'+product_id).val(parseInt(num)+1)
    }
    function add(product_id) {
        num = $('#quantity'+product_id).val();
        cart.add(product_id, num)


    }
</script>
<?php echo $footer; ?>



