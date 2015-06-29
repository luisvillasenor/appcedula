<?php
class Coordinadores_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_coord = '';
    var $coordinacion = '';
    var $id_fc = 4;
    var $id_resp = '';
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

function get_all()
    {
        $query = $this->db->get('coordinadores');
        return $query->result();
    }
    
    function get_all_coords()
    {
        $query = $this->db->get('coordinadores');
        return $query->result();
    }
    function get_one_co()
    {
        $res = '';
        $res = $this->coordinador = $_POST['coordinador'];
        $this->db->select('*');
        $this->db->like('coordinador', $res);
        $query = $this->db->get('coordinadores');
        return $query->result();
    }
    function get_co()
    {
        $res = '';
        $res = $this->id_coord = $_POST['id_coord'];
        $this->db->select('*');
        $this->db->where('id_coord', $res);
        $this->db->order_by('coordinador','asc');
        $query = $this->db->get('coordinadores');
        return $query->result();            

    }

    function search_coordinador($texto)
    {
        $this->db->select('*');
        $this->db->from('coordinadores');
        $this->db->like('voto', $texto);
        $query = $this->db->get();
        return $query->result();
    }

    function search_coordinador2($coordinador)
    {
        $this->db->select('*');
        $this->db->from('coordinadores');
        $this->db->like('coordinador', $coordinador);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_coordinador()
    {
        $query = $this->db->get('coordinadores');
        return $query->result();
    }

    function get_one_coord_edit($id_coord)
        {   
            $this->db->select('*');
            $this->db->where('id_coord', $id_coord);
            $query = $this->db->get('coordinadores');
            return $query->result();
        }

    function insert_entry($coordinacion,$id_resp)
    {
        $this->coordinacion = strtoupper($coordinacion);
        $this->id_resp = $id_resp;
        $this->id_fc = '4';
        
        $this->db->insert('coordinadores', $this);
    }

    function update_entry($id_coord,$coordinacion,$id_resp)
    {
        $this->id_fc = '4';
        $this->id_coord = $id_coord;
        $this->id_resp  = $id_resp;
        $this->coordinacion = strtoupper($coordinacion);
                
        $this->db->where('id_coord', $this->id_coord);
        $this->db->update('coordinadores', $this);
    }

    

}
?>