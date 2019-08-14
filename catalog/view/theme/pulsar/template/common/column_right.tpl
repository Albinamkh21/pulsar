<div class="pages-catalog__right">
  <div class="catalog-filter">
    <?php if(isset($filter_catefory) && $filter_catefory==1) { ?>
    <div class="red_line-margin">
      <div class="red_line_total"></div>
    </div>
      <div class="filter-catefory">
        <div class="filter-catefory__name">Настроить поиск по:</div>
        <a class="filter-catefory__byname button_orange button_orange_wd">Наименованию</a>
        <a class="filter-catefory__bygost button_orange button_orange_wd">Гост, Ост, ТУ</a>
        <a class="filter-catefory__clear" id ="filter-catefory__clear" href="<?php echo $action; ?>" >Сбросить все
          <span class="filter-catefory-count" id="filter_count"></span>
        </a>
      </div>
    <?php } ?>

    <div class="filter-box-overlay" id="filter_name">
      <div class="filter-box">
        <div class="filter-box__header">
          <div class="filter-box__name">Настроить поиск по наименованию </div><a class="filter-box__close">
            <svg class="close-icon">
              <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#close"></use>
            </svg></a>
        </div>
        <form id="frm" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name ="category_id" value="<?=$category_id?>" >
        <?php if($products) { ?>
        <ul class="filter-box__items">
          <?php foreach ($products as $product) { ?>
          <li class="filter-box__item">
            <div class="filter__checkbox">
              <label class="checkbox_container" for="filter_<?=$product['product_id'] ?>">
                <input class="contact-form_times" type="checkbox"  name='filter[]' value="<?php echo $product['product_id'] ?>"  id="filter_<?=$product['product_id'] ?>" />
                <div class="checkmark__outer">
                  <div class="checkmark"></div>
                </div>
              </label>
            </div>
            <div class="filter__name"><?=$product['name']?></div>
          </li>
          <?php } ?>
        </ul>
        <?php } else { print "Нет товаров в этой категории!"; } ?>
          <div class="button_orange-wrapp">
            <a  onclick="document.getElementById('frm').submit();">
            <div class="button_orange button_orange_wd_218">Найти</div>
            </a>
            <a class="filter-box__clear" href="#" >Сбросить все</a>
          </div>
        </form>
      </div>
    </div>

    <div class="filter-box-overlay" id="filter_gost">
      <div class="filter-box">
        <div class="filter-box__header">
          <div class="filter-box__name">Настроить поиск по ГОСТ,ОСТ, ТУ </div><a class="filter-box__close">
            <svg class="close-icon">
              <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#close"></use>
            </svg></a>
        </div>
        <form id="frm2" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
          <input type="hidden" name ="category_id" value="<?=$category_id?>" >
          <?php if($gosts) { ?>
          <ul class="filter-box__items">
            <?php foreach ($gosts as $gost) { ?>
            <li class="filter-box__item">
              <div class="filter__checkbox">
                <label class="checkbox_container" for="gost_<?=$gost['gost'] ?>">
                  <input class="contact-form_times" type="checkbox"  name='gosts[]' value="<?php echo $gost['gost'] ?>"  id="gost_<?=$gost['gost'] ?>" />
                  <div class="checkmark__outer">
                    <div class="checkmark"></div>
                  </div>
                </label>
              </div>
              <div class="filter__name"><?=$gost['gost']?></div>
            </li>
            <?php } ?>
          </ul>
          <?php } else { print "Нет товаров в этой категории!"; } ?>
          <div class="button_orange-wrapp">
            <a  onclick="document.getElementById('frm2').submit();">
              <div class="button_orange button_orange_wd_218">Найти</div>
            </a>
            <a class="filter-box__clear" href="#" >Сбросить все</a>
          </div>
        </form>
      </div>
    </div>


  </div>
  <div class="catalog-filter-cat">
    <div class="catalog-filter-cat__label">ВСЕ КАТЕГОРИИ
      <a class="catalog-filter-cat__arrow" id="catalog-filter-cat__arrow">
        <svg class="arrow-down__icon">
          <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
        </svg></a></div>
  </div>
  <div class="catalog-list">
    <?php if($categories) { ?>
      <ul class="catalog-list__items">
        <?php foreach ($categories as $category) { ?>
          <li class="catalog-list__item"><a class="catalog-list__item-link" href="<?php echo $category['href']; ?>">
              <svg class="catalog__icon">
                <use xlink:href="catalog/view/theme/pulsar/img/icons/catalog.svg#<?php echo $category['description']; ?>"></use>
              </svg>
              <div class="catalog-list__item-title"><?php echo $category['name']; ?></div></a></li>
          </li>
        <?php } ?>
      </ul>
    <?php } ?>

    <div class="catalog-red_line-margin">
      <div class="red_line_total"></div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      $('.filter-box__clear').on('click', function (e) {
          e.preventDefault();
          var checks = document.querySelectorAll('.filter-box__items input[type="checkbox"]');
          for(var i =0; i< checks.length;i++) {
              var check = checks[i];
              if (!check.disabled) {
                  check.checked = false;
              }
          }


      });
  });
  /*
function uncheckAll(e)
{
    e.preventDefault();
  var checks = document.querySelectorAll('.filter-box__items input[type="checkbox"]');
  for(var i =0; i< checks.length;i++) {
      var check = checks[i];
      if (!check.disabled) {
          check.checked = false;
      }
  }


}
/*
var ul = document.querySelectorAll('.filter-box__items')[0];
ul.addEventListener('change',function (e) {

    if(e.target.type != 'checkbox')
        return;


    var checks = document.querySelectorAll('.filter-box__items input[type="checkbox"]');
    var count = 0;
    for(var i =0; i< checks.length;i++) {
        var check = checks[i];
        if (check.checked ) {
            count++;
        }
    }
    document.getElementById('filter_count').innerHTML = count;

} );
*/
document.addEventListener("DOMContentLoaded", function(event) {
    event.preventDefault();

    var filter_clear = document.getElementById('filter_clear').value;
    //document.getElementById('filter_count');
    if(filter_clear) {

        var el =  document.getElementById('filter-catefory__clear');
        el.style.color = "#e64814";

    }

});

</script>