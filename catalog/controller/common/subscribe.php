
<?php
class ControllerCommonSubscribe extends Controller {
    private $error = array();

    public function save(){

        $this->load->language('common/count_form');
        $json = array();


        if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
            $json['error']['email'] = $this->language->get('error_email');
        }
        else {
            $data['email'] = $this->request->post['email'];

            $this->load->model('extension/subscribe');

            $subscribe_id = $this->model_extension_subscribe->addEmail($data);

            if($subscribe_id) {
                $json['redirect'] = $this->url->link('common/subscribe/success');
            }

        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));




    }



    public function success() {
        $this->load->language('common/subscribe');
        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );



        $data['heading_title'] = $this->language->get('heading_title');


        $data['text_message'] = sprintf($this->language->get('text_message'));
        $data['button_continue'] = $this->language->get('button_continue');

        $data['continue'] = $this->url->link('common/catalog');

        $data['column_left'] = $this->load->controller('common/column_left');
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['content_top'] = $this->load->controller('common/content_top');
        $data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');

        $this->response->setOutput($this->load->view('common/success', $data));
    }

    public function sendMail($subject, $body){


    }






}
