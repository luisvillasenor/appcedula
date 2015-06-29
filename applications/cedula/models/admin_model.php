<?php
class Admin_model extends CI_Model {

  function __construct()
  {
    // Call the Model constructor
    parent::__construct();
        
  }

  public function verify_user($clean_email_address, $clean_password){

    $this->db->select('*');
    $this->db->where('email_address',$clean_email_address);
    $this->db->where('password',sha1($clean_password));
    $this->db->limit(1);

    $q = $this->db->get('users');

    if ( $q->num_rows > 0 ){

      return $q->row();
    }

    return false;

  }

  public function verify_rol($clean_email_address, $clean_password){

    $this->db->select('grupo,id,id_coord');
    $this->db->where('email_address',$clean_email_address);
    $this->db->where('password',sha1($clean_password));
    $this->db->limit(1);

    $q = $this->db->get('users');

    return $q->result();

  }


  public function get_id($clean_email_address){

    $this->db->select('id');
    $this->db->where('email_address',$clean_email_address);
    $this->db->limit(1);

    $q = $this->db->get('users');

    return $q->result();

  }

  public function up_date ($clean_id) {

    $data = array('fecha_ult_acceso' => date('Y-m-d H:i:s'));
    $this->db->where('id',$clean_id);
    $this->db->update('users',$data );

  }
     
			   
}

?>