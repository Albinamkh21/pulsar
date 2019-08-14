<div class="count-form">
    <div class="count-form__title">РАССЧИТАЕМ И ДАДИМ ГАРАНТИИ</div>

    <div class="form">
        <form id="frmId"  enctype="multipart/form-data" class="form-horizontal">
             <ul class="count-form__inputs" id="inputs">
                <li class="count-form__item">
                    <input class="count-form__name" name="name" placeholder="Ваше имя" type="text" />
                    <?php if ($error_name) { ?>
                    <div class="text-danger"><?php echo $error_name; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <input class="count-form__phone" name="phone" placeholder="Контактый телефон" type="text" />
                    <?php if ($error_phone) { ?>
                    <div class="text-danger"><?php echo $error_phone; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <input class="count-form__email" name="email" placeholder="Email"type="text" />
                    <?php if ($error_email) { ?>
                    <div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <textarea class="count-form__text" placeholder="Комментарии" name="comments" id="comments"></textarea>
                    <?php if ($error_comments) { ?>
                    <div class="text-danger"><?php echo $error_comments; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <div class="inputfile-wrap" name="file" id="file">
                        <input class="count-form__inputfile" placeholder="Выбрать файл" id="select_file" name="select_file" type="file"  />
                        <label for="select_file" id="file_label">Выбрать файл </label>
                        <a href="#" class="clip-link">
                            <svg class="clip">
                                <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#clip"></use>
                            </svg>
                        </a>
                    </div>
                </li>
                <li class="count-form__item">
                    <div class="count-form__btn-wrapper">

                        <a class="count-form__btn" href="#" id="form-count-btn-send"> Оставить заявку</a>
                    </div>
                </li>
                <li class="count-form__item">
                    <div class="count-form__comment">
                        <i>* </i>  Нажимая на кнопку «Оставить заявку», я даю согласие на обработку персональных
                        данных в соответствии с «Политикой в области обработки и защиты персональных данных».
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {


        $('.clip-link').on('click', function(e) {
                 e.preventDefault();
                $('#select_file').trigger('click');

        });

        $('#select_file').change(function(){
             var size =  document.querySelector('#select_file').files[0]['name']
             document.getElementById('file_label').innerHTML = $('#select_file').val();
        });


        $('#form-count-btn-send').on('click', function (e) {
            e.preventDefault();


            if(document.querySelector('#select_file').files[0] && document.querySelector('#select_file').files[0]['size']> 4124672)
            {
                $('#file').after('<div class="text-danger">Размер файла не должен превышать 2МБ </div>');
                return;

            }

            $.ajax({
                url: 'index.php?route=common/count_form/send',
                type: 'post',
                data: new FormData($('#frmId')[0]),
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    document.getElementById('form-count-btn-send').innerHTML = 'Идет отправка...';
                    $('#form-count-btn-send').addClass('isDisabled');

                },
                complete: function() {
                    document.getElementById('form-count-btn-send').innerHTML = 'Оставить заявку';
                    $('#form-count-btn-send').removeClass('isDisabled');
                },
                success: function(json) {


                    $('.text-danger').remove();

                    if (json['redirect']) {
                        console.log(json);
                        location = json['redirect'];
                    } else if (json['error']) {

                        //document.getElementById('form-count-btn-send').innerHTML = 'Оставить заявку';
                        if (json['error']['warning']) {
                            $('#inputs li .panel-body').prepend('<div class="alert alert-warning">' + json['error']['warning'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        }

                        for (i in json['error']) {
                            console.log( i);
                            var element = document.getElementsByName(i)[0];
                            $(element).after('<div class="text-danger">' + json['error'][i] + '</div>');


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
    });
</script>
