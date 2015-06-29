<?php
class Secciones_model extends CI_Model 
{
    // Definicion de variables iguales a los seccions de los campos de la tabla 
    var $sec_id = '';
    var $seccion = '';
    var $fecha = '';
    var $gestor = '';
    var $dis_id = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_secciones()
    {
        $query = $this->db->get('secciones', 10);
        return $query->result();
    }

    function get_all_secciones()
    {
        $this->db->select('*');
        $this->db->order_by('seccion','asc');
        $query = $this->db->get('secciones');

        return $query->result();
    }

    function get_one_secciones($res)
    {
        $this->db->select('*');
        $this->db->where('sec_id', $res);
             
        $query = $this->db->get('secciones');
           
        return $query->result();
    }

    function haySeguimiento($dis_id)
    {
        $query = $this->db->select('count(dis_id) as total');
        $this->db->where('dis_id',$dis_id);
        $this->db->group_by($dis_id);

        $this->db->get('solicitudes');

        if ( $query < 1 ) {
            return false;
        } else {
            return true;
        }
    }

    function insert_entry()
    {
        $this->seccion   = $_POST['seccion'];
        $this->dis_id = $_POST['dis_id'];

        $this->db->insert('secciones', $this);
    }

    function update_entry()
    {
        $this->sec_id       = $_POST['sec_id'];
        $this->seccion   = $_POST['seccion'];
        $this->dis_id = $_POST['dis_id'];

        $this->db->update('secciones', $this, array('sec_id' => $_POST['sec_id']));
    }



}
?>