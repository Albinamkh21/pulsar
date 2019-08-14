<?php
class ControllerCheckoutCheckout extends Controller {
	public function index() {
	   // Validate cart has products and has stock.
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {

			$this->response->redirect($this->url->link('checkout/cart'));
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}
		}



		$this->load->language('checkout/checkout');
        $this->load->language('common/common');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/locale/'.$this->session->data['language'].'.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		// Required by klarna
		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_checkout_option'] = sprintf($this->language->get('text_checkout_option'), 1);
		$data['text_checkout_account'] = sprintf($this->language->get('text_checkout_account'), 2);
		$data['text_checkout_payment_address'] = sprintf($this->language->get('text_checkout_payment_address'), 2);
		$data['text_checkout_shipping_address'] = sprintf($this->language->get('text_checkout_shipping_address'), 3);
		$data['text_checkout_shipping_method'] = sprintf($this->language->get('text_checkout_shipping_method'), 4);
		
		if ($this->cart->hasShipping()) {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 5);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 6);
		} else {
			$data['text_checkout_payment_method'] = sprintf($this->language->get('text_checkout_payment_method'), 3);
			$data['text_checkout_confirm'] = sprintf($this->language->get('text_checkout_confirm'), 4);	
		}

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		} else {
			$data['error_warning'] = '';
		}

		$data['logged'] = $this->customer->isLogged();

		if (isset($this->session->data['account'])) {
			$data['account'] = $this->session->data['account'];
		} else {
			$data['account'] = '';
		}

		$data['shipping_required'] = $this->cart->hasShipping();

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['cart_link'] = $this->url->link('checkout/cart');

		$this->response->setOutput($this->load->view('checkout/checkout', $data));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}


    public function saveSimple() {
        /*Нужно провалидировать данные*/
        /*Сохранить заказа
        вернуть результат

        отправить письмо
        */
       // print_r($this->request->post);


        $this->load->language('checkout/checkout');
        $json = array();

        // Validate cart has products and has stock.
        if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
            $json['redirect'] = $this->url->link('checkout/cart');
        }

        // Validate minimum quantity requirements.
        $products = $this->cart->getProducts();

        $data['products'] = $products;
        foreach ($products as $product) {
            $product_total = 0;

            foreach ($products as $product_2) {
                if ($product_2['product_id'] == $product['product_id']) {
                    $product_total += $product_2['quantity'];
                }
            }

            if ($product['minimum'] > $product_total) {
                $json['redirect'] = $this->url->link('checkout/cart');

                break;
            }
        }

        // Validate form data
        //если проверки на наличие товара и минимальный остаток прошли успешно
        if (!$json) {

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

                //не мое

                $data['invoice_prefix'] = $this->config->get('config_invoice_prefix');
                $data['store_id'] = $this->config->get('config_store_id');
                $data['store_name'] = $this->config->get('config_name');
                if ($data['store_id']) {
                    $data['store_url'] = $this->config->get('config_url');
                } else {
                    $data['store_url'] = HTTP_SERVER;
                }
                if (isset($this->session->data['payment_method']['code'])) {
                    $data['payment_code'] = $this->session->data['payment_method']['code'];
                } else {
                    $data['payment_code'] = '';
                }
                $data['customer_id'] = 0;
                $data['payment_zone_id'] = '';
                $data['payment_address_format'] = '';
                $data['payment_custom_field'] = '';
                $data['payment_method'] = '';
                $data['payment_code'] ='';
                $data['shipping_company'] = '';
                $data['shipping_method'] = '';
                $data['shipping_address_2'] = '';
                $data['shipping_postcode'] = '';
                $data['shipping_country'] = '';
                $data['shipping_country_id'] = '';
                $data['shipping_zone'] = '';
                $data['shipping_zone_id'] = '';
                $data['shipping_address_format'] = '';
                $data['shipping_custom_field'] = '';
                $data['shipping_code'] = '';
                $data['total'] = '';
                $data['currency_id'] =  '1';//$this->currency->getId();
                $data['currency_code'] = 'RUB'; //$this->currency->getCode();
                $data['currency_value'] ='1'; //$this->currency->getValue($this->currency->getCode());
                $data['ip'] = $this->request->server['REMOTE_ADDR'];
                $data['total'] = '';
                $data['tax'] = 0;
                $data['address_1'] = '';
                $data['city'] = '';

                if (isset($this->request->cookie['tracking'])) {
                    $data['tracking'] = $this->request->cookie['tracking'];

                    $subtotal = $this->cart->getSubTotal();

                    // Affiliate
                    $this->load->model('affiliate/affiliate');

                    $affiliate_info = $this->model_affiliate_affiliate->getAffiliateByCode($this->request->cookie['tracking']);

                    if ($affiliate_info) {
                        $data['affiliate_id'] = $affiliate_info['affiliate_id'];
                        $data['commission'] = ($subtotal / 100) * $affiliate_info['commission'];
                    } else {
                        $data['affiliate_id'] = 0;
                        $data['commission'] = 0;
                    }

                    // Marketing
                    $this->load->model('checkout/marketing');

                    $marketing_info = $this->model_checkout_marketing->getMarketingByCode($this->request->cookie['tracking']);

                    if ($marketing_info) {
                        $data['marketing_id'] = $marketing_info['marketing_id'];
                    } else {
                        $data['marketing_id'] = 0;
                    }
                } else {
                    $data['affiliate_id'] = 0;
                    $data['commission'] = 0;
                    $data['marketing_id'] = 0;
                    $data['tracking'] = '';
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

                if(!$json){
                    $this->load->model('checkout/order');
                    $order_id = $this->model_checkout_order->addOrderSimple($data);
                    $json['success'] = 'Заказ успешно сохранен';
                    //if (isset($this->session->data['order_id']))
                    $this->cart->clear();

                    $subject = html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8');
                    $body =" Оформлен заказ №".$order_id;
                    $body .= " <br/><br/> ";
                    $body .= " Контактаня информация ";
                    $body .= "Имя : ".$this->request->post['name'];
                    $body .= " <br> ";
                    $body .= "Телефон : ".$this->request->post['phone'];
                    $body .= "<br> Email : " . $this->request->post['email'];
                    $body .= "".$this->request->post['comments'];

                    $this->sendMail($subject,$body);

                    $json['redirect'] = $this->url->link('checkout/success');

                }


            }


        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }
    public function sendMail($subject, $body){
        require 'module/callme/phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $this->config->get('config_mail_smtp_hostname'); //'smtp.yandex.ru';
        $mail->SMTPAuth = true;
        $mail->Username = $this->config->get('config_mail_smtp_username');//'albinamkh21'; // логин от вашей почты
        $mail->Password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');//'211907098381aa'; // пароль от почтового ящика
        $mail->SMTPSecure = 'ssl';
        $mail->Port = '465';

        $mail->CharSet = 'UTF-8';
        $mail->From = $this->config->get('config_mail_smtp_username'); // адрес почты, с которой идет отправка
        $mail->FromName = $this->config->get('config_name'); // имя отправителя
        $mail->addAddress($this->config->get('config_email'), $this->config->get('config_name')); // адрес почты, на который будет доставлено письмо

        $mail->isHTML(true);



        $mail->Subject = $subject;
        $mail->Body = $body;
        return $mail->send();

    }

}
