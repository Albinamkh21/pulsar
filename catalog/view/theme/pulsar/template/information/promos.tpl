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
        <div class="promos">
            <?php if ($promos) { ?>
                <ul class="promos__items">
                    <?php foreach ($promos as $promo) { ?>
                        <li class="promos__item"><a class="promos__item-link" href="<?php echo $promo['href'] ?>">
                                <div class="list-item-date promos__item-date"><?php echo  date_format(date_create($promo['date_added']), "d"); echo " ";  echo  $months[ date_format(date_create($promo['date_added']), "m")-0 ]; echo " ";   echo date_format(date_create($promo['date_added']), "Y"); ?></div>
                                <div class="list-item-title promos__item-title"><?php echo $promo['title'] ?></div>
                                <div class="promos__item-content">
                                    <div class="list-item-desc promos__item-photo"><img class="banners-item__img" src="<?php echo $promo['image'] ?>"></div>
                                    <div class="list-item-desc promos__item-desc"><?php echo $promo['description'] ?></div>
                                </div></a>
                            <h2 class="promos__item-line"><a href="<?php echo $promo['href'] ?>" class="promos__item-comment">Узнать больше</a></h2>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
            <?php echo $pagination?>
        </div>


        <div class="subscribe">
            <div class="title">
                ПОДПИШИТЕСЬ НА АКЦИИ И ПЛАТИТЕ МЕНЬШЕ!</div>
            <form id="subscribe_form"action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <ul class="count-form__inputs">
                    <li class="count-form__item">
                        <input class="count-form__name" name="email" placeholder="Ваш email">

                    </li>
                </ul>

                <div class="count-form__btn-wrapper">
                    <a class="subscribe__button" href="#"  id="subscribe_link" "> Подписаться</a>

                </div>
            </form>
            <div class="subscribe__comment">
                <i>* </i> Нажимая на кнопку «Подписаться», я даю согласие на обработку персональных
                данных в соответствии с «Политикой в области обработки и защиты персональных данных».
            </div>
        </div>

    </div>
</div>


<?php echo $footer; ?>
