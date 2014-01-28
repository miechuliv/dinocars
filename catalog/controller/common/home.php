<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

        $this->load->model('catalog/manufacturer');

        $this->data['manufacturers'] = array();

        $this->language->load('common/home');



        $this->data['text_marka'] = $this->language->get('text_marka');
        $this->data['text_model'] = $this->language->get('text_model');
        $this->data['text_typ'] = $this->language->get('text_typ');
        $this->data['text_search_cars'] = $this->language->get('text_search_cars');
        $this->data['text_choose'] = $this->language->get('text_choose');

        $this->data['text_why_us'] = $this->language->get('text_why_us');
        $this->data['text_cheap'] = $this->language->get('text_cheap');
        $this->data['text_send'] = $this->language->get('text_send');
        $this->data['text_wide_choice'] = $this->language->get('text_wide_choice');
        $this->data['text_zakup'] = $this->language->get('text_zakup');

        $this->data['text_save'] = $this->language->get('text_save');

        $this->data['text_fast'] = $this->language->get('text_fast');
        $this->data['text_payment'] = $this->language->get('text_payment');
        $this->data['text_shipping'] = $this->language->get('text_shipping');
        $this->data['text_newsletter'] = $this->language->get('text_newsletter');
        $this->data['text_zakupy'] = $this->language->get('text_zakup');
        $this->data['text_newsletter_ipsum'] = $this->language->get('text_newsletter_ipsum');
        $this->data['text_about_us'] = $this->language->get('text_about_us');
        $this->data['text_about_us_ipsum'] = $this->language->get('text_about_us_ipsum');


        $manufacturers = $this->model_catalog_manufacturer->getManufacturers();

        foreach($manufacturers as $manufacturer)
        {
            $this->data['manufacturers'][$manufacturer['manufacturer_id']] =  $manufacturer['name'];

        }


        $this->data['car_action'] = $this->url->link('product/category');

		$this->data['heading_title'] = $this->config->get('config_title');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}


		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header',
            
		);
										
		$this->response->setOutput($this->render());
	}
}
?>