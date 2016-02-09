<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sedes_model extends CI_Model 
    {
	   var $id_sede = '';
       var $id_mun = '';
	   var $sede = '';
       var $status_sede = '';

        function __construct() {
            // Call the Model constructor
            parent::__construct();
            #$this->load->database();
        }

        // SELECT
        function show($id_sede = null, $id_mun = null) {   
            if ( isset($id_sede) || isset($id_mun) ) {
                // Si el parametro no es null, get id_sede
                if ( isset($id_sede) ) {
                    $this->db->where('id_sede',$id_sede);
                    $this->db->limit(1);
                    $query = $this->db->get('sedes');     
                    return $query->result();
                }
                    // Si el parametro no es null, get id_mun
                    elseif ( isset($id_mun) ) {
                        $this->db->where('id_mun',$id_mun);
                        $query = $this->db->get('sedes');     
                        return $query->result();
                    }             
            }
                else {
                    $query = $this->db->get('sedes');     
                    return $query->result();                    
                }
        }

        // INSERT
        function insert($sede = null) {
            if ( isset($sede) ) {
                $this->db->insert('sedes', $sede);
                return $this->db->insert_id();
            }
                else {
                    return null;
                }            
        }
        
        // UPDATE
        function update($sede = null) {
            if ( isset($sede) ) {
                $this->db->where('id_sede', $sede['id_sede']);
                $this->db->update('sedes', $sede);
                return $sede['id_sede'];
            }
                else {
                    return null;
                }
        }
    }

/* End of file sedes_model.php */
/* Location: ./application/models/sedes_model.php */