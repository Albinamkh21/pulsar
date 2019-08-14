
<?php
class ControllerCommonCountForm extends Controller {
    private $error = array();
	public function index() {

        $this->load->language('information/contact');
        $this->load->language('common/count_form');



        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {



            $subject = html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8');
            $body = "Оформлена заявка на рассчет";
            $body .= " <br> ";
            $body .= "Имя:".$this->request->post['name'];
            $body .= " <br> ";
            $body .= "Телефон:".$this->request->post['phone'];
            $body .= "<br> Email :" . $this->request->post['email'];
            $body .= " <br> ";
            $body .= "".$this->request->post['comments'];


            if($this->sendMail($subject,$body)){
                $this->response->redirect($this->url->link('common/count_form/success'));
            }else{
                print "не отправилось";
                // $this->response->redirect($this->url->link('information/contact/success'));
            }


            //$this->response->redirect($this->url->link('information/contact/success'));
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        /*$data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('common/')
        );
        */

        $data['heading_title'] = $this->language->get('heading_title');


        $data['text_telephone'] = $this->language->get('text_telephone');
        $data['text_comment'] = $this->language->get('text_comment');

        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_enquiry'] = $this->language->get('entry_enquiry');



        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }

        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        if (isset($this->error['phone'])) {
            $data['error_phone'] = $this->error['phone'];
        } else {
            $data['error_phone'] = '';
        }

        if (isset($this->error['comments'])) {
            $data['error_comments'] = $this->error['comments'];
        } else {
            $data['error_comments'] = '';
        }

        $data['button_submit'] = $this->language->get('button_submit');
        $data['action'] = $this->url->link('checkout/cart/sendForm', '', true);

	    return $this->load->view('common/count_form2', $data);
	}

    public function send(){
        $this->load->language('common/count_form');
        $json = array();

        //validate data
        if ((utf8_strlen(trim($this->request->post['name'])) < 1) || (utf8_strlen(trim($this->request->post['name'])) > 32)) {
            $json['error']['name'] = $this->language->get('error_name');
        }
        else {
            $data['name'] = $this->request->post['name'];
        }
        if ((utf8_strlen($this->request->post['phone']) < 7) || (utf8_strlen($this->request->post['phone']) > 12)) {
            $json['error']['phone'] = $this->language->get('error_phone');
        }
        else {
            $data['phone'] = $this->request->post['phone'];
        }
        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
            $json['error']['email'] = $this->language->get('error_email');
        }
        else {
            $data['email'] = $this->request->post['email'];
        }

        if ((utf8_strlen($this->request->post['comments']) > 512)) {
            $json['error']['comments'] = $this->language->get('error_comments');
        }
        else {
            $data['comments'] = $this->request->post['comments'];
        }
        //check file

        if (!empty($this->request->files['select_file']['name']) && is_file($this->request->files['select_file']['tmp_name'])) {
            // Sanitize the filename
            $filename = basename(html_entity_decode($this->request->files['select_file']['name'], ENT_QUOTES, 'UTF-8'));

            // Validate the filename length
            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
                $json['error']['file'] = $this->language->get('error_filename');
            }

            // Allowed file extension types
            $allowed = array();

            $extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

            $filetypes = explode("\n", $extension_allowed);

            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }

            if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {
                $json['error']['file'] = $this->language->get('error_filetype');

            }

            // Allowed file mime types
            $allowed = array();

            $mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

            $filetypes = explode("\n", $mime_allowed);

            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }

            if (!in_array($this->request->files['select_file']['type'], $allowed)) {
                $json['error']['file'] = $this->language->get('error_filetype');
            }

            // Check to see if any PHP files are trying to be uploaded
            $content = file_get_contents($this->request->files['select_file']['tmp_name']);

            if (preg_match('/\<\?php/i', $content)) {
                $json['error']['file'] = $this->language->get('error_filetype');
            }

            // Return any upload error
            if ($this->request->files['select_file']['error'] != UPLOAD_ERR_OK) {
                $json['error']['file'] = $this->language->get('error_upload_' . $this->request->files['select_file']['error']);
            }
        }
        else if (!empty($this->request->files['select_file']['name']) && !is_file($this->request->files['select_file']['tmp_name'])){
            $json['error']['file'] = $this->language->get('error_filecommon');
        }



        if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
            $data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
            $data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
        } else {
            $data['forwarded_ip'] = '';
        }

        if (isset($this->request->server['HTTP_USER_AGENT'])) {
            $data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
        } else {
            $data['user_agent'] = '';
        }

        if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
            $data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
        } else {
            $data['accept_language'] = '';

        }

        if(!$json){//if no errors send mail


            $subject = html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8');
            $body = "Оформлена заявка на рассчет";
            $body .= " <br> ";
            $body .= "Имя:".$this->request->post['name'];
            $body .= " <br> ";
            $body .= "Телефон:".$this->request->post['phone'];
            $body .= "<br> Email :" . $this->request->post['email'];
            $body .= " <br> ";
            $body .= "".$this->request->post['comments'];

            $file = '';
            $filename = '';
            if(isset($this->request->files['select_file'])){
                $file = $this->request->files['select_file']['tmp_name'];
                $filename = $this->request->files['select_file']['name'];
            }

            if($this->sendMail($subject,$body,$file, $filename)){
                //$this->response->redirect($this->url->link('common/count_form/success'));
                $json['redirect'] = $this->url->link('common/count_form/success');
            }else{
                print "не отправилось";
                // $this->response->redirect($this->url->link('information/contact/success'));
            }


        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));



    }

	protected function validate() {

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        if ((utf8_strlen($this->request->post['phone']) < 7) || (utf8_strlen($this->request->post['phone']) > 32)) {
            $this->error['phone'] = $this->language->get('error_phone');
        }
        if ((utf8_strlen($this->request->post['comments']) < 10) || (utf8_strlen($this->request->post['comments']) > 3000)) {
            $this->error['comments'] = $this->language->get('error_comments');
        }




        return !$this->error;
    }

    public function success() {
        $this->load->language('common/count_form');

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );



        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_message'] = $this->language->get('text_success');

        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/home');


        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('common/success', $data));
    }

    public function sendMail($subject, $body, $file, $filename){
        require 'module/callme/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $this->config->get('config_mail_smtp_hostname'); //'smtp.yandex.ru';
        $mail->SMTPAuth = true;
        $mail->Username = $this->config->get('config_mail_smtp_username');//'albinamkh21'; // логин от вашей почты
        $mail->Password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8'); // пароль от почтового ящика
        $mail->SMTPSecure = 'ssl';
        $mail->Port = '465';

        if(isset($file) && isset($filename)) {
            $mail->AddAttachment($file, $filename);
        }

        $mail->CharSet = 'UTF-8';
        $mail->From = $this->config->get('config_mail_smtp_username'); // адрес почты, с которой идет отправка
        $mail->FromName = $this->config->get('config_name'); // имя отправителя
        $mail->addAddress($this->config->get('config_email'), $this->config->get('config_name')); // адрес почты, на который будет доставлено письмо

        //$mail->AddAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);

        $mail->isHTML(true);



        $mail->Subject = $subject;
        $mail->Body = $body;
        return $mail->send();

    }






}
