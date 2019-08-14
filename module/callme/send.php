<?php

if( $_POST ){
	require 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();

	$mail->Host = $this->config->get('config_mail_smtp_hostname');//'smtp.yandex.ru';
	$mail->SMTPAuth = true;
    $mail->Username = $this->config->get('config_mail_smtp_username');//'albinamkh21'; // логин от вашей почты
    $mail->Password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');//'211907098381aa'; // пароль от почтового ящика
	$mail->SMTPSecure = 'ssl';
	$mail->Port = '465';

	$mail->CharSet = 'UTF-8';
    $mail->From = $this->config->get('config_mail_smtp_username'); // адрес почты, с которой идет отправка
    $mail->FromName = $this->config->get('config_name'); // имя отправителя
    $mail->addAddress($this->config->get('config_email'),$this->config->get('config_name')); // адрес почты на который будет доставлено письмо

	$mail->isHTML(true);

	$mail->Subject = 'Заказ звонка';
	$mail->Body = "<b>Имя:</b> {$_POST['callme_name']}<br> <b>Телефон:</b> {$_POST['callme_phone']}";

	$mail->SMTPDebug = 1;

	if( $mail->send() ){
		echo 'Спасибо за обращение. Наш менеджер вскоре свяжется с Вами.';
	}else{
		echo 'Ошибка! Попробуйте позже.';
	}
}