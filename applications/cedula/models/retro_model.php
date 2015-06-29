<?php
class Retro_model extends CI_Model 
{
    // Definicion de variables iguales a los comentarios de los campos de la tabla 
    var $retro_id = '';
    var $comentario = '';
    var $fecha = '';
    var $gestor = '';
    var $solicitud_id = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_retro()
    {
        $query = $this->db->get('retro', 10);
        return $query->result();
    }

    function get_all_retro($res)
    {
        $this->db->select('*');
        $this->db->where('solicitud_id', $res);
        $this->db->order_by('retro_id','desc');
        $query = $this->db->get('retro');

        return $query->result();
    }

    function get_one_retro($res)
    {
        $this->db->select('*');
        $this->db->where('retro_id', $res);
             
        $query = $this->db->get('retro');
           
        return $query->result();
    }

    function haySeguimiento($solicitud_id)
    {
        $query = $this->db->select('count(solicitud_id) as total');
        $this->db->where('solicitud_id',$solicitud_id);
        $this->db->group_by($solicitud_id);

        $this->db->get('solicitudes');

        if ( $query < 1 ) {
            return false;
        } else {
            return true;
        }
    }

    function insert_entry()
    {
        $this->comentario   = $_POST['comentario'];
        $this->fecha        = date('Y-m-d H:i:s');
        $this->gestor       = $_SESSION['username'];
        $this->solicitud_id = $_POST['solicitud_id'];

        $this->db->insert('retro', $this);
    }

    function update_entry()
    {
        $this->retro_id       = $_POST['retro_id'];
        $this->comentario   = $_POST['comentario'];
        $this->fecha        = date('Y-m-d H:i:s');
        $this->gestor       = $_SESSION['username'];
        $this->solicitud_id = $_POST['solicitud_id'];

        $this->db->update('retro', $this, array('retro_id' => $_POST['retro_id']));
    }


    function get_hist_retros()
    {
        $this->db->select('fecha,gestor,comentario,solicitud_id');
        $query = $this->db->get('retro');
        return $query->result();
    }


}
?>