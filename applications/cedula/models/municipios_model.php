<?php
    class Municipios_model extends CI_Model 
    {
	   var $municipio_id = '';
           var $abreviacion = '';
	   var $municipio = '';
	   var $estado_id = '';

         function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

        function get_all() {

                      
           $query = $this->db->get('municipios');

           return $query->result();
        }

        function get_ags()
        {
          $this->db->where("estado_id","1");

          $this->db->order_by("municipio","asc");
          
          $query = $this->db->get("municipios");

          return $query->result();
        }
			   
    }
?>