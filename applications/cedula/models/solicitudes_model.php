<?php
class Solicitudes_model extends CI_Model 
{
    // Definicion de variables iguales a los necesidads de los campos de la tabla 
    var $solicitud_id = '';
    var $fecha = '';
    var $fecha_alta = '';
    var $necesidad = '';
    var $tipo_id = '';
    var $prioridad_id = '';
    var $ciud_id = '';
    var $status_id = '';
    var $dep_id = '';
    var $origen = '';
    var $capturista = '';
    
    

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_solicitudes()
    {
        $query = $this->db->get('solicitudes', 10);
        return $query->result();
    }

    function get_all_solicitudes()
    {
        $this->db->order_by('solicitud_id','desc');
        $query = $this->db->get('solicitudes');
        return $query->result();
    }


    function get_tot_sol()
    {

        $this->db->select('count(*)');
        $q = $this->db->get('solicitudes');

            if ( $q->num_rows > 0 ){

              return $q->row();

            }

        return false;

    }

    function get_hist_solicitudes()
    {
        $this->db->select('solicitud_id,solicitudes.fecha as fecha_sol,tipo_id,necesidad,ciudadanos.nombre,
            ciudadanos.apellido_p,ciudadanos.apellido_m,ciudadanos.tel_of,ciudadanos.tel_casa,
            ciudadanos.tel_cel,ciudadanos.domicilio,status_id,dep_id,
            referencias.asenta,referencias.cp');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');

        $query = $this->db->get('solicitudes');
        return $query->result();
    }

    function get_one_solicitud($res)
    {
        $this->db->select('*');
        $this->db->where('solicitud_id', $res);
            
        $query = $this->db->get('solicitudes');
           
        return $query->result();
    }

    function get_solicitud_vs_ciudadano($res)
    {
        $this->db->select('solicitudes.solicitud_id as solicitud_id,
            solicitudes.fecha as fecha,
            solicitudes.tipo_id as tipo_id,
            solicitudes.status_id as status_id,
            solicitudes.ciud_id as ciud_id,
            solicitudes.prioridad_id as prioridad_id,
            solicitudes.dep_id as dep_id,
            ciudadanos.sec_id as sec_id,
            solicitudes.necesidad as necesidad,
            solicitudes.origen as origen');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos', 'ciudadanos.ciud_id = solicitudes.ciud_id');
    
        $this->db->like('ciudadanos.nombre', $res);
        $this->db->or_like('ciudadanos.apellido_p', $res);
        $this->db->or_like('ciudadanos.apellido_m', $res);

        $query = $this->db->get();
           
        return $query->result();
    }

    function get_all_solicitudes_orderby($campo, $by)
    {
        $query = $this->db->get('solicitudes');
        $this->db->order_by($campo, $by);
        return $query->result();
    }

    function insert_entry()
    {
        $this->fecha        = $_POST['fecha'];
        $this->fecha_alta   = date('Y-m-d H:i:s');
        $this->necesidad    = $_POST['necesidad'];
        $this->tipo_id      = $_POST['tipo_id'];
        $this->prioridad_id = $_POST['prioridad_id'];
        $this->ciud_id      = $_POST['ciud_id'];
        $this->origen       = $_POST['origen'];
        $this->capturista   = $_SESSION['username'];
        
        
        $this->db->insert('solicitudes', $this);
    }

    function update_entry()
    {
        $this->solicitud_id = $_POST['solicitud_id'];
        $this->fecha        = $_POST['fecha'];
        $this->fecha_alta   = date('Y-m-d H:i:s');
        $this->necesidad    = $_POST['necesidad'];
        $this->tipo_id      = $_POST['tipo_id'];
        $this->prioridad_id = $_POST['prioridad_id'];
        $this->ciud_id      = $_POST['ciud_id'];
        $this->status_id    = $_POST['status_id'];
        $this->dep_id       = $_POST['dep_id'];
        $this->origen       = $_POST['origen'];    
        $this->capturista   = $_SESSION['username'];    

        $this->db->update('solicitudes', $this, array('solicitud_id' => $_POST['solicitud_id']));
    }


    function get_dep($res)
    {
        $this->db->select('dep_id');
        $this->db->where('solicitud_id',$res);
        $this->db->limit(1);
        $query = $this->db->get('solicitudes');
        
        return $query->result();
    }


    function update_status_ini($res) //  ABIERTO
    {
        $data = array('status_id' => '0');
        $this->db->where('solicitud_id',$res);
        $this->db->update('solicitudes',$data );    
    }

    function update_status_att($res) // ATENDIDO
    {
         $data = array('status_id' => '1');
        $this->db->where('solicitud_id',$res);
        $this->db->update('solicitudes',$data );    
    }

    function update_status_pro($res) // PROCESO
    {
        $data = array('status_id' => '2');
        $this->db->where('solicitud_id',$res);
        $this->db->update('solicitudes',$data );
    }

    function update_status_can($res) // CANALIZADO
    {
        $data = array('status_id' => '3');
        $this->db->where('solicitud_id',$res);
        $this->db->update('solicitudes',$data );
    }

    function get_last_id($res)
    {
        $this->db->select('MAX(solicitud_id) as solicitud_id');
        $this->db->where('solicitud_id',$res);
        $this->db->limit(1);

        $query = $this->db->get('solicitudes');

        foreach ($query->result() as $row) {
            # code...
            $last_id = $row->solicitud_id;
        }
        
        return $last_id;
    }


    ////////////////////    QUERYS PARA LOS REPORTES     ////////////////////////

    // Total de Solicitudes del Distrito XIV ( dis_id = 1 )
    function total_soli_dist(){

        $this->db->select('distritos.distrito,count(solicitudes.solicitud_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');
        $this->db->join('secciones','secciones.sec_id = referencias.sec_id');
        $this->db->join('distritos','distritos.dis_id = secciones.dis_id');
        $this->db->group_by('distritos.dis_id');
        //$this->db->where('solicitudes.ciud_id',1);

        $query = $this->db->get();

        return $query->result();

    }

    // Total de Solicitudes por Secciones del Distrito XIV ( dis_id = 1 )
    function total_soli_sec(){

        $this->db->select('secciones.seccion ,count(solicitudes.solicitud_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');
        $this->db->join('secciones','secciones.sec_id = ciudadanos.sec_id');
        $this->db->join('distritos','distritos.dis_id = secciones.dis_id');
        $this->db->group_by('secciones.sec_id');
        //$this->db->where('solicitudes.ciud_id',1);

        $query = $this->db->get();

        return $query->result();

    }


    // Total de Solicitudes por Referencia de cada Secciones del Distrito XIV ( dis_id = 1 )
    function total_soli_ref(){

        $this->db->select('referencias.asenta ,count(solicitudes.solicitud_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');
        $this->db->join('secciones','secciones.sec_id = ciudadanos.sec_id');
        $this->db->join('distritos','distritos.dis_id = secciones.dis_id');
        $this->db->group_by('referencias.ref_id');
        //$this->db->where('solicitudes.ciud_id',1);

        $query = $this->db->get();

        return $query->result();

    }


    ////////////////////    QUERYS PARA EL MONITOREO     ////////////////////////

    // Total de Solicitudes ATENDIDAS
    function monitoreo_status(){

        $this->db->select('status_id,count(status_id) as total');
        $this->db->from('solicitudes');
        $this->db->group_by('status_id');
        //$this->db->where('solicitudes.status_id',1);

        $query = $this->db->get();

        return $query->result();

    }

    // Total de Solicitudes por Secciones del Distrito XIV ( dis_id = 1 )
    function moni_status_sec(){

        $this->db->select('secciones.seccion,solicitudes.status_id as status_id ,count(solicitudes.status_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');
        $this->db->join('secciones','secciones.sec_id = ciudadanos.sec_id');
        $this->db->join('distritos','distritos.dis_id = secciones.dis_id');
        $this->db->group_by('secciones.seccion');
        $this->db->group_by('solicitudes.status_id');
        //$this->db->where('solicitudes.ciud_id',1);

        $query = $this->db->get();

        return $query->result();

    }


    // Total de Solicitudes por Referencia de cada Secciones del Distrito XIV ( dis_id = 1 )
    function moni_status_ref(){

        $this->db->select('secciones.seccion,referencias.asenta,solicitudes.status_id as status_id ,count(solicitudes.status_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('ciudadanos','ciudadanos.ciud_id = solicitudes.ciud_id');
        $this->db->join('referencias','referencias.ref_id = ciudadanos.ref_id');
        $this->db->join('secciones','secciones.sec_id = ciudadanos.sec_id');
        $this->db->join('distritos','distritos.dis_id = secciones.dis_id');
        $this->db->group_by('secciones.seccion');
        $this->db->group_by('referencias.asenta');
        $this->db->group_by('solicitudes.status_id');
        //$this->db->where('solicitudes.ciud_id',1);

        $query = $this->db->get();

        return $query->result();

    }


    // Total de Solicitudes por Tipo de Gestion
    function moni_status_clas(){

        $this->db->select('clasificados.tipo,solicitudes.status_id as status_id ,count(solicitudes.status_id) as total');
        $this->db->from('solicitudes');
        $this->db->join('clasificados','clasificados.tipo_id = solicitudes.tipo_id');
        $this->db->group_by('clasificados.tipo');
        $this->db->group_by('solicitudes.status_id');

        $query = $this->db->get();

        return $query->result();

    }



}
?>