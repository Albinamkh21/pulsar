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
  <div class="pages-catalog">
    <div class="container">
      <?php echo $column_right; ?>
      <div class="pages-catalog__left">
        <div class="catalog">
          <?php if($categories) { ?>
            <ul class="catalog__items">
              <?php foreach ($categories as $category) { ?>
                <li class="catalog__item">
                  <a class="catalog__item-link" href="<?php echo $category['href']; ?>">
                    <div class="catalog__icon-wpap">
                      <svg class="catalog__icon">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/catalog.svg#<?php echo $category['description']; ?>"></use>
                      </svg>
                    </div>
                    <div class="catalog__item-title"><?php echo $category['name']; ?></div>
                  </a>
                </li>

              <?php } ?>
            </ul>
          <?php } ?>

          <div class="red_line-margin">
            <div class="red_line_total"></div>
          </div>
        </div>
        <div class="pages-catalog__promo">


          <?php foreach ($banners as $banner) { ?>
          <div class="item">
            <?php if ($banner['link']) { ?>
            <a class="link" href="<?php echo $banner['link']; ?>">
              <img class="catalog_promo__img" src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" />
            </a>
            <?php } else { ?>
              <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="catalog_promo__img" class="img-responsive" />
            <?php } ?>
          </div>
          <?php } ?>

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
  </div>
</div>

<?php echo $footer; ?>
