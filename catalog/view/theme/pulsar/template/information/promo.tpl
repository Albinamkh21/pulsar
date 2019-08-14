<?php echo $header; ?>
<?php
$months = array( 1 => 'Января' , 'Февраля' , 'Марта' , 'Апреля' , 'Мая' , 'Июня' , 'Июля' , 'Августа' , 'Сентября' , 'Октября' , 'Ноября' , 'Декабря' );
?>

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


<div class="pages-promo">
    <div class="container">
        <div class="promo">
            <div class="promo_content">
                <div class="promo__photo-row">
                    <div class="promo__photo"><img class="pomo__img" src="<?php echo $image; ?>"></div>
                    <div class="promo__desc-wrap">
                        <div class="promo__desc_1">
                           <?php echo $title; ?>
                        </div>
                        <div class="promo__desc_2">

                        </div>
                    </div>
                </div>
            </div>
            <div class="promo__text2">
                <?php echo $description; ?>
            </div>
        </div>
        <div class="pages-promo__form">
            <div class="container">
                <a name="count_form"></a>
                <?php echo $count_form; ?>
            </div>
        </div>
        <div class="pages-promo__redline">
            <div class="red_line-wrapp">
                <a href="#" class="social-share__link" >
                    <svg class="social-network red_line__social-network">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#social-network"></use>
                    </svg>
                </a>
                <div class="social-share">
                    <div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir"></div>
                </div>
                <div class="red_line"></div><span class="red_line__comment"><?php echo  date_format(date_create($date_added), "d"); echo " ";  echo  $months[ date_format(date_create($date_added), "m")-0 ]; echo " ";   echo date_format(date_create($date_added), "Y"); ?></span>
            </div>
        </div>

        <div class="promo__navigator navigator">
            <?php if ($prev) { ?>
                <a class="new__navigator__pred" href="<?=$prev?>"> Предыдущая</a>
                <a href="<?=$prev ?>">
                    <svg class="arrow-left1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>
                </a>
            <?php } ?>
            <?php if ($next) { ?>
                <a href="<?=$next ?>">
                    <svg class="arrow-right1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>
                </a><a class="new__navigator__next" href="<?=$next ?>">Следующая</a>
            <?php } ?>

        </div>
    </div>
</div>



<?php echo $footer; ?>






