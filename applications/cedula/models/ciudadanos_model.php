<?php
class Ciudadanos_model extends CI_Model 
{
    // Definicion de variables iguales a los nombres de los campos de la tabla 
    var $ciud_id = '';
    var $nombre = '';
    var $apellido_p = '';
    var $apellido_m = '';
    var $sexo = '';
    var $edad = '';
    var $tel_of = '';
    var $tel_casa = '';
    var $tel_cel = '';
    var $email = '';
    var $hora = '';
    var $fecha_alta = '';
    var $num_hijos = '';
    var $domicilio = '';
    var $cp = '';
    var $capturista = '';
    var $edocivil = '';
    var $ref_id = '';
    var $sec_id = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_ciudadanos()
    {
        $query = $this->db->get('ciudadanos', 10);
        return $query->result();
    }

    function get_all_ciudadanos()
    {
        $query = $this->db->get('ciudadanos');
        return $query->result();
    }

    function get_one_ciudadano($res)
    {
        $this->db->select('*');
        $this->db->like('nombre', $res);
        $this->db->or_like('apellido_p', $res);
        $this->db->or_like('apellido_m', $res);     
        $query = $this->db->get('ciudadanos');
           
        return $query->result();
    }

    function get_ciudadano_vs_solicitud($res)
    {
        $this->db->select('ciudadanos.ciud_id as ciud_id,
            ciudadanos.nombre as nombre,
            ciudadanos.apellido_p as apellido_p,
            ciudadanos.apellido_m as apellido_m,
            ciudadanos.sexo as sexo,
            ciudadanos.edad as edad,
            ciudadanos.tel_of as tel_of,
            ciudadanos.tel_casa as tel_casa,
            ciudadanos.tel_cel as tel_cel,
            ciudadanos.email as email,
            ciudadanos.hora as hora,
            ciudadanos.fecha_alta as fecha_alta,
            ciudadanos.num_hijos as num_hijos,
            ciudadanos.domicilio as domicilio,
            ciudadanos.cp as cp,
            ciudadanos.sec_id as sec_id,
            ciudadanos.capturista as capturista,
            ciudadanos.edocivil as edocivil,
            referencias.ref_id as ref_id');
        $this->db->from('ciudadanos');
        $this->db->join('solicitudes', 'solicitudes.ciud_id = ciudadanos.ciud_id');
        $this->db->join('referencias', 'referencias.ref_id = ciudadanos.ref_id');
    
        $this->db->where('solicitudes.solicitud_id', $res);

        $query = $this->db->get();
           
        return $query->result();
    }



    function get_all_ciudadanos_orderby($campo, $by)
    {
        $query = $this->db->get('ciudadanos');
        $this->db->order_by($campo, $by);
        return $query->result();
    }

    function insert_entry()
    {
        $this->nombre     = $_POST['nombre'];
        $this->apellido_p = $_POST['apellido_p'];
        $this->apellido_m = $_POST['apellido_m'];
        $this->sexo       = $_POST['sexo'];
        $this->edad       = $_POST['edad'];
        $this->tel_of     = $_POST['tel_of'];
        $this->tel_casa   = $_POST['tel_casa'];
        $this->tel_cel    = $_POST['tel_cel'];
        $this->email      = $_POST['email'];
        $this->hora       = $_POST['hora'];
        $this->fecha_alta = date('Y-m-d H:i:s');
        $this->num_hijos  = $_POST['num_hijos'];
        $this->domicilio  = $_POST['domicilio'];
        $this->capturista = $_SESSION['username'];
        $this->edocivil   = $_POST['edocivil'];
        $this->ref_id     = $_POST['ref_id'];
        $this->sec_id     = $_POST['sec_id'];

        $this->db->insert('ciudadanos', $this);
    }

    function update_entry()
    {
        $this->ciud_id    = $_POST['ciud_id'];
        $this->nombre     = $_POST['nombre'];
        $this->apellido_p = $_POST['apellido_p'];
        $this->apellido_m = $_POST['apellido_m'];
        $this->sexo       = $_POST['sexo'];
        $this->edad       = $_POST['edad'];
        $this->tel_of     = $_POST['tel_of'];
        $this->tel_casa   = $_POST['tel_casa'];
        $this->tel_cel    = $_POST['tel_cel'];
        $this->email      = $_POST['email'];
        $this->hora       = $_POST['hora'];
        $this->fecha_alta = date('Y-m-d H:i:s');
        $this->num_hijos  = $_POST['num_hijos'];
        $this->domicilio  = $_POST['domicilio'];
        $this->capturista = $_SESSION['username'];
        $this->edocivil   = $_POST['edocivil'];
        $this->ref_id     = $_POST['ref_id'];
        $this->sec_id     = $_POST['sec_id'];

        $this->db->update('ciudadanos', $this, array('ciud_id' => $_POST['ciud_id']));
    }



}
?>