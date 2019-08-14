<?php
class ControllerModuleProductFilter extends Controller {
	public function index() {
        $this->load->language('module/product_filter');

        $this->document->addStyle('catalog/view/theme/resale/css/bootstrap-select.css');
        $this->document->addScript('catalog/view/theme/resale/js/bootstrap-select.js');


		$data['heading_title'] = $this->language->get('heading_title');
        $data['size_text'] = $this->language->get('size_text');
        $data['text_filter'] = $this->language->get('text_filter');
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
        $data['entry_date_value'] = $this->language->get('entry_date_value');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_option_value_add'] = $this->language->get('button_option_value_add');
        $data['button_remove'] = $this->language->get('button_remove');


        //$data['search'] = $this->load->controller('common/search');




		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
        $category_id = $parts;

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		$this->load->model('catalog/category');


        //выбираем фильтры категории, если их нет, то выбираем фильры родителя

        $data['filters'] = array();
        $filters = $this->model_catalog_category->getCategoryCustomFilters($category_id);
        $data['filters'] = $filters;
       // print_r($filters);


            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/product_filter.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/product_filter.tpl', $data);
		} else {
			return $this->load->view('default/template/module/product_filter.tpl', $data);
		}
	}
}