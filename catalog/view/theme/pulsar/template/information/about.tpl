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
<div class="pages-about">
    <div class="about">
        <div class="container">
            <div class="about__content">
                <div class="about__left">
                    <div class="about__title">ООО «ПУЛЬСАР»</div>
                    <div class="about__desc">

                        Cовременная, динамично развивающаяся компания, предлагающая своим клиентам широкий ассортимент материальных ценностей с государственного хранения по всем федеральным округам России:
                        <br>
                        <br>
                        - чёрный и цветной металлопрокат всех профилей;<br>
                        - запасные части для подвижного состава;<br>
                        - инструмент различного назначения;<br>
                        - автоспецтехнику и многое другое.<br>
                    </div>
                    <div class="about__catalog-btn"><a class="button_orange" href="<?=$catalog?>"> Каталог материальных ценностей</a></div>
                </div>
                <div class="about__right">
                    <div class="about__map"><img class="about_img" src="catalog/view/theme/pulsar/img/decor/map-fo.png"></div>
                </div>
                <div class="about__catalog-btn about__catalog-btn_mobile"><a class="button_orange" href="<?=$catalog?>"> Каталог материальных ценностей</a></div>
            </div>
        </div>
        <h2 class="about__more"><span class="about__more_link">Подробнее</span></h2>
    </div>
    <div class="container">
        <div class="slider">
            <ul class="slider__items">
                <li class="slider__item active"><img class="slider__item-img" src="catalog/view/theme/pulsar/img/content/slider/about-company-1.jpg"></li>
                <li class="slider__item"><img class="slider__item-img" src="catalog/view/theme/pulsar/img/content/slider/about-company-2.jpg"></li>
                <li class="slider__item"><img class="slider__item-img" src="catalog/view/theme/pulsar/img/content/slider/about-company-3.jpg"></li>
                <li class="slider__item"><img class="slider__item-img" src="catalog/view/theme/pulsar/img/content/slider/about-company-4.jpg"></li>
                <li class="slider__item"><img class="slider__item-img" src="catalog/view/theme/pulsar/img/content/slider/about-company-5.jpg"></li>
            </ul>
            <!--ul.slider_dots-->
            <div class="slider__controls">
                <div class="line_orange"></div>
                <div class="arrows"><a class="slider__controls-button slider__controls-button_prev">
                        <svg class="arrow-left-grey">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                        </svg></a><a class="slider__controls-button slider__controls-button_next">
                        <svg class="arrow-right-orange">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                        </svg></a></div>
                <div class="line_orange line_orange_right"></div>
            </div>
        </div>

        <?php echo $count_form; ?>

    </div>
</div>

<?php echo $footer; ?>
