<?php
class Users_model extends CI_Model 
{
    // Definicion de variables iguales a los nombres de los campos de la tabla 
    var $id = '';
    var $nombre = '';
    var $apellido = '';
    var $email_address = '';
    var $email_notify = '';
    var $password = '';
    var $fecha_creacion = '';
    var $fecha_ult_acceso = '';
    var $grupo = '';
    var $id_coord = '';
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_users()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }

    function get_all_users()
    {
        $by = 'DESC';
        $this->db->order_by('fecha_ult_acceso', $by);
        $query = $this->db->get('users');        
        return $query->result();
    }
    function get_one_usr_edit($id){
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->result();
    }

    function get_one_ciudadano($res)
    {
        $this->db->select('*');
        $this->db->like('nombre', $res);
        $this->db->or_like('apellido', $res);     
        $query = $this->db->get('users');
           
        return $query->result();
    }


    function get_all_users_orderby($campo, $by)
    {
        $query = $this->db->get('users');
        $this->db->order_by($campo, $by);
        return $query->result();
    }

    function insert_entry()
    {
        $this->nombre           = $_POST['nombre'];
        $this->apellido         = $_POST['apellido'];
        $this->email_address    = $_POST['email_address'];
        $this->email_notify    = $_POST['email_notify'];        
        $this->password         = sha1($_POST['password']);
        $this->fecha_creacion   = date('Y-m-d H:i:s');
        $this->fecha_ult_acceso = date('Y-m-d H:i:s');
        $this->grupo            = $_POST['grupo'];
        $this->id_coord         = $_POST['id_coord'];

        $this->db->insert('users', $this);
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

        $this->db->update('users', $this, array('id' => $id));
    }



}
?>