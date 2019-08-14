<?php
class ControllerCommonColumnRight extends Controller {
	public function index() {
		$this->load->model('design/layout');

		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}

		$layout_id = 0;

		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$this->load->model('catalog/category');

			$path = explode('_', (string)$this->request->get['path']);

			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
		}

		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$this->load->model('catalog/product');

			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
		}

		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$this->load->model('catalog/information');

			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}

		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}

		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}

		$this->load->model('extension/module');

		$data['modules'] = array();

		$modules = $this->model_design_layout->getLayoutModules($layout_id, 'column_right');

		foreach ($modules as $module) {
			$part = explode('.', $module['code']);

			if (isset($part[0]) && $this->config->get($part[0] . '_status')) {
				$module_data = $this->load->controller('extension/module/' . $part[0]);

				if ($module_data) {
					$data['modules'][] = $module_data;
				}
			}

			if (isset($part[1])) {
				$setting_info = $this->model_extension_module->getModule($part[1]);

				if ($setting_info && $setting_info['status']) {
					$output = $this->load->controller('extension/module/' . $part[0], $setting_info);

					if ($output) {
						$data['modules'][] = $output;
					}
				}
			}
		}

        $this->load->model('catalog/category');

        $this->load->model('catalog/product');
        //получение данных для фильтров
        $path=0;
        if(isset($this->request->get['path'])) {
            $category_id = $this->request->get['path'];
            $path = $this->request->get['path'];
            $data['category_id'] = $category_id;
            $results = $this->model_catalog_category->getProductsInCategory($category_id);
            $data['products'] = array();
            foreach ($results as $result) {
                $data['products'][] = array(
                    'product_id' => $result['name'],
                    'name' => $result['name'],
                    /*'model'  => $result['model'],
                    'sku'  => $result['sku'],
                    'year'  => $result['upc'],
                    'gost'  => $result['ean'],
                    */
                );
            }
            $results = $this->model_catalog_category->getGostsInCategory($category_id);
            $data['gosts'] = array();
            foreach ($results as $result) {
                $data['gosts'][] = array(
                    'gost' => $result['gost'],

                    /*'model'  => $result['model'],
                    'sku'  => $result['sku'],
                    'year'  => $result['upc'],
                    'gost'  => $result['ean'],
                    */
                );
            }
        }
        // Menu
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


        $data['action'] = $this->url->link('product/category',  'path=' . $path, true);

        if(isset($this->request->get['route']) && $this->request->get['route'] == 'product/search') {
            $data['filter_catefory']  = 0;
        }
        else {
            $data['filter_catefory']  = 1;
        }


       return $this->load->view('common/column_right', $data);
	}
}
