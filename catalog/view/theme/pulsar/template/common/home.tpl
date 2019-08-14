<?php echo $header_main; ?>
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
              <div class="about__catalog-btn"><a class="button_orange"> Каталог материальных ценностей</a></div>
            </div>
            <div class="about__right">
              <div class="about__map"><img class="about_img" src="catalog/view/theme/pulsar/img/decor/map-fo.png"></div>
            </div>
            <div class="about__catalog-btn about__catalog-btn_mobile"><a class="button_orange"> Каталог материальных ценностей</a></div>
          </div>
        </div>
        <h2 class="about__more"><a class="about__more_link" href="<?=$about?>">Подробнее</a></h2>
      </div>
      <div class="news">
        <div class="container">
            <?php echo $news_list; ?>

        </div>
      </div>
    <div class="count-form-wrapp">
      <div class="container">
        <a name="count_form"></a>
        <?php echo $count_form; ?>
      </div>
    </div>
    </div>

<?php echo $footer_main; ?>