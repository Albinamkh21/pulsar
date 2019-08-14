<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer_main'] = $this->load->controller('common/footer_main');
		$data['header_main'] = $this->load->controller('common/header_main');
        $data['count_form'] = $this->load->controller('common/count_form');
        $data['about'] = $this->url->link('information/about');

        $data['news_list'] = $this->load->controller('information/news_list');

        $this->load->model('catalog/category');
        $this->load->model('catalog/product');

        $data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories(0);

        foreach ($categories as $category) {
            $data['categories'][] = array(
                'name'     => $category['name'],
                'description' =>$category['description'],
                'column'   => $category['column'] ? $category['column'] : 1,
                'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
            );
        }

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
