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
                    <label class="checkbox_container" for="select_time_1">В наличии
                        <input class="contact-form_times" id="select_time_1" type="checkbox" name="select_time">
                        <div class="checkmark__outer">
                            <div class="checkmark"></div>
                        </div>
                    </label>
                </div>
                <div class="product-sort">
                    <div class="product-sort-wrap"><a class="product-sort__link">Без сортировки
                            <svg class="arrow-down__icon2">
                                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                            </svg></a></div>
                    <ul class="product-sort__items">
                        <li class="product-sort__item">Без сортировки</li>
                        <li class="product-sort__item">Цена(по убыванию)</li>
                        <li class="product-sort__item">Цена(по возрастанию)</li>
                        <li class="product-sort__item">По наименованию(А-Я)</li>
                        <li class="product-sort__item">По наименованию(Я-А)</li>
                        <li class="product-sort__item">По году закладки (по убыванию)</li>
                        <li class="product-sort__item">По году закладки (по возрастанию)</li>
                    </ul>
                </div>
            </div>
            <?php if ($products) { ?>
            <ul class="product-list__items">
                <?php foreach ($products as $product) { ?>
                <li class="product-list__item"><a class="product-list__item-link" href="<?php echo $product['href']; ?>">
                        <div class="product-list__item-left">
                            <div class="product-list__item-group"><?php echo $product['name']; ?></div>
                            <div class="product-list__item-name"><?php echo $product['model']; ?></div>
                            <div class="product-list__item-info-title">Дополнительные характеристики</div>
                            <div class="product-list__item-info"><span class="product-list__item-code">
                                            Артикул:</span><span class="product-list__item-code-v"><?php echo $product['sku']; ?></span>
                                <span class="product-list__item-year">Год закладки:</span><span class="product-list__item-year-v"><?php echo $product['year']; ?></span>
                                <span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
                        </div>
                        <div class="product-list__item-right">
                            <div class="product-list__item-anable"><?php echo $product['stock_status']; ?></div>
                            <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?> </div>
                            <div class="product-list__item-basket">
                                <div class="basket-unit">кг</div>
                                <div class="basket-counts"><span class="basket-minus">-</span><span class="basket-number">1</span><span class="basket-plus">+</span></div>
                                <div class="basket-icon-wrapp">
                                    <svg class="basket-icon22">
                                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#basket-white"></use>
                                    </svg>
                                </div>
                            </div>
                        </div></a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
            <?php if ($products) { ?>
            <ul class="product-list__items-mob">
                <?php foreach ($products as $product) { ?>
                <li class="product-list__item"><a class="product-list__item-link" href="<?php echo $product['href']; ?>">
                        <div class="product-list__item-group"><?php echo $product['name']; ?></div>
                        <div class="product-list__item-name"><?php echo $product['model']; ?></div>
                        <div class="product-list__item-info-title">Дополнительные характеристики</div>
                        <div class="product-list__item-info">
                            <div class="product-list__item-left">
                                <div class="product-list__item-info__row"><span class="product-list__item-code">Артикул:</span><span class="product-list__item-code-v"><?php echo $product['sku']; ?></span></div>
                                <div class="product-list__item-info__row"><span class="product-list__item-year">Год закладки:</span><span class="product-list__item-year-v"><?php echo $product['year']; ?></span></div>
                                <div class="product-list__item-info__row"><span class="product-list__item-gost">ГОСТ, ОСТ, ТУ:</span><span class="product-list__item-gost-v"><?php echo $product['gost']; ?></span></div>
                            </div>
                            <div class="product-list__item-right">
                                <div class="product-list__item-anable"><?php echo $product['stock_status']; ?></div>
                                <div class="product-list__item-price"><?php if($product['price']>0 ) {echo $product['price']; } else { echo "Цена по запросу"; } ?></div>
                                <div class="product-list__item-basket">
                                    <div class="basket-unit">кг</div>
                                    <div class="basket-counts"><span class="basket-minus">-</span><span class="basket-number">1</span><span class="basket-plus">+</span></div>
                                    <div class="basket-icon-wrapp">
                                        <svg class="basket-icon22">
                                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#basket-white"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>

            <?php if(empty($products)){ ?>
            <div class="common-message">
                <?php echo $text_notfound; ?>
            </div>
            <?php } ?>

            <?php if (isset($pagination)) { ?>
                <?php echo $pagination; ?>
            <?php } ?>
            <!--
            <div class="product-list__navigator navigator">
                <svg class="arrow-left1">
                    <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                </svg>
                <div class="navigator__result">Найдено <?php echo $products_count;?> </div>
                <svg class="arrow-right1">
                    <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                </svg>
            </div>
            -->
        </div>
    </div>
</div>
</div>


<script type="text/javascript"><!--
    $('#button-search').bind('click', function() {
        url = 'index.php?route=product/search';

        var search = $('#content input[name=\'search\']').prop('value');

        if (search) {
            url += '&search=' + encodeURIComponent(search);
        }

        var category_id = $('#content select[name=\'category_id\']').prop('value');

        if (category_id > 0) {
            url += '&category_id=' + encodeURIComponent(category_id);
        }

        var sub_category = $('#content input[name=\'sub_category\']:checked').prop('value');

        if (sub_category) {
            url += '&sub_category=true';
        }

        var filter_description = $('#content input[name=\'description\']:checked').prop('value');

        if (filter_description) {
            url += '&description=true';
        }

        location = url;
    });

    $('#content input[name=\'search\']').bind('keydown', function(e) {
        if (e.keyCode == 13) {
            $('#button-search').trigger('click');
        }
    });

    $('select[name=\'category_id\']').on('change', function() {
        if (this.value == '0') {
            $('input[name=\'sub_category\']').prop('disabled', true);
        } else {
            $('input[name=\'sub_category\']').prop('disabled', false);
        }
    });

    $('select[name=\'category_id\']').trigger('change');
    --></script>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=e410b4c7-5818-428f-ae3c-8b660074d81d" type="text/javascript"></script>
<?php echo $footer; ?>
</body>
</html>