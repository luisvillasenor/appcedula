<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subactividades_model extends CI_Model 
    {
	   var $id_subact = '';
       var $id_act = '';
       var $subactividad = '';
       var $fecha_taller = '';
       var $sede = '';
       var $ubicacion = '';
       var $hora_ini = '';
       var $hora_fin = '';
       var $status_subact = '';

        function __construct() {
            // Call the Model constructor
            parent::__construct();
            #$this->load->database();
        }

        // SELECT
        function show($id_act = null) {   
            if ( isset($id_act) ) {
                // Si el parametro no es null, get id_subact
                $this->db->where('id_act',$id_act);
                $query = $this->db->get('subactividades');     
                return $query->result();
            }
             
            $query = $this->db->get('subactividades');     
            return $query->result();                    
             
        }

        // INSERT
        function insert($subactividad = null) {
            if ( isset($subactividad) ) {
                $this->db->insert('subactividades', $subactividad);
                return $this->db->insert_id();
            }
                else {
                    return null;
                }            
        }
        
        // UPDATE
        function update() {
            if ( isset($subactividad) ) {
                $this->db->where('id_subact', $subactividad['id_subact']);
                $this->db->update('subactividades', $subactividad);
                return $subactividad['id_subact'];
            }
                else {
                    return null;
                }
        }

        // COPY
        function cpy() {
            if ( isset($subactividad) ) {
                $this->db->where('id_subact', $subactividad['id_subact']);
                $this->db->update('subactividades', $subactividad);
                return $subactividad['id_subact'];
            }
                else {
                    return null;
                }
        }

        // DELETE
        function delete($id_subact = null) {
            if ( isset($id_subact) ) {
                $this->db->where('id_subact', $id_subact);
                $this->db->delete('subactividades', $subactividad);
                return $id_subact;
            }
                else {
                    return null;
                }
        }
    }

/* End of file subactividades_model.php */
/* Location: ./application/models/subactividades_model.php */