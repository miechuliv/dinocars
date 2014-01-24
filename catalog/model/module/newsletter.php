<?php  
class ModelModuleNewsletter extends Model {
	public function addVisitor($email) {
		
	if(isset($email)){	
		
	  $this->db->query("INSERT INTO `".DB_PREFIX."visitor` SET store_id='".(int)$this->config->get('config_store_id')."', email='".$email."', newsletter='1' ");
	}
	}
	
	public function addReminder($email, $product_id) {
		
	if(isset($email) AND isset($product_id)){	
		
	  $this->db->query("INSERT INTO `".DB_PREFIX."reminder` SET store_id='".(int)$this->config->get('config_store_id')."', email='".$email."', product_id='".$product_id."' ,active='1' ");
	}
	}
	
	
}
?>