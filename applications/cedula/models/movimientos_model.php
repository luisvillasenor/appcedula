<?php
class Movimientos_model extends CI_Model 
{
    // Definicion de variables iguales a los nombres de los campos de la tabla 
    var $id_mov = '';
    var $id_act = '';
    var $fecha_alta = '';
    var $quien = '';
    var $tipo = '';
    var $monto = '';
    var $comentario = '';
    var $fecha_ult_mod = '';    
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    function get_last_ten_users()
    {
        $query = $this->db->get('movimientos', 10);
        return $query->result();
    }

    function get_all_movs($id_act)
    {
        $by = 'DESC';
        $this->db->where('id_act', $id_act);
        $this->db->order_by('fecha_alta', $by);
        $query = $this->db->get('movimientos');        
        return $query->result();
    }
    function get_one_usr_edit($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('movimientos');
        return $query->result();
    }

    function get_one_ciudadano($res)
    {
        $this->db->select('*');
        $this->db->like('nombre', $res);
        $this->db->or_like('apellido', $res);     
        $query = $this->db->get('movimientos');
           
        return $query->result();
    }


    function get_all_users_orderby($campo, $by)
    {
        $query = $this->db->get('movimientos');
        $this->db->order_by($campo, $by);
        return $query->result();
    }

    function insert_entry($tipo_mov, $monto_mov, $comm_mov, $e_mail, $id_act)
    {
        $this->tipo          = $tipo_mov;
        $this->id_act        = $id_act;
        $this->monto         = $monto_mov;
        $this->comentario    = $comm_mov;
        $this->quien         = $e_mail;        
        $this->fecha_alta    = date('Y-m-d H:i:s');
        $this->fecha_ult_mod = date('Y-m-d H:i:s');        

        $this->db->insert('movimientos', $this);
    }

    function update_entry($id,$nombre,$apellido,$email_address,$email_notify,$password,$fecha_creacion,$grupo,$id_coord) 
    {
        $this->id               = $id;
        $this->nombre           = $nombre;
        $this->apellido         = $apellido;
        $this->email_address    = $email_address;
        $this->email_notify     = $email_notify;
        $this->password         = $password;
        $this->fecha_creacion   = $fecha_creacion;
        $this->fecha_ult_acceso = date('Y-m-d H:i:s');
        $this->grupo            = $grupo;
        $this->id_coord         = $id_coord;

        $this->db->update('movimientos', $this, array('id' => $id));
    }



}
?>