<?php
class ModelSettingExtension extends Model {
	function getExtensions($type, $store = false) {

        if($store === false)
        {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = '" . $this->db->escape($type) . "'");
        }
        else
        {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension x
            LEFT JOIN extension_to_store xts ON(x.extension_id = xts.extension_id)
            WHERE `x.type` = '" . $this->db->escape($type) . "'
            AND `xts.store_id` = '".$store."'
             ");
        }




		return $query->rows;
	}

}
?>