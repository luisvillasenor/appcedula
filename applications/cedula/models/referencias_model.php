<?php
class Referencias_model extends CI_Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
        
  }

  function get_all(){

    $this->db->select('*');
    $this->db->order_by('asenta','asc');
    $q = $this->db->get('referencias');

    return $q->result();
  }

     
			   
}

?>