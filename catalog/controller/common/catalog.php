<?php
class ControllerCommonCatalog extends Controller {
	public function index() {


        $this->load->language('common/common');
        $this->load->language('common/catalog');


        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_catalog'),
            'href' => $this->url->link('common/catalog')
        );
		$this->document->setTitle($this->language->get('text_catalog'));
		$this->document->setDescription($this->language->get('text_catalog'));
		$this->document->setKeywords($this->language->get('text_catalog'));
        $data['heading_title'] =  $this->language->get('text_catalog');

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['action'] = $this->url->link('common/catalog/subscribe', '', true);



		//добавление баннеров

        $this->load->model('design/banner');
        $this->load->model('tool/image');

        $data['banners'] = array();


        $results = $this->model_design_banner->getBanners( array('banner_id'=>6));
        $setting = array(
            'width' => 822,
            'height' => 283
            );

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $data['banners'][] = array(
                    'title' => $result['title'],
                    'link'  => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                );
            }
        }


       /////////////


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

		$this->response->setOutput($this->load->view('common/catalog', $data));
	}
	/*
	public function subscribe(){

    }
*/

}
