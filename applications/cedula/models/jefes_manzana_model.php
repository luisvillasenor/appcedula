<?php
class Jefes_manzana_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_jefe_manzana = '';
    var $jefe_manzana = '';
    var $voto = '';
    var $id_resp_seccion = '';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }
    function get_calif()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('resp_seccion.resp_seccion,resp_seccion.voto,count(jefes_manzana.id_jefe_manzana) as estructura,sum(jefes_manzana.voto) as votaron,((sum(jefes_manzana.voto)/count(jefes_manzana.id_jefe_manzana))*100) as calificacion');
        $this->db->from('jefes_manzana');
        
        $this->db->join('resp_seccion', 'resp_seccion.id_resp_seccion = jefes_manzana.id_resp_seccion');
        $this->db->group_by('jefes_manzana.id_resp_seccion');
        $query = $this->db->get();
        return $query->result();
    }
    function export_jefes_manzana()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('resp_seccion.resp_seccion,resp_seccion.seccion,resp_seccion.voto,count(jefes_manzana.id_jefe_manzana) as estructura,sum(jefes_manzana.voto) as votaron,((sum(jefes_manzana.voto)/count(jefes_manzana.id_jefe_manzana))*100) as calificacion');
        $this->db->from('jefes_manzana');
        $this->db->join('resp_seccion', 'resp_seccion.id_resp_seccion = jefes_manzana.id_resp_seccion');
        $this->db->group_by('jefes_manzana.id_resp_seccion');
        $query = $this->db->get();
        return $query->result();
    }
    function get_calif_total()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('count(id_jefe_manzana) as estructura,sum(voto) as votaron,((sum(voto)/count(id_jefe_manzana))*100) as calificacion');
        $this->db->from('jefes_manzana');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all()
    {
        $this->db->order_by('jefe_manzana','asc');
        $query = $this->db->get('jefes_manzana');
        return $query->result();
    }
    function get_one_rs()
    {
        $res = '';
        $res = $this->resp_seccion = $_POST['resp_seccion'];
        $this->db->select('resp_seccion.id_resp_seccion,resp_seccion.resp_seccion,resp_seccion.voto,count(jefes_manzana.id_jefe_manzana) as estructura,sum(jefes_manzana.voto) as votaron,((sum(jefes_manzana.voto)/count(jefes_manzana.id_jefe_manzana))*100) as calificacion');
        $this->db->from('jefes_manzana');
        $this->db->join('resp_seccion', 'resp_seccion.id_resp_seccion = jefes_manzana.id_resp_seccion');
        $this->db->like('resp_seccion.resp_seccion', $res);
        $this->db->group_by('jefes_manzana.id_resp_seccion');
        $query = $this->db->get();
        return $query->result();
    }
    function insert_entry()
    {
        $this->jefe_manzana    = $_POST['jefe_manzana'];
        $this->folio           = $_POST['folio'];
        $this->seccion         = $_POST['seccion'];
        $this->voto            = $_POST['voto'];
        $this->id_resp_seccion = $_POST['id_resp_seccion'];

        $this->db->insert('jefe_manzana', $this);
    }
    function get_jm()
    {
        $res = '';
        $res = $this->id_jefe_manzana = $_POST['id_jefe_manzana'];
        $this->db->select('*');
        $this->db->where('id_jefe_manzana', $res);
        $this->db->order_by('jefe_manzana','asc');
        $query = $this->db->get('jefes_manzana');
        return $query->result();            

    }
    function update_entry()
    {
        $this->id_jefe_manzana = $_POST['id_jefe_manzana'];
        $this->jefe_manzana    = $_POST['jefe_manzana'];
        $this->folio           = $_POST['folio'];
        $this->seccion         = $_POST['seccion'];
        $this->voto            = $_POST['voto'];
        $this->id_resp_seccion = $_POST['id_resp_seccion'];

        $this->db->where('id_jefe_manzana', $this->id_jefe_manzana);
        $this->db->update('jefes_manzana', $this); 

        
    }
}
?>