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
    <div class="pages-contacts">
        <div class="container">
            <div class="contact-info">
                <div class="contact-info__left">
                    <div class="contact-info__data">
                        <div class="contacts__name">ООО «Пульсар»</div>
                        <div class="contacts__phone"><span class="contacts__phone-text">Тел: +7 (495) 988-02-99</span></div>
                        <div  class="contacts__emails">
                            <span class="contacts__email"><a href="mailto:info@pulsartrade.ru">info@pulsartrade.ru </a> </span><span class="contacts__address" >(общие вопросы)</span>
                            <span class="contacts__email"><a href="mailto:sale@pulsartrade.ru">sale@pulsartrade.ru </a> </span><span class="contacts__address" >(отдел продаж)</span>
                         </div>
                        <div class="contacts__address">
                            129090, Россия, Москва, <br>
                            Каланчевская улица, д. 16, стр. 1
                        </div>
                    </div>
                </div>
                <div class="contact-info__right">
                    Мы находимся в бизнес-центре «Каланчевская Плаза», рядом со станциями метро и хорошей транспортной доступностью от крупных транспортных магистралей города.
                    <br/><br/>
                    Железнодорожная станция «Каланчевская» – 1 мин. пешком
                    <br/>
                    м. Комсомольская – 5 мин. пешком
                    <br/>
                    м. Проспект Мира – 15 мин. пешком
                    <br/>
                    «Ярославский», «Казанский», «Ленинградский» ж/д вокзалы – 5 - 10 мин. пешком|<br/>
                    Садовое кольцо – 850 м
                    ТТК – 1,7 км
                </div>
            </div>
        </div>
        <div class="contact-info__line">
            <div class="line-grey"></div>
        </div>
        <div class="pages-contacts__form">
            <div class="container">
                <div class="contact-form" id="contact_form">
                    <div class="contact-form__title">
                        Остались вопросы? <br/>Мы перезвоним в удобное Вам время!</div>
                    <div class="form">
                        <form id="contact_frm" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <ul class="contact-form__inputs">
                            <li class="contact-form__item">
                                <input class="contact-form__name" name="name" placeholder="Ваше имя">
                                <?php if ($error_name) { ?>
                                <div class="text-danger"><?php echo $error_name; ?></div>
                                <?php } ?>
                            </li>
                            <li class="contact-form__item">
                                <input class="contact-form__phone" name="phone" placeholder="Контактый телефон">
                                <?php if ($error_phone) { ?>
                                <div class="text-danger"><?php echo $error_phone; ?></div>
                                <?php } ?>
                            </li>
                            <li class="contact-form__item">
                                <input class="contact-form__email" name="email" placeholder="Email">
                                <?php if ($error_email) { ?>
                                <div class="text-danger"><?php echo $error_email; ?></div>
                                <?php } ?>
                            </li>
                            <li class="contact-form__item">
                                <div class="inputfile-wrap">
                                    <input class="contact-form" placeholder="Выбрать дату:" id="select_date" name="date"  type="text">
                                        <a href="#" id="select_date_link" >
                                            <svg class="calendar">
                                             <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#calendar"></use>
                                             </svg>
                                        </a>
                                 </div>
                                <?php if ($error_date) { ?>
                                <div class="text-danger"><?php echo $error_date; ?></div>
                                <?php } ?>
                            </li>
                            <li class="contact-form__item">
                                <div class="contact-form__time"><span class="contact-form__time-label">Выбрать время:</span>
                                    <div class="contact-form__time-time">
                                        <label class="checkbox_container" for="select_time_1">c 10:00 - 13:00
                                            <input class="contact-form_times" id="select_time_1" type="radio" name="select_time" value="c 10:00 - 13:00">
                                            <div class="checkmark__outer">
                                                <div class="checkmark"></div>
                                            </div>
                                        </label>
                                        <label class="checkbox_container checkbox_container_right" for="select_time_2">c 13:00 - 17:00
                                            <input class="contact-form_times" id="select_time_2" type="radio" checked="checked" name="select_time" value="c 13:00 - 17:00"><span class="checkmark__outer">
                            <div class="checkmark"></div></span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li class="contact-form__item">
                                <textarea class="contact-form__text" placeholder="Комментарии" name="comments""></textarea>
                                <?php if ($error_comments) { ?>
                                <div class="text-danger"><?php echo $error_comments; ?></div>
                                <?php } ?>
                            </li>
                            <li class="contact-form__item">
                                <div class="contact-form__btn-wrapper">
                                    <a class="contact-form__btn" href="#" > Заказать звонок</a>

                                </div>

                            </li>
                            <li class="contact-form__item">
                                <div class="contact-form__comment">
                                    <i>* </i>  Нажимая на кнопку «Заказать звонок», я даю согласие на обработку персональных
                                    данных в соответствии с «Политикой в области обработки и защиты персональных данных».
                                </div>
                            </li>
                        </ul>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $( function() {
        $( "#select_date" ).datepicker(
        {
            monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ],
            dayNamesMin: ["вск", "пн", "вт", "ср", "чт", "пт", "сб"],
            firstDay:1,
            dateFormat: 'dd-mm-yy',
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(day != 6 && day != 0)];
            },
            beforeShow: function(input, inst) {
                var rect = input.getBoundingClientRect();
                setTimeout(function () {
                    inst.dpDiv.css({ top: rect.top, left: rect.left + 270 });
                }, 0);

             },
        });
    });
    $(document).ready(function() {
        $('.contact-form__btn').on('click', function (e) {
            e.preventDefault();
            document.getElementById('contact_frm').submit();

        });
        $('#select_date_link').on('click', function (e) {
            e.preventDefault();
            $('#select_date').datepicker('show');

        });

    });

</script>
<?php echo $footer; ?>

