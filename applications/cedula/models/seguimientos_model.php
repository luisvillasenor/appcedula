<?php
class Seguimientos_model extends CI_Model 
{
    // Definicion de variables iguales a los comentarios de los campos de la tabla 
    var $seg_id = '';
    var $comentario = '';
    var $fecha = '';
    var $gestor = '';
    var $solicitud_id = '';
    var $tipo_seg = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_seguimientos()
    {
        $query = $this->db->get('seguimientos', 10);
        return $query->result();
    }

    function get_all_seguimientos($res)
    {
        $this->db->select('*');
        $this->db->where('solicitud_id', $res);
        $this->db->order_by('seg_id','desc');
        $query = $this->db->get('seguimientos');

        return $query->result();
    }

    function get_num_seg($res)
    {
        $this->db->where('solicitud_id', $res);        
        $query = $this->db->count_all_results('seguimientos');

        return $query;
    }

    function get_hist_seguimientos()
    {
        $this->db->select('fecha,gestor,comentario,solicitud_id');
        $query = $this->db->get('seguimientos');
        return $query->result();
    }


    function get_one_seguimiento($res)
    {
        $this->db->select('*');
        $this->db->where('seg_id', $res);
             
        $query = $this->db->get('seguimientos');
           
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
        $this->tipo_seg     = $_POST['tipo_seg'];

        $this->db->insert('seguimientos', $this);
    }

    // Inserta un seguimiento automatico cuando dep_id pasa de 0 a diferente de cero
    function insert_auto_entry($res)
    {
        $this->comentario   = 'SOLICITUD '.$res.' ACTUALIZADA EN SU CAMPO DE ASIGNACIÓN A UNA DEPENDENCIA.';
        $this->fecha        = date('Y-m-d H:i:s');
        $this->gestor       = $_SESSION['username'];
        $this->solicitud_id = $res;
        $this->tipo_seg     = '0';

        $this->db->insert('seguimientos', $this);
    }

    function update_entry()
    {
        $this->seg_id       = $_POST['seg_id'];
        $this->comentario   = $_POST['comentario'];
        $this->fecha        = date('Y-m-d H:i:s');
        $this->gestor       = $_SESSION['username'];
        $this->solicitud_id = $_POST['solicitud_id'];
        $this->tipo_seg     = $_POST['tipo_seg'];

        $this->db->update('seguimientos', $this, array('seg_id' => $_POST['seg_id']));
    }


    function get_last_id($res)
    {
        $this->db->select('MAX(seg_id) as seg_id');
        $this->db->where('solicitud_id',$res);
        $this->db->limit(1);

        $query = $this->db->get('seguimientos');

        foreach ($query->result() as $row) {
            # code...
            $last_id = $row->seg_id;
        }
        
        return $last_id;
    }

    function get_last_tipo($res)
    {
        $this->db->select('tipo_seg');
        $this->db->order_by('seg_id','desc');
        $this->db->where('solicitud_id',$res);
        $this->db->limit(1);

        $query = $this->db->get('seguimientos');

        foreach ($query->result() as $row) {
            # code...
            $last_id = $row->tipo_seg;
        }
        
        return $last_id;
    }

}
?>