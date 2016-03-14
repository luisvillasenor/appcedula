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
        function show($id_subact = null,$id_act = null) {   
            if ( isset($id_subact) || isset($id_act) ) {

                if ( isset($id_subact) ) {
                    // Si el parametro no es null, get id_subact. Devuelve UN SOLO registro.
                    $this->db->limit(1);
                    $this->db->where('id_subact',$id_subact);
                    $query = $this->db->get('subactividades');     
                    return $query->result();
                }

                if( isset($id_act) ) {
                    // Si el parametro no es null, get id_subact. Devuelte TODOS los registro de UN SOLO cedula
                    $this->db->order_by('fecha_taller','desc');
                    $this->db->order_by('hora_ini','asc');
                    $this->db->where('id_act',$id_act);
                    $query = $this->db->get('subactividades');     
                    return $query->result();
                }
            }
                else{
                    switch ($_SESSION['grupo']) {
                        case 'ortografia':
                            $this->db->order_by('status_contenido','des');
                            $this->db->order_by('status_ortografia','asc');
                            $this->db->order_by('fecha_taller','asc');
                            $this->db->order_by('hora_ini','asc');
                            $this->db->where('status_contenido','1');
                            $query = $this->db->get('subactividades');     
                            return $query->result();
                        break;
                        default:
                            $query = $this->db->get('subactividades');     
                            return $query->result();
                        break;
                    }

                }
        }

        // INSERT
        function insert($subactividad = null) {
            if ( isset($subactividad) ) {
                $this->db->insert('subactividades', $subactividad);
                return true;
            }
                else {
                    return null;
                }            
        }
        
        // UPDATE
        function update($subactividad) {
            if ( isset($subactividad) ) {
                $this->db->where('id_subact', $subactividad['id_subact']);
                $this->db->update('subactividades', $subactividad);
                return true;
            }
                else {
                    return null;
                }
        }

        // DELETE
        function delete($id_subact = null) {
            if ( isset($id_subact) ) {
                $this->db->where('id_subact', $id_subact);
                $this->db->delete('subactividades');
                return true;
            }
                else {
                    return null;
                }
        }

        // UPDATE STATUS CONTENIDO
        function update_status_contenido($status_contenido = null) {
            if ( isset($status_contenido) ) {
                $this->db->where('id_subact', $status_contenido['id_subact']);
                $this->db->update('subactividades', $status_contenido);
                return true;
            }
                else {
                    return null;
                }
        }

        // UPDATE STATUS ORTOGRAFIA
        function update_status($ortografia = null) {
            if ( isset($ortografia) ) {
                $this->db->where('id_subact', $ortografia['id_subact']);
                $this->db->update('subactividades', $ortografia);
                return true;
            }
                else {
                    return null;
                }
        }


    }

/* End of file subactividades_model.php */
/* Location: ./application/models/subactividades_model.php */