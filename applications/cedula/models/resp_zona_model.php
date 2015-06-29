<?php
class Resp_zona_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_resp_zona = '';
    var $resp_zona = '';
    var $voto = '';
    var $id_coord = '';
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }
    function get_calif()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('coordinadores.id_coord,coordinadores.coordinador,coordinadores.voto,count(resp_zona.id_resp_zona) as estructura,sum(resp_zona.voto) as votaron,((sum(resp_zona.voto)/count(resp_zona.id_resp_zona))*100) as calificacion');
        $this->db->from('resp_zona');
      
        $this->db->join('coordinadores', 'coordinadores.id_coord = resp_zona.id_coord');
        $this->db->group_by('resp_zona.id_coord');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all()
    {
        
        $query = $this->db->get('resp_zona');
        return $query->result();
    }
    function get_one_co()
    {
        $res = '';
        $res = $this->coordinador = $_POST['coordinador'];
        $this->db->select('coordinadores.id_coord,coordinadores.coordinador,coordinadores.voto,count(resp_zona.id_resp_zona) as estructura,sum(resp_zona.voto) as votaron,((sum(resp_zona.voto)/count(resp_zona.id_resp_zona))*100) as calificacion');
        $this->db->from('resp_zona');
        $this->db->join('coordinadores', 'coordinadores.id_coord = resp_zona.id_coord');
        $this->db->like('coordinadores.coordinador', $res);
        $this->db->group_by('resp_zona.id_coord');
        $query = $this->db->get();
        return $query->result();
    }
    function insert_entry()
    {
        $this->folio        = $_POST['folio'];
        $this->seccion      = $_POST['seccion'];
        $this->resp_zona    = $_POST['resp_zona'];
        $this->voto         = $_POST['voto'];
        $this->id_coord     = $_POST['id_coord'];

        $this->db->insert('resp_zona', $this);
    }
    function get_rz()
    {
        $res = '';
        $res = $this->id_resp_zona = $_POST['id_resp_zona'];
        $this->db->select('*');
        $this->db->where('id_resp_zona', $res);
        $this->db->order_by('resp_zona','asc');
        $query = $this->db->get('resp_zona');
        return $query->result();            

    }
    function update_entry()
    {
        $this->id_resp_zona = $_POST['id_resp_zona'];
        $this->resp_zona    = $_POST['resp_zona'];
        $this->folio        = $_POST['folio'];
        $this->seccion      = $_POST['seccion'];
        $this->voto         = $_POST['voto'];
        $this->id_coord     = $_POST['id_coord'];

        $this->db->where('id_resp_zona', $this->id_resp_zona);
        $this->db->update('resp_zona', $this); 

        
    }
}
?>