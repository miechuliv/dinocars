<?php

class ModelEbaydebayTemplates extends Model {

    public function addSzablon( $data, $country ) {

        $this->db->query( "INSERT INTO debay_template (name,title,value,country) values('$data[name]','$data[title]','$data[value]', '$country')" ) ;
    }

    public function editSzablon( $szablon_id, $data, $country ) {

        $this->db->query( "UPDATE debay_template SET name = '" . $this->db->escape( $data['name'] ) . "', title = '" . $this->db->escape( $data['title'] ) . "', value = '" . $this->db->escape( $data['value'] ) . "'
        , country = '".$country."' WHERE debay_template_id = '" . ( int )$szablon_id . "'" ) ;
    }

    public function deleteSzablon( $szablon_id, $country = false ) {

        $this->db->query( "DELETE FROM debay_template WHERE debay_template_id = '" . ( int )$szablon_id . "'" ) ;
    }

    public function getSzablon( $szablon_id, $country = false) {

        $query = $this->db->query( "SELECT DISTINCT * FROM debay_template WHERE debay_template_id = '" . ( int )$szablon_id . "'" ) ;



        return $query->row ;
    }

    public function getSzablony( $country) {



        $query = $this->db->query( "SELECT * FROM debay_template WHERE country = '".$country."' " ) ;

        return $query->rows ;
    }

    public function showTemplate( $TemplateName, $country = false ) {

        $query = $this->db->query( "select * from debay_template where name = '$TemplateName'" ) ;

        return $query->row ;
    }
}

?>