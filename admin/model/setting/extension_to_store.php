<?php
/**
 * Created by JetBrains PhpStorm.
 * User: USER
 * Date: 24.01.14
 * Time: 11:15
 * To change this template use File | Settings | File Templates.
 */

class ModelSettingExtensionToStore extends Model{

    public function getAllExtensions()
    {
         $q = $this->db->query("SELECT * FROM extension
          ");

         $ext = array();

         foreach($q->rows as $row)
         {
             $subq = $this->db->query("SELECT * FROM extension_to_store
            WHERE extension_id = '".(int)$row['extension_id']."'
          ");

           $subData = array();

           if($subq->rows)
           {
                foreach($subq->rows as $srow){
                    $subData[] =  $srow['store_id'];

                }
           }

            $ext[] = array(
               'code' => $row['code'],
                'extension_id' => $row['extension_id'],
               'stores' => $subData
            );

         }

         return $ext;

    }

    public function deleteAll()
    {
        $this->db->query("DELETE FROM  extension_to_store  ");
    }

    public function save($data)
    {
        if(empty($data))
        {
            return false;
        }

        $this->deleteAll();

        foreach($data as $ext => $stores)
        {


            foreach($stores as $store)
            {
                $this->db->query("INSERT INTO extension_to_store SET extension_id = '".(int)$ext."'
              , store_id = '".(int)$store."' ");
            }

        }
    }

}