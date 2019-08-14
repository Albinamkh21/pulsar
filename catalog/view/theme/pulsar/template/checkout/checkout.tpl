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
    <div class="pages-basket">
        <div class="container">
            <div class="count-form">
                <div class="count-form__title">Ваша контактная информация</div>
                <div class="form">

                        <ul class="count-form__inputs" id="frmId">
                            <li class="count-form__item">
                                <input class="count-form__name" type="text" name = "name" placeholder="Ваше имя">

                            </li>
                            <li class="count-form__item">
                                <input class="count-form__email"  type="text" name = "email" placeholder="Email">

                            </li>
                            <li class="count-form__item">
                                <input class="count-form__phone"  type="text" name = "phone" placeholder="Контактый телефон">

                            </li>
                            <!--<li class="count-form__item">
                                <input class="count-form__address" placeholder="Адрес доставки">
                            </li>
                            -->
                            <li class="count-form__item">
                                <textarea class="count-form__text"  type="text" name = "comments" placeholder="Комментарии"></textarea>
                            </li>
                            <li class="count-form__item">
                                <div class="count-form__comment">
                                    <i>* </i>  Нажимая на кнопку «Отправить заявку», я даю согласие на обработку персональных
                                    данных в соответствии с «Политикой в области обработки и защиты персональных данных».
                                </div>
                            </li>
                        </ul>

                </div>
            </div>
            <div class="basket__red_line-margin">
                <div class="red_line_total"></div>
            </div>
            <div class="basket__comment">Мы в ближайшее время дадим расчет по вашей заявке.</div>
            <div class="basket__buttom">

                <div class="basket__buttom-back">
                    <a  href="<?=$cart_link?>">
                    <svg class="arrow-left-orange">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>
                    </a>
                    <a class="basket__buttom-back__title" href="<?=$cart_link?>">Назад</a>
                </div>
                <a class="basket__buttom-btn button_orange" href="#" id="button-order-save" >Отправить заявку</a>

            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {

        $('#button-order-save').on('click', function (e) {

            console.log('Отправка заказа');
            e.preventDefault();

            $.ajax({
                url: 'index.php?route=checkout/checkout/saveSimple',
                type: 'post',
                data: $('#frmId li input[type=\'text\'], #frmId li input[type=\'date\'], #frmId li input[type=\'datetime-local\'], #frmId li input[type=\'time\'], #frmId li input[type=\'password\'], #frmId li input[type=\'checkbox\']:checked, #frmId li input[type=\'radio\']:checked, #frmId li input[type=\'hidden\'], #frmId li textarea, #frmId li select'),
                dataType: 'json',
                beforeSend: function() {
                    $('#button-payment-address').button('loading');


                },
                complete: function() {
                    $('#button-payment-address').button('reset');
                },
                success: function(json) {
                    console.log(json);

                    $('.text-danger').remove();

                    if (json['redirect']) {
                        location = json['redirect'];
                    } else if (json['error']) {

                        if (json['error']['warning']) {
                            $('#frmId li .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        }

                        for (i in json['error']) {
                            console.log( i);
                            var element = document.getElementsByName(i)[0];
                            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');

                            /*
                            if ($(element).parent().hasClass('input-group')) {
                                $(element).parent().after('<div class="text-danger">' + json['error'][i] + '</div>');
                            } else {
                                $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');
                            }
                            */
                        }

                        // Highlight any found errors
                        $('.text-danger').parent().parent().addClass('has-error');
                    }
                    else {
                        $('#text-success').append(json['success']);
                        $('#text-success').css('display', 'block');
                        location = json['redirect'];



                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);


                }
            });

        });


        $('#button-order-detail').on('click', function (e) {

            console.log('Итоговый список заказа');
            e.preventDefault();
            $.ajax({
                url: 'index.php?route=checkout/confirm/getCart',
                type: 'post',
                //data:'',
                dataType: 'text',
                beforeSend: function() {
                    $('#button-payment-address').button('loading');
                },
                complete: function() {
                    $('#button-payment-address').button('reset');
                },
                success: function(json) {
                    console.log(json);

                    $('#collapse-payment-confirm').html(json);


                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

                }
            });

        });

    });


</script>
<?php echo $footer; ?>