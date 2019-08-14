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
<div class="pages-news">
    <div class="container">
        <div class="new">
            <ul class="news_list__items">
                <li class="news_list__item">
                    <div class="news_list__item-date"><?php echo  date_format(date_create($date_added), "d"); echo " ";  echo  $months[ date_format(date_create($date_added), "m")-0 ]; echo " ";   echo date_format(date_create($date_added), "Y"); ?></div>
                    <div class="news_list__item-title"><?php echo $heading_title ?></div>
                    <div class="new_text">
                        <?php echo  $description ?>
                        <br/>
                        <a class="new_source" href="<?php echo $source ?>">Источник новости </a>


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
                           <div class="red_line"></div><span class="red_line__comment"></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="news_rbar">
            <div class="news_rbar filter">
                <div class="filter__all">За все время</div>
                <div class="filter__yeas">

                    <?php foreach ($filter_year as $year) { ?>
                    <a href="<?= $year['link']?>"><?= $year['year']?></a>
                    <?php }  ?>

                </div>
            </div>
            <ul class="banners-items">
                <?php foreach ($banners as $banner) { ?>
                <?php if ($banner['link']) { ?>
                <li class="banners-item__link">
                    <a class="banners-item__item" href="<?php echo $banner['link']; ?>">
                        <img class="banners-item__img" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
                    </a>
                </li>

                <?php } else { ?>
                <li class="banners-item__link">
                    <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="banners-item__img" />
                </li>
                <?php } ?>

                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="new__navigator navigator">
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
