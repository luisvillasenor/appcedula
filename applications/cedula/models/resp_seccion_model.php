<?php
class Resp_seccion_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_resp_seccion = '';
    var $resp_seccion = '';
    var $voto = '';
    var $id_resp_zona = '';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }
    function get_calif()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('resp_zona.resp_zona,resp_zona.voto,count(resp_seccion.id_resp_seccion) as estructura,sum(resp_seccion.voto) as votaron,((sum(resp_seccion.voto)/count(resp_seccion.id_resp_seccion))*100) as calificacion');
        $this->db->from('resp_seccion');
        
        $this->db->join('resp_zona', 'resp_zona.id_resp_zona = resp_seccion.id_resp_zona');
        $this->db->group_by('resp_seccion.id_resp_zona');
        $query = $this->db->get();
        return $query->result();
    }
    function export_resp_zona()// Tabla que exporta a los responsables de zona
    {
        $this->db->select('resp_zona.resp_zona,resp_zona.seccion,resp_zona.voto,count(resp_seccion.id_resp_seccion) as estructura,sum(resp_seccion.voto) as votaron,((sum(resp_seccion.voto)/count(resp_seccion.id_resp_seccion))*100) as calificacion');
        $this->db->from('resp_seccion');
        $this->db->join('resp_zona', 'resp_zona.id_resp_zona = resp_seccion.id_resp_zona');
        $this->db->group_by('resp_seccion.id_resp_zona');
        $query = $this->db->get();
        return $query->result();
    }
    function get_calif_total()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('count(id_resp_seccion) as estructura,sum(voto) as votaron,((sum(voto)/count(id_resp_seccion))*100) as calificacion');
        $this->db->from('resp_seccion');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('resp_seccion');
        return $query->result();
    }
    function get_one_rz()
    {
        $res = '';
        $res = $this->resp_zona = $_POST['resp_zona'];
        $this->db->select('resp_zona.id_resp_zona,resp_zona.resp_zona,resp_zona.voto,count(resp_seccion.id_resp_seccion) as estructura,sum(resp_seccion.voto) as votaron,((sum(resp_seccion.voto)/count(resp_seccion.id_resp_seccion))*100) as calificacion');
        $this->db->from('resp_seccion');
        $this->db->join('resp_zona', 'resp_zona.id_resp_zona = resp_seccion.id_resp_zona');
        $this->db->like('resp_zona.resp_zona', $res);
        $this->db->group_by('resp_seccion.id_resp_zona');
        $query = $this->db->get();
        return $query->result();
    }
    function insert_entry()
    {
        $this->resp_seccion         = $_POST['resp_seccion'];
        $this->voto         = $_POST['voto'];
        $this->id_resp_zona    = $_POST['id_resp_zona'];

        $this->db->insert('resp_seccion', $this);
    }
    function get_rs()
    {
        $res = '';
        $res = $this->id_resp_seccion = $_POST['id_resp_seccion'];
        $this->db->select('*');
        $this->db->where('id_resp_seccion', $res);
        $this->db->order_by('resp_seccion','asc');
        $query = $this->db->get('resp_seccion');
        return $query->result();            

    }
    function update_entry()
    {
        $this->id_resp_seccion = $_POST['id_resp_seccion'];
        $this->resp_seccion    = $_POST['resp_seccion'];
        $this->folio           = $_POST['folio'];
        $this->seccion         = $_POST['seccion'];
        $this->voto            = $_POST['voto'];
        $this->id_resp_zona = $_POST['id_resp_zona'];

        $this->db->where('id_resp_seccion', $this->id_resp_seccion);
        $this->db->update('resp_seccion', $this); 

        
    }
}
?>