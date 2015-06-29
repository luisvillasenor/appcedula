<?php
class Clasificados_model extends CI_Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
        
  }

  function get_all_clasificados(){

    $q = $this->db->get('clasificados');
    return $q->result();
  }

     
			   
}

?>