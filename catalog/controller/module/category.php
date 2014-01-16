<?php  
class ControllerModuleCategory extends Controller {
	protected function index($setting) {
		$this->language->load('module/category');

        $this->data['heading_title'] = $this->language->get('heading_title');




        if(isset($this->request->get['path']))
        {
            $path = $this->request->get['path'];
        }
        else
        {
            $path = '';
        }

        $this->data['path'] = $path;

        $this->data['route'] = isset($this->request->get['route'])?$this->request->get['route']:false;

		
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}
		
		if (isset($parts[0])) {
			$this->data['category_id'] = $parts[0];
		} else {
			$this->data['category_id'] = 0;
		}
		
		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}

        $url = '';

        if(isset($this->request->get['make']))
        {
            $url .= '&make='.$this->request->get['make'];
        }

        if(isset($this->request->get['model']))
        {
            $url .= '&model='.$this->request->get['model'];
        }

        if(isset($this->request->get['type']))
        {
            $url .= '&type='.$this->request->get['type'];
        }

        if(isset($this->request->get['filters']['product_type']))
        {
            $url .= '&typ='.$this->request->get['filters']['product_type'];
        }

        $this->data['car_action'] = $this->url->link('product/category');
							
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$this->data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
         if(!$category['virtual']){
			//$total = $this->model_catalog_product->getTotalProducts(array('filter_category_id' => $category['category_id']));

			$children_data = array();

			$children = $this->model_catalog_category->getCategories($category['category_id']);

			foreach ($children as $child) {
				$data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);

				//$product_total = $this->model_catalog_product->getTotalProducts($data);

				//$total += $product_total;

				$children_data[] = array(
					'category_id' => $child['category_id'],
				//	'name'        => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
                    'name'        => $child['name'],
					'href'        => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'].$url)
				);




			}

			$this->data['categories'][] = array(
				'category_id' => $category['category_id'],
				//'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $total . ')' : ''),
                'name'        => $category['name'],
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'].$url)
			);

         }
		}


        $this->children = array(
         //   'module/extrasearch',


        );
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/category.tpl';
		} else {
			$this->template = 'default/template/module/category.tpl';
		}
		
		$this->render();
  	}
}
?>