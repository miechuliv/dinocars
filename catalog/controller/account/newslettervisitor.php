<?php  
class ControllerAccountNewslettervisitor extends Controller {
	public function index() {
	if(!isset($this->request->post['product_id'])){	
		if($this->request->post['email_newsletter']){
			if($this->validate($this->request->post['email_newsletter'])){
    	$this->load->model('module/newsletter');
		
		
		$this->model_module_newsletter->addVisitor($this->request->post['email_newsletter']);
		unset($this->session->data['newsletter_error']);
		$this->redirect($this->url->link('common/home', '', 'SSL'));
		
			}else{
				$this->session->data['newsletter_error']=true;
				$this->redirect($this->url->link('common/home', '', 'SSL'));
			}
		}
		else{
			$this->redirect($this->url->link('common/home', '', 'SSL'));
		}
	}else{
		// tryb przypominania o produktach
		if($this->request->post['email_newsletter']){
		if($this->validate($this->request->post['email_newsletter'])){
    	$this->load->model('module/newsletter');
		
		
		$this->model_module_newsletter->addReminder($this->request->post['email_newsletter'],$this->request->post['product_id']);
		unset($this->session->data['newsletter_error']);
		$url='';
		$this->redirect($this->url->link('product/product', $url . '&product_id=' . $this->request->post['product_id']));
		
			}else{
				$this->session->data['newsletter_error']=true;
				$url='';
		        $this->redirect($this->url->link('product/product', $url . '&product_id=' . $this->request->post['product_id']));
			}
		}
		else{
			
			$url='';
		    $this->redirect($this->url->link('product/product', $url . '&product_id=' . $this->request->post['product_id']));
		}
     // koniec
	}	
	}
	
	private function validate($email){
		if(preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/',$email)){
			return true;
		}else{
			return false;
		}
	}
}
?>