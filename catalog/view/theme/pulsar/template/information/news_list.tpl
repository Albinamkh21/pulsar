<?php
    $months = array( 1 => 'Января' , 'Февраля' , 'Марта' , 'Апреля' , 'Мая' , 'Июня' , 'Июля' , 'Августа' , 'Сентября' , 'Октября' , 'Ноября' , 'Декабря' );
?>

<div class="news__titles">
    <div class="news__titles2">
        <div class="news__title">НОВОСТИ И СОБЫТИЯ</div>
        <div class="news__navigator">
            <div class="slider2__controls">

                <div class="arrows">
                    <a class="slider2__controls-button slider2__controls-button_prev">
                        <svg class="arrow-left-grey">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                        </svg>
                    </a>
                    <a class="slider2__controls-button slider2__controls-button_next">
                        <svg class="arrow-right-orange">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                        </svg>
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="news_block" >
    <?php if(isset($news)) { ?>
    <div class="slider2">
        <ul class="slider__items">
            <?php $i=0; foreach ($news as $new) { ?>
                <?php if($i%4 == 0 && $i>0){ ?>
                        </ul></li>
                <?php } ?>
                <?php if($i%4 == 0){ ?>
                    <li class="slider__item <?php  $active = $i==0 ? 'active':''; echo $active; ?>">
                        <ul class="news__items">
                <?php } ?>
                            <li class="news__item">
                                <a class="news__item-link" href="<?=$new['href'];  ?>">
                                    <div class="news__item-date"><?php echo  date_format(date_create($new['date_added']), "d"); echo " ";  echo  $months[ date_format(date_create($new['date_added']), "m")-0 ]; echo " ";   echo date_format(date_create($new['date_added']), "Y"); ?></div>
                                    <div class="news__item-desc">
                                        <?php if(strlen($new['description'])>200){ $desc = mb_substr($new['description'],0,200, "utf-8");  echo $desc."..."; } else $new['description'];  ?>
                                    </div>
                                </a>
                            </li>


            <?php $i++; } ?>
                    </ul>
                </li>
        </ul>
    <?php } ?>

    </div>
</div>

<div class="news__show-all"><a class="news__show-all__link" href="<?=$news_link;  ?>">Все новости</a></div>

