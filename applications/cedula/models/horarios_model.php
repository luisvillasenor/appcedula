<?php
    class Horarios_model extends CI_Model 
    {
	   var $horario = '';
       

        function __construct()
        {
            // Call the Model constructor
            parent::__construct();
            $this->load->database();
        }
    
        function get_horarios() 
        {
           $this->db->order_by('horario','asc');
           $query = $this->db->get('horarios');
           return $query->result();
        }
			   
    }
?>