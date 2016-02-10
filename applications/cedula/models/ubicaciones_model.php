<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ubicaciones_model extends CI_Model 
    {
	   var $id_ubic = '';
       var $id_sede = '';
       var $id_mun = '';
	   var $ubicacion = '';
       var $status_ubicacion = '';

        function __construct() {
            // Call the Model constructor
            parent::__construct();
            #$this->load->database();
        }

        // SELECT
        function show($id_ubic = null, $id_mun = null) {   
            if ( isset($id_ubic) || isset($id_mun) ) {
                // Si el parametro no es null, get id_ubic
                if ( isset($id_ubic) ) {
                    $this->db->where('id_ubic',$id_ubic);
                    $this->db->limit(1);
                    $query = $this->db->get('ubicaciones');     
                    return $query->result();
                }
                    // Si el parametro no es null, get id_mun
                    elseif ( isset($id_mun) ) {
                        $this->db->where('id_mun',$id_mun);
                        $query = $this->db->get('ubicaciones');     
                        return $query->result();
                    }             
            }
                else {
                    $query = $this->db->get('ubicaciones');     
                    return $query->result();                    
                }
        }

        // INSERT
        function insert($ubicacion = null) {
            if ( isset($ubicacion) ) {
                $this->db->insert('ubicaciones', $ubicacion);
                return $this->db->insert_id();
            }
                else {
                    return null;
                }            
        }
        
        // UPDATE
        function update($ubicacion = null) {
            if ( isset($ubicacion) ) {
                $this->db->where('id_ubic', $ubicacion['id_ubic']);
                $this->db->update('ubicaciones', $ubicacion);
                return $ubicacion['id_ubic'];
            }
                else {
                    return null;
                }
        }
    }

/* End of file ubicaciones_model.php */
/* Location: ./application/models/ubicaciones_model.php */