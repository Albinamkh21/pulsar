<?php
class ControllerCatalogCustomFilter extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/customfilter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/customfilter');

		$this->getList();
	}

	public function add() {
		$this->language->load('catalog/customfilter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/customfilter');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_customfilter->addCustomFilter($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {

		$this->language->load('catalog/customfilter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/customfilter');
        //print_r( $this->request->post);
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_customfilter->editCustomFilter($this->request->get['customfilter_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/customfilter');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/customfilter');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customfilter_id) {
				$this->model_catalog_customfilter->deleteCustomFilter($customfilter_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'od.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/customfilter/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/customfilter/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['customfilters'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$customfilter_total = $this->model_catalog_customfilter->getTotalCustomFilters();

		$results = $this->model_catalog_customfilter->getCustomFilters($filter_data);

		foreach ($results as $result) {
			$data['customfilters'][] = array(
				'customfilter_id'  => $result['customfilter_id'],
				'name'       => $result['name'],
                'customfilter_group'  => $result['customfilter_group'],
				'sort_order' => $result['sort_order'],
				'edit'       => $this->url->link('catalog/customfilter/edit', 'token=' . $this->session->data['token'] . '&customfilter_id=' . $result['customfilter_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');
        $data['column_customfilter_group'] = $this->language->get('column_customfilter_group');


		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . '&sort=od.name' . $url, 'SSL');
		$data['sort_sort_order'] = $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . '&sort=o.sort_order' . $url, 'SSL');
        $data['sort_customfilter_group'] = $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . '&sort=customfilter_group' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $customfilter_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($customfilter_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customfilter_total - $this->config->get('config_limit_admin'))) ? $customfilter_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customfilter_total, ceil($customfilter_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/customfilter_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['customfilter_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_radio'] = $this->language->get('text_radio');
		$data['text_checkbox'] = $this->language->get('text_checkbox');
		$data['text_image'] = $this->language->get('text_image');
		$data['text_input'] = $this->language->get('text_input');
		$data['text_text'] = $this->language->get('text_text');
		$data['text_textarea'] = $this->language->get('text_textarea');
		$data['text_file'] = $this->language->get('text_file');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_datetime'] = $this->language->get('text_datetime');
		$data['text_time'] = $this->language->get('text_time');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_type'] = $this->language->get('entry_type');
		$data['entry_customfilter_value'] = $this->language->get('entry_customfilter_value');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['entry_compare_method'] = $this->language->get('entry_compare_method');
        $data['compare_method_text'] = $this->language->get('compare_method_text');
        $data['compare_method_int'] = $this->language->get('compare_method_int');
        $data['compare_method_select'] = $this->language->get('compare_method_select');
        $data['entry_compare_with'] = $this->language->get('entry_compare_with');
        $data['entry_filter_group'] = $this->language->get('entry_filter_group');




		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_customfilter_value_add'] = $this->language->get('button_customfilter_value_add');
		$data['button_remove'] = $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

        if (isset($this->error['customfilter_group'])) {
            $data['error_customfilter_group'] = $this->error['customfilter_group'];
        } else {
            $data['error_customfilter_group'] = '';
        }

		if (isset($this->error['customfilter_value'])) {
			$data['error_customfilter_value'] = $this->error['customfilter_value'];
		} else {
			$data['error_customfilter_value'] = array();
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['customfilter_id'])) {
			$data['action'] = $this->url->link('catalog/customfilter/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/customfilter/edit', 'token=' . $this->session->data['token'] . '&customfilter_id=' . $this->request->get['customfilter_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/customfilter', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['customfilter_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customfilter_info = $this->model_catalog_customfilter->getCustomFilter($this->request->get['customfilter_id']);
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['customfilter_description'])) {
			$data['customfilter_description'] = $this->request->post['customfilter_description'];
		} elseif (isset($this->request->get['customfilter_id'])) {
			$data['customfilter_description'] = $this->model_catalog_customfilter->getCustomFilterDescriptions($this->request->get['customfilter_id']);
		} else {
			$data['customfilter_description'] = array();
		}

		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($customfilter_info)) {
			$data['type'] = $customfilter_info['type'];
		} else {
			$data['type'] = '';
		}
        if (isset($this->request->post['customfilter_group_id'])) {
            $data['customfilter_group_id'] = $this->request->post['customfilter_group_id'];
        } elseif (!empty($customfilter_info)) {
            $data['customfilter_group_id'] = $customfilter_info['customfilter_group_id'];
        } else {
            $data['customfilter_group_id'] = '';
        }

        $this->load->model('catalog/customfilter_group');

        $data['customfilter_groups'] = $this->model_catalog_customfilter_group->getCustomfilterGroups();

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($customfilter_info)) {
			$data['sort_order'] = $customfilter_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['customfilter_value'])) {
			$customfilter_values = $this->request->post['customfilter_value'];
		} elseif (isset($this->request->get['customfilter_id'])) {
			$customfilter_values = $this->model_catalog_customfilter->getCustomFilterValueDescriptions($this->request->get['customfilter_id']);
		} else {
			$customfilter_values = array();
		}

		$this->load->model('tool/image');

		$data['customfilter_values'] = array();

		foreach ($customfilter_values as $customfilter_value) {
			if (is_file(DIR_IMAGE . $customfilter_value['image'])) {
				$image = $customfilter_value['image'];
				$thumb = $customfilter_value['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['customfilter_values'][] = array(
				'customfilter_value_id'          => $customfilter_value['customfilter_value_id'],
				'customfilter_value_description' => $customfilter_value['customfilter_value_description'],
				'image'                    => $image,
				'thumb'                    => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order'               => $customfilter_value['sort_order']
			);
		}

		/*
        if (isset($this->request->post['compare_id'])) {
		    print 1;
            $compares = $this->request->post['compare_id'];
        } elseif (isset($this->request->get['compare_id'])) {
            print 2;
            $compares = $this->model_catalog_customfilter->getCustomFilterCompares($this->request->get['customfilter_id']);
        } else {
            $compares = array();
        }
        */
        $compares = $this->model_catalog_customfilter->getCustomFilterCompares();
        $data['compares'] = array();

       foreach ($compares as $comp) {
            $data['compares'][] = array(
                'compare_id'    => $comp['compare_id'],
                'name'          => $comp['group_name'].' &gt; ' .$comp['name'],
               // 'compare_method'          => $comp['compare_method'],
            );
        }

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/customfilter_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/customfilter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['customfilter_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 128)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

        if (!$this->request->post['customfilter_group_id']) {
            $this->error['error_customfilter_group'] = $this->language->get('error_filter_group');
        }

        /*
		if (($this->request->post['type'] == 'select' || $this->request->post['type'] == 'radio' || $this->request->post['type'] == 'checkbox') && !isset($this->request->post['customfilter_value'])) {
			$this->error['warning'] = $this->language->get('error_type');
		}

		if (isset($this->request->post['customfilter_value'])) {
			foreach ($this->request->post['customfilter_value'] as $customfilter_value_id => $customfilter_value) {
				foreach ($customfilter_value['customfilter_value_description'] as $language_id => $customfilter_value_description) {
					if ((utf8_strlen($customfilter_value_description['name']) < 1) || (utf8_strlen($customfilter_value_description['name']) > 128)) {
						$this->error['customfilter_value'][$customfilter_value_id][$language_id] = $this->language->get('error_customfilter_value');
					}
				}
			}
		}
*/
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/customfilter')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('catalog/product');

		foreach ($this->request->post['selected'] as $customfilter_id) {
			$product_total = $this->model_catalog_product->getTotalProductsByOptionId($customfilter_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->language->load('catalog/customfilter');

			$this->load->model('catalog/customfilter');

			$this->load->model('tool/image');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$customfilters = $this->model_catalog_customfilter->getCustomFilters($filter_data);

			foreach ($customfilters as $customfilter) {
				$customfilter_value_data = array();

				if ($customfilter['type'] == 'select' || $customfilter['type'] == 'radio' || $customfilter['type'] == 'checkbox' || $customfilter['type'] == 'image') {
					$customfilter_values = $this->model_catalog_customfilter->getCustomFilterValues($customfilter['customfilter_id']);

					foreach ($customfilter_values as $customfilter_value) {
						if (is_file(DIR_IMAGE . $customfilter_value['image'])) {
							$image = $this->model_tool_image->resize($customfilter_value['image'], 50, 50);
						} else {
							$image = $this->model_tool_image->resize('no_image.png', 50, 50);
						}

						$customfilter_value_data[] = array(
							'customfilter_value_id' => $customfilter_value['customfilter_value_id'],
							'name'            => strip_tags(html_entity_decode($customfilter_value['name'], ENT_QUOTES, 'UTF-8')),
							'image'           => $image
						);
					}

					$sort_order = array();

					foreach ($customfilter_value_data as $key => $value) {
						$sort_order[$key] = $value['name'];
					}

					array_multisort($sort_order, SORT_ASC, $customfilter_value_data);
				}

				$type = '';

				if ($customfilter['type'] == 'select' || $customfilter['type'] == 'radio' || $customfilter['type'] == 'checkbox' || $customfilter['type'] == 'image') {
					$type = $this->language->get('text_choose');
				}

				if ($customfilter['type'] == 'text' || $customfilter['type'] == 'textarea') {
					$type = $this->language->get('text_input');
				}

				if ($customfilter['type'] == 'file') {
					$type = $this->language->get('text_file');
				}

				if ($customfilter['type'] == 'date' || $customfilter['type'] == 'datetime' || $customfilter['type'] == 'time') {
					$type = $this->language->get('text_date');
				}

				$json[] = array(
					'customfilter_id'    => $customfilter['customfilter_id'],
					'name'         => strip_tags(html_entity_decode($customfilter['name'], ENT_QUOTES, 'UTF-8')),
					'category'     => $type,
					'type'         => $customfilter['type'],
                    'customfilter_group' => $customfilter['customfilter_group'],
					'customfilter_value' => $customfilter_value_data
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
    public function autocomplete2() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->model('catalog/customfilter');

            $filter_data = array(
                'filter_name' => $this->request->get['filter_name'],
                'start'       => 0,
                'limit'       => 5
            );

            $filters = $this->model_catalog_customfilter->getCustomFilters($filter_data);

            foreach ($filters as $filter) {
                $json[] = array(
                    'filter_id' => $filter['customfilter_id'],
                    'name'      => strip_tags(html_entity_decode($filter['customfilter_group'].' &gt; ' . $filter['name'], ENT_QUOTES, 'UTF-8')),
                    'customfilter_group' => $filter['customfilter_group'],
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}