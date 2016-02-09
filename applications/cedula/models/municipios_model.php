<?php
    class Municipios_model extends CI_Model 
    {
      var $id_mun = '';
	    var $municipio = '';
	   
      function __construct(){
        // Call the Model constructor
        parent::__construct();        
      }

      function show($id_mun = null) {   
      // Si el parametro no es null, get id_mun
      if ( isset($id_mun) ) {
          $this->db->where('id_mun',$id_mun);
          $this->db->limit(1);
          $query = $this->db->get('municipios');     
          return $query->result();
      }
          // Si el parametro es null, get all
          else {
              $query = $this->db->get('municipios');     
              return $query->result();                    
          }            
      }
         


    }
?>