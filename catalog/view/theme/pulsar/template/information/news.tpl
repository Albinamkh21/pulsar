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
        <div class="news_list">
            <div class="news_list filter">
                <div class="filter__all"><a href="<?=$news_link?>">За все время</a></div>
                <ul class="filter__years__items">
                    <?php foreach ($filter_year as $year) { ?>
                    <li><a href="<?= $year['link']?>"><?= $year['year']?></a></li>
                    <?php }  ?>

                </ul>
            </div>
            <?php if ($news) { ?>
            <ul class="news_list__items">
                <?php foreach ($news as $new) { ?>
                    <li class="news_list__item"><a class="news_list__item-link" href="<?php echo $new['href'] ?>">
                            <div class="news_list__item-date"><?php echo  date_format(date_create($new['date_added']), "d"); echo " ";  echo  $months[ date_format(date_create($new['date_added']), "m")-0 ]; echo " ";   echo date_format(date_create($new['date_added']), "Y"); ?></div>
                            <div class="news_list__item-title"><?php echo $new['title']; ?></div>
                            <div class="news_list__item-desc">

                                <?php
                                      if(strlen($new['description'])>500){ $desc = mb_substr($new['description'],0,500, "utf-8");  echo $desc."..."; }
                                      else $new['description'];
                                echo "...";
                                ?>
                            </div></a>
                        <h2 class="news_list__item-line"><span class="news_list__item-comment"></span></h2>
                    </li>
                <?php } ?>
            </ul>
            <?php echo $pagination?>
            <?php }  else {?>
                    <div class="desc">Новостей пока нет. </div>
            <?php }  ?>

        </div>
        <div class="news_rbar">
            <div class="news_rbar filter">
                <div class="filter__all"><a href="<?=$news_link?>">За все время</a></div>
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
</div>
</div>
<?php echo $footer; ?>
