<?php
class Prioridades_model extends CI_Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
        
  }

  function get_all_prioridades(){

    $q = $this->db->get('prioridades');
    return $q->result();
  }

     
			   
}

?>