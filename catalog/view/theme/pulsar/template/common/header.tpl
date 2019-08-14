<!DOCTYPE html>
<html lang="ru-RU">
<head>
  <meta charset="utf-8">
  <base href="<?php echo $base; ?>" />
  <link rel="shortcut icon" href="catalog/view/theme/pulsar/img/favicon.ico" type="image/x-icon">
  <title><?php  if (($title)) echo "ООО «Пульсар» — ".$title; else echo "ООО «Пульсар» — широкий ассортимент материальных ценностей с государственного хранения." ?></title>
  <meta content="Мухамедиева Альбина" name="author">
  <meta name="description" content="<?php if ($description) echo 'ООО «Пульсар» — '.$description; else echo 'Предлагаем купить товары с росрезерва и госрезерва: чёрный и цветной металлопрокат всех профилей, запасные части для подвижного состава, инструмент различного назначения, автоспецтехнику и многое другое.' ?> ">

  <meta name="keywords" content="компания, Пульсар, +7(495)988-02-99, pulsartrade.ru, товары из росрезерва, реализация товаров росрезерва, реализация товаров госрезерва, купить материальные ценности, росрезерв, госрезерв, арматура, верхнее строение путей, горюче-смазочные материалы, запасные части, инвентарь, инструмент, кабельная продукция, лес, медицина, метизы, минеральное сырье, оборудование, приборы, спецодежда, транспорт, трубы, хоз. товары, цветной прокат, цветной прокат, редкоземельные металлы и сплавы, черный прокат, электрика, свет, электроника">

  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="ie=edge" http-equiv="x-ua-compatible">

  <script src="catalog/view/theme/pulsar/js/plugin/svg4everybody.legacy.min.js"></script>
  <script>svg4everybody();</script>
  <link rel="stylesheet" href="catalog/view/theme/pulsar/css/foundation.css">
  <link rel="stylesheet" href="catalog/view/theme/pulsar/css/main.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="catalog/view/theme/pulsar/js/app.bundle.js" defer></script>


  <script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="catalog/view/theme/pulsar/js/jquery-ui.js" ></script>

  <script src="catalog/view/theme/pulsar/js/common.js" type="text/javascript"></script>
  <!--[if lt IE 9]>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
  <![endif]-->
</head>
<body>

<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(53018053, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53018053" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div class="wrapper">
  <header class="pages_header">
    <div class="container">
      <div class="pages_header__top">

       <?=$cart?>

        <div class="header__menu-wrap2"><span class="hamburger-menu__label hamburger-menu__label_dark">МЕНЮ</span>
          <div class="hamburger-menu hamburger-menu_dark"><a class="hamburger-menu__link" href="#"><span class="hamburger-menu__link-center"></span></a></div>
          <div class="header__menu">
            <nav class="menu">
              <ul class="menu__items">
                <li class="menu__item"><a class="menu__link active" href="/"> ГЛАВНАЯ</a></li>
                <li class="menu__item"><a class="menu__link" href="<?=$catalog?>">КАТАЛОГ</a></li>
                <li class="menu__item"><a class="menu__link" href="<?=$about?>">О КОМПАНИИ</a></li>
                <li class="menu__item"><a class="menu__link" href="<?=$news;?>"> НОВОСТИ</a></li>
                <li class="menu__item"><a class="menu__link" href="<?=$promo?>">АКЦИИ</a></li>
                <li class="menu__item"><a class="menu__link" href="<?=$contact?>">КОНТАКТЫ</a></li>
                <li class="menu__item menu__item_red"><a class="menu__link_red" href="<?=$contact?>#contact_form"> Заказать обратный звонок</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <div class="pages_header__bottom">
        <div class="pages_header__logo-wrap">
        <a class="pages_header__link" href="/">
          <div class="logo pages_header__logo"><img src="catalog/view/theme/pulsar/img/decor/logo-pulsar.svg"></div></a>
        </div>
        <div class="pages_header__search">
          <div class="search">
            <div class="search__label">Найти и рассчитать</div>
            <div class="search-input-wrap" >
              <input  name="search_value" class="search-input" type="text" placeholder="Поиск.." id="search-input">
              <div class="search-btn__wrapper" id="search">
                <input  name="search" class="search-btn" type="image" src="catalog/view/theme/pulsar/img/icons/search.svg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>


