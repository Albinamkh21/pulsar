<div class="count-form">
    <div class="count-form__title">РАССЧИТАЕМ И ДАДИМ ГАРАНТИИ</div>

    <div class="form">
        <form id="count_frm"action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <ul class="count-form__inputs">
                <li class="count-form__item">
                    <input class="count-form__name" name="name" placeholder="Ваше имя">
                    <?php if ($error_name) { ?>
                    <div class="text-danger"><?php echo $error_name; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <input class="count-form__phone" name="phone" placeholder="Контактый телефон">
                    <?php if ($error_phone) { ?>
                    <div class="text-danger"><?php echo $error_phone; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <input class="count-form__email" name="email" placeholder="Email">
                    <?php if ($error_email) { ?>
                    <div class="text-danger"><?php echo $error_email; ?></div>
                    <?php } ?>
                </li>
                <li class="count-form__item">
                    <textarea class="count-form__text" placeholder="Комментарии" name="comments""></textarea>
                    <?php if ($error_comments) { ?>
                    <div class="text-danger"><?php echo $error_comments; ?></div>
                    <?php } ?>
                </li>


                <li class="count-form__item">
                    <div class="inputfile-wrap">
                        <input class="count-form__inputfile" placeholder="Выбрать файл" id="select_file" type="files">
                        <label for="select_file">Выбрать файл</label>
                        <svg class="clip">
                            <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#clip"></use>
                        </svg>
                    </div>
                </li>
                <li class="count-form__item">
                    <div class="count-form__btn-wrapper">
                        <a class="count-form__btn" href="#" onclick="document.getElementById('count_frm').submit();"> Оставить заявку</a>

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
