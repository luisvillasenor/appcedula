<?php
class Actividades_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_act = '';
    var $status_cedula = '';
    var $e_mail = '';
    var $actividad = '';
    var $descripcion = '';
    var $justificacion = '';
    var $id_categoria = '';
    var $quienpropone = '';
    var $empresa = '';
    var $puesto = '';
    var $domicilio = '';
    var $telefono = '';
    var $email = '';
    var $web = '';
    var $fecha_act = '';
    var $fecha_aut = '';
    var $costo_secture = '';
    var $costo_publico = '';
    var $is_costo_secture = '';
    var $is_costo_publico = '';
    var $ubicacion  = '';
    var $id_coord  = '';
    var $d1  = '';
    var $d2  = '';
    var $d3  = '';
    var $d4  = '';
    var $d5  = '';
    var $d6  = '';
    var $d7  = '';
    var $d8  = '';
    var $d9  = '';
    var $d10  = '';
    var $hora_ini  = '';
    var $hora_fin  = '';
    var $id_resp = '';
    var $id_fc = '';
    var $status_act = '';
    var $fecha_alta = '';
    var $fecha_ult_modificacion = '';
    var $pres_ant = '';
    var $pres_aut = '';
    var $pres_eje = '';
    var $pres_soli = '';

    
    
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->database();
        define("ACTIVIDADES", "actividades");

    }
    
        
    function get_all($e_mail)
    {
        switch ($_SESSION['grupo']) {
          case 'administrador':
            $query = $this->db->get(ACTIVIDADES);
            break;
          default:
            $this->db->select('*');
            $this->db->where('e_mail', $e_mail);
            $this->db->like('actividad', $txt);
            $query = $this->db->get(ACTIVIDADES);
            break;
        }

        if ( $query->num_rows > 0 ){
          return $query->result();  
        }
        return false;
    }
    
    /** Obtiene  **/
    function get_pres_ant($id_act)
    {
        $this->db->select('pres_ant');
        $this->db->where('id_act', $id_act);
        $this->db->limit(1);
        $query = $this->db->get(ACTIVIDADES);
          
        return $query->result();        
    }
    
    function get_all_actividades($e_mail,$grupo,$id_coord,$edicion)
    {
                
        switch ($grupo) {
          case 'administrador':
            $this->db->where('id_fc', $edicion);
            $this->db->order_by('actividad','ASC');
            $query = $this->db->get(ACTIVIDADES);        
            break;
          case 'coordinador':
            $this->db->where('id_fc', $edicion);
            $this->db->where('id_coord', $id_coord);
            $this->db->or_where('e_mail', $e_mail);
            $query = $this->db->get(ACTIVIDADES);        
            break;
          case 'gestor':
            $this->db->where('id_fc', $edicion);
            $this->db->where('e_mail', $e_mail);
            $query = $this->db->get(ACTIVIDADES);        
            break;
          case 'presupuesto':
            $this->db->where('id_fc', $edicion);
            $query = $this->db->get(ACTIVIDADES);        
            break;
        }         
        
        return $query->result();
    }
    function get_resp($e_mail,$grupo,$id_coord)
    {
                
        switch ($grupo) {
              case 'administrador':
                $this->db->group_by('e_mail');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->select('e_mail');
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $this->db->group_by('e_mail');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->select('e_mail');
                $this->db->where('e_mail', $e_mail);
                $this->db->group_by('e_mail');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'presupuesto':
                $this->db->group_by('e_mail');
                $query = $this->db->get(ACTIVIDADES);        
                break;
            }         
        
        return $query->result();
    }
    
    
    function get_all_orderbyID_asc($e_mail,$grupo,$id_coord,$edicion)
    {
        $test = '_test';
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('id_act','ASC');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->or_where('id_coord', $id_coord);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            }        
        return $query->result();
    }
    function get_all_orderbyID_desc($e_mail,$grupo,$id_coord,$edicion)
    {
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('id_act','DESC');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->order_by('id_act','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->order_by('id_act','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->order_by('id_act','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            }         
        
        return $query->result();
    }
    
    function get_all_orderbyACT_asc($e_mail,$grupo,$id_coord,$edicion)
    {
        
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('actividad','ASC');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->order_by('actividad','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            }  
        
        return $query->result();
    }    
    function get_all_orderbyACT_desc($e_mail,$grupo,$id_coord,$edicion)
    {
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('actividad','DESC');
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->order_by('actividad','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->order_by('actividad','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->order_by('id_act','DESC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            } 
        
        return $query->result();
    }
    /* Obtiene las cédulas con Status de PENDIENTE ordenadas por ID Ascendentemente */
    function get_all_status($e_mail,$grupo,$id_coord,$status,$edicion)
    {        
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('id_act','ASC');
                $this->db->where('status_act', $status);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('status_act', $status);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('status_act', $status);
                $this->db->where('e_mail', $e_mail);                
                $query = $this->db->get(ACTIVIDADES);                
                break;
              case 'gestor':
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('status_act', $status);
                $this->db->where('e_mail', $e_mail);                
                $query = $this->db->get(ACTIVIDADES);                
                break;
            case 'presupuesto':
                $this->db->where('id_fc', $edicion);
                $this->db->order_by('id_act','ASC');
                $this->db->where('status_act', $status);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->order_by('id_act','ASC');
                $this->db->where('id_fc', $edicion);
                $this->db->where('status_act', $status);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);
                break;
            }        
        return $query->result(); 
    }
    
    function get_cal_act($e_mail,$grupo,$id_coord,$edicion)
    {
        switch ($grupo) {
              case 'administrador':
                $this->db->select('actividad,quienpropone,d1,d2,d3,d4,d5,d6,d7,d8,d9,d10,hora_ini,hora_fin');
                $this->db->where('id_fc', $edicion);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->select('actividad,quienpropone,d1,d2,d3,d4,d5,d6,d7,d8,d9,d10,hora_ini,hora_fin');
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->select('actividad,quienpropone,d1,d2,d3,d4,d5,d6,d7,d8,d9,d10,hora_ini,hora_fin');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            } 
        
        return $query->result();
        
        
    }
    function get_cal_id_act($id_act)
    {
        $this->db->select('actividad,d1,d2,d3,d4,d5,d6,d7,d8,d9,d10,hora_ini,hora_fin');
        $this->db->where('id_act', $id_act);
        
        $query = $this->db->get(ACTIVIDADES);
        return $query->result();
    }
    function get_one_act($txt,$e_mail,$id_coord,$edicion)
    {
        switch ($_SESSION['grupo']) {
          case 'administrador':
            $this->db->where('id_fc', $edicion);
            $this->db->or_like('actividad', $txt);
            $query = $this->db->get(ACTIVIDADES);
            break;
          case 'coordinador':
            $this->db->where('id_fc', $edicion);
            $this->db->where('id_coord', $id_coord);
            $this->db->where('e_mail', $e_mail);
            $this->db->like('actividad', $txt);
            $query = $this->db->get(ACTIVIDADES);
            break;
          case 'gestor':
            $this->db->where('id_fc', $edicion);
            $this->db->where('e_mail', $e_mail);
            $this->db->or_like('actividad', $txt);
            $query = $this->db->get(ACTIVIDADES);
            break;
        }
        
        return $query->result();
    }
    function get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion)
    {
        
        switch ($grupo) {
              case 'administrador':                
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $this->db->where('id_coord', $id_coord);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
                case 'gestor':                
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'presupuesto':                
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);        
                break;
            } 
                
        
        return $query->result();
    }

///////////// COPIAR Y PEGAR UN REGISTRO //////////
    public function get_one_to_copi($id_act)
    {
        $this->db->where('id_act', $id_act);
        $this->db->limit(1);
        $query = $this->db->get(ACTIVIDADES);
        return $query->result();
    }

    function paste($reg,$ed)
    {
        foreach ($reg as $value) {
            $data['status_cedula']    = $value->status_cedula;
            $data['e_mail']           = $value->e_mail;
            $data['actividad']        = $value->actividad;
            $data['descripcion']      = $value->descripcion;
            $data['justificacion']    = $value->justificacion;
            $data['id_categoria']     = $value->id_categoria;
            $data['quienpropone']     = $value->quienpropone;
            $data['empresa']          = $value->empresa;
            $data['puesto']           = $value->puesto;
            $data['domicilio']        = $value->domicilio;
            $data['telefono']         = $value->telefono;
            $data['email']            = $value->email;
            $data['web']              = $value->web;
            $data['fecha_act']        = '0000-00-00';
            $data['fecha_aut']        = '0000-00-00';
            $data['costo_secture']    = $value->costo_secture;
            $data['costo_publico']    = $value->costo_publico;
            $data['is_costo_secture'] = $value->is_costo_secture;
            $data['is_costo_publico'] = $value->is_costo_publico;
            $data['ubicacion']        = $value->ubicacion;
            $data['sede']             = $value->sede;
            $data['d1']               = $value->d1;
            $data['d2']               = $value->d2;
            $data['d3']               = $value->d3;
            $data['d4']               = $value->d4;
            $data['d5']               = $value->d5;
            $data['d6']               = $value->d6;
            $data['d7']               = $value->d7;
            $data['d8']               = $value->d8;
            $data['d9']               = $value->d9;
            $data['d10']              = $value->d10;
            $data['hora_ini']         = $value->hora_ini;
            $data['hora_fin']         = $value->hora_fin;
            $data['id_coord']         = $value->id_coord;
            $data['id_fc']            = $ed;
            $data['id_resp']          = $value->id_resp;
            $data['fecha_alta']       = date('Y-m-d H:i:s');
            $data['fecha_ult_modificacion'] = date('Y-m-d H:i:s');
            $data['status_act']       = 0; // Pendiente
            $data['pres_ant']         = 0;
            $data['pres_aut']         = 0;
            $data['pres_eje']         = 0;
            $data['pres_soli']        = 0;
            $data['pres_gas']         = 0;
        }
        $this->db->insert(ACTIVIDADES, $data);
        return $this->db->insert_id();
    }

    function bloqueo($id_act,$bloq) {
        $data = array('status_act' => $bloq);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }

///////////////////////////////////////////////////

    function get_filtro_por_resp($txt,$grupo,$id_coord,$edicion)
    {        
        switch ($grupo) {
              case 'administrador':
                $this->db->where('e_mail', $txt);
                $this->db->where('id_fc', $edicion);
                //$this->db->where('status_act', $status);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_coord', $id_coord);
                $this->db->where('e_mail', $txt);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $txt);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            case 'presupuesto':
                $this->db->where('e_mail', $txt);
                $this->db->where('id_fc', $edicion);
                //$this->db->where('status_act', $status);
                $query = $this->db->get(ACTIVIDADES);        
                break;
            }        
        return $query->result();
    }

    function get_filtro_por_ced($id_act,$grupo,$id_coord,$edicion)
    {
        
        switch ($grupo) {
              case 'administrador':
                $this->db->where('id_act', $id_act);
                $this->db->where('id_fc', $edicion);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->where('id_coord', $id_coord);
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'gestor':
                $this->db->where('id_fc', $edicion);
                $this->db->where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            }                
        
        return $query->result();
    }

    function get_filtro_por_coord($grupo,$coord,$edicion)
    {
        
        $this->db->select('*');
        $this->db->where('status_act', 4);
        $this->db->where('id_coord', $coord);
        $query = $this->db->get(ACTIVIDADES);              
               
        return $query->result();
    }

    function get_filtro_res_ced($id_act,$grupo,$id_coord)
    {
        
        switch ($grupo) {
              case 'administrador':
                $this->db->select('*');
                $this->db->where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'coordinador':
                $this->db->select('*');
                //$this->db->where('id_act', $id_act);
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->select('*');
                //$this->db->where('id_act', $id_act);
                //$this->db->where('id_coord', $id_coord);
                $this->db->or_where('id_act', $id_act);
                $query = $this->db->get(ACTIVIDADES);              
                break;
            }                
        
        return $query->result();
    }
    function get_one_act_edit_com($id_act,$e_mail)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $query = $this->db->get(ACTIVIDADES);
                
        return $query->result();
    }
    function get_act()
    {
        $res = '';
        $res = $this->id_coord = $_POST['id_act'];
        $this->db->select('*');
        $this->db->where('id_act', $res);
        $this->db->order_by('actividad','asc');
        $query = $this->db->get(ACTIVIDADES);
        return $query->result();            

    }    

    

    function insert_entry($e_mail)
    {
        $this->e_mail           = $e_mail;
        $this->actividad        = strtoupper($_POST['actividad']);
        $this->descripcion      = strtoupper($_POST['descripcion']);
        $this->justificacion    = strtoupper($_POST['justificacion']);
        $this->id_categoria     = strtoupper($_POST['id_categoria']);
        $this->quienpropone     = strtoupper($_POST['quienpropone']);
        //$this->empresa          = strtoupper($_POST['empresa']);
        //$this->puesto           = strtoupper($_POST['puesto']);
        //$this->domicilio        = strtoupper($_POST['domicilio']);
        //$this->telefono         = strtoupper($_POST['telefono']);
        $this->email            = $_POST['email'];
        //$this->web              = $_POST['web'];
        $this->fecha_act        = $_POST['fecha_act'];
        $this->fecha_aut        = $_POST['fecha_aut'];
        //$this->costo_secture    = $_POST['costo_secture'];
        //$this->costo_publico    = $_POST['costo_publico'];
        //$this->is_costo_secture = $_POST['is_costo_secture'];
        $this->is_costo_publico = $_POST['is_costo_publico'];
        $this->sede             = strtoupper($_POST['sede']);
        $this->ubicacion        = strtoupper($_POST['ubicacion']);
        $this->id_coord         = $_POST['id_coord'];
        $this->id_fc            = $_POST['edicion'];
        $this->id_resp          = 0;
        $this->fecha_alta       = date('Y-m-d H:i:s');
        $this->fecha_ult_modificacion = date('Y-m-d H:i:s');


        $this->db->insert(ACTIVIDADES, $this);
    }



    function update_entry($e_mail,$edicion)
    {
        $this->e_mail           = $e_mail;
        $this->id_act           = $_POST['id_act'];
        $this->status_act       = $_POST['status_act'];
        
        $this->actividad        = strtoupper($_POST['actividad']);
        $this->descripcion      = strtoupper($_POST['descripcion']);
        $this->justificacion    = strtoupper($_POST['justificacion']);
        $this->id_categoria     = $_POST['id_categoria'];
        $this->id_coord         = $_POST['id_coord'];
        $this->quienpropone     = strtoupper($_POST['quienpropone']);
        $this->empresa          = strtoupper($_POST['empresa']);
        $this->puesto           = strtoupper($_POST['puesto']);
        $this->domicilio        = strtoupper($_POST['domicilio']);
        $this->telefono         = strtoupper($_POST['telefono']);
        $this->email            = $_POST['email'];
        $this->web              = $_POST['web'];
        $this->fecha_act        = $_POST['fecha_act'];
        $this->fecha_aut        = $_POST['fecha_aut'];
        $this->costo_secture    = $_POST['costo_secture'];
        $this->costo_publico    = $_POST['costo_publico'];
        $this->is_costo_secture = $_POST['is_costo_secture'];
        $this->is_costo_publico = $_POST['is_costo_publico'];
        $this->ubicacion        = strtoupper($_POST['ubicacion']);
        
        $this->fecha_ult_modificacion = date('Y-m-d H:i:s');
        
        if (!isset($_POST['d1']))
        {
            $this->d1 = '0000-00-00';
        } else {
            $this->d1 = $_POST['d1'];
        }
        if (!isset($_POST['d2']))
        {
            $this->d2 = '0000-00-00';
        } else {
            $this->d2 = $_POST['d2'];
        }
        if (!isset($_POST['d3']))
        {
            $this->d3 = '0000-00-00';
        } else {
            $this->d3 = $_POST['d3'];
        }
        if (!isset($_POST['d4']))
        {
            $this->d4 = '0000-00-00';
        } else {
            $this->d4 = $_POST['d4'];
        }
        if (!isset($_POST['d5']))
        {
            $this->d5 = '0000-00-00';
        } else {
            $this->d5 = $_POST['d5'];
        }
        if (!isset($_POST['d6']))
        {
            $this->d6 = '0000-00-00';
        } else {
            $this->d6 = $_POST['d6'];
        }
        if (!isset($_POST['d7']))
        {
            $this->d7 = '0000-00-00';
        } else {
            $this->d7 = $_POST['d7'];
        }
        if (!isset($_POST['d8']))
        {
            $this->d8 = '0000-00-00';
        } else {
            $this->d8 = $_POST['d8'];
        }
        if (!isset($_POST['d9']))
        {
            $this->d9 = '0000-00-00';
        } else {
            $this->d9 = $_POST['d9'];
        }
        if (!isset($_POST['d10']))
        {
            $this->d10 = '0000-00-00';
        } else {
            $this->d10 = $_POST['d10'];
        }
        
        $this->hora_ini         = $_POST['hora_ini'];
        $this->hora_fin         = $_POST['hora_fin'];
        $this->id_fc            = $edicion;
        $this->id_resp          = $_POST['id_resp'];
        
        $this->db->where('id_act', $this->id_act);
        $this->db->update(ACTIVIDADES, $this);
    }
 
    function update_tot_act($id_act,$total)
    {
        $data['costo_secture'] = $total;        
        
        $this->db->where('id_act', $id_act);
        $this->db->update(ACTIVIDADES, $data);
    }

    function update_costo_secture($id_act,$total)
    {
        $data['id_act']           = $id_act;        
        $data['costo_secture']    = $total;
        
        $this->db->where('id_act', $id_act);
        $this->db->update(ACTIVIDADES, $data);
    }

    function update_pres_gas($id_act,$total_gas)
    {
        $data['id_act']           = $id_act;        
        $data['pres_gas']    = $total_gas;
        
        $this->db->where('id_act', $id_act);
        $this->db->update(ACTIVIDADES, $data);
    }

    
    function get_total_cedulas($e_mail,$edicion)
    {
        // Obtiene el total del costo de la cédula de actividad. Sumatoria de sus necesidades
        $this->db->select('sum(costo_secture) as total_cedulas');
        $this->db->where('e_mail', $e_mail);
        $this->db->where('id_fc', $edicion);
        $query = $this->db->get(ACTIVIDADES);
        return $query->result();
    }
    
    function get_reg($e_mail,$id_coord,$edicion)
    {
        switch ($_SESSION['grupo']) {
              case 'administrador':
                $this->db->select('count(*) as tot');
                $this->db->where('id_fc', $edicion);
                $query = $this->db->get(ACTIVIDADES);
                break;
              case 'coordinador':
                $this->db->select('count(*) as tot');
                $this->db->where('id_coord', $id_coord);
                $this->db->where('id_fc', $edicion);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
                case 'gestor':
                $this->db->select('count(*) as tot');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'presupuesto':
                $this->db->select('count(*) as tot');
                $this->db->where('id_fc', $edicion);
                $query = $this->db->get(ACTIVIDADES);
                break;
            } 
        
        return $query->result();
    }
    function get_reg_filtro($txt,$e_mail,$id_coord,$edicion)
    {
        switch ($_SESSION['grupo']) {
              case 'administrador':
                $this->db->select('count(*) as tot');
                $this->db->where('id_fc', $edicion);
                $query = $this->db->get(ACTIVIDADES);
                break;
              case 'coordinador':
                $this->db->select('count(*) as tot');
                $this->db->where('id_coord', $id_coord);
                $this->db->where('id_fc', $edicion);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              case 'presupuesto':
                $this->db->select('count(*) as tot');
                $this->db->where('id_fc', $edicion);
                $this->db->where('e_mail', $txt);
                $query = $this->db->get(ACTIVIDADES);
                break;
            } 
        
        return $query->result();
    }
    
    public function update_ult_modificacion ($id_act) {
        
        $data = array('fecha_ult_modificacion' => date('Y-m-d H:i:s'));
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function delete($id_act)
    {
        $this->db->delete(ACTIVIDADES, array('id_act' => $id_act)); 
    }
    function get_master_plan($edicion)
    {                
        $this->db->select('*');
        $this->db->from(ACTIVIDADES);
        $this->db->where('id_fc', $edicion);
        //$this->db->join('coordinadores','actividades.id_coord = coordinadores.id_coord');
        $this->db->order_by('id_coord','ASC');
        
        $query = $this->db->get();
        
        return $query->result();
    }
    function get_master_plan_coord($id_coord,$edicion)
    {                
        $this->db->where('id_coord', $id_coord);
        $this->db->where('id_fc', $edicion);
        //$this->db->order_by('id_coord','ASC');
        
        $query = $this->db->get(ACTIVIDADES);
        
        return $query->result();
    }
    function get_master_plan_categoria($id_categoria,$edicion)
    {                
        $this->db->where('id_categoria', $id_categoria);
        $this->db->where('id_fc', $edicion);
        //$this->db->order_by('id_coord','ASC');
        
        $query = $this->db->get(ACTIVIDADES);
        
        return $query->result();
    }
    function get_master_plan_cedula($id_act,$edicion)
    {                
        $this->db->where('id_act', $id_act);
        $this->db->where('id_fc', $edicion);
        //$this->db->order_by('id_coord','ASC');
        
        $query = $this->db->get(ACTIVIDADES);
        
        return $query->result();
    }
    function si_autorizar($id_act,$succes) {
        $data = array('status_act' => $succes);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function no_autorizar($id_act,$fail) {
        $data = array('status_act' => $fail);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function pendiente($id_act,$pend) {
        $data = array('status_act' => $pend);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function fuera_presupuesto($id_act,$out) {
        $data = array('status_act' => $out);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function cerrar_presupuesto($id_act) {
        $data = array('status_cedula' => 1);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function integrado($id_act,$integrado) {
        $data = array('status_act' => $integrado);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function presupuestado($id_act,$presupuestado) {
        $data = array('status_act' => $presupuestado);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    function get_regs_pendientes($e_mail,$id_coord)
    {
        switch ($_SESSION['grupo']) {
              case 'administrador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '0');
                $query = $this->db->get(ACTIVIDADES);
                break;
              case 'coordinador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '0');
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '0');
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);
                break;
            } 
        
        return $query->result();
    }
    function get_regs_aprobados($e_mail,$id_coord)
    {
        switch ($_SESSION['grupo']) {
              case 'administrador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '2');
                $query = $this->db->get(ACTIVIDADES);
                break;
              case 'coordinador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '2');
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '2');
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);
                break;
            } 
        
        return $query->result();
    }
    function get_regs_Noaprobados($e_mail,$id_coord)
    {
        switch ($_SESSION['grupo']) {
              case 'administrador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '1');
                $query = $this->db->get(ACTIVIDADES);
                break;
              case 'coordinador':
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '1');
                $this->db->where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);        
                break;
              default:
                $this->db->select('count(*) as tot');
                $this->db->where('status_act', '1');
                $this->db->where('e_mail', $e_mail);
                $query = $this->db->get(ACTIVIDADES);
                break;
            } 
        
        return $query->result();
    } 
    function act_pres_ant($id_act,$pres_ant,$pres_soli,$pres_aut,$pres_eje) {
        $data = array('pres_ant' => $pres_ant,
                      'pres_soli' => $pres_soli,
                      'pres_aut' => $pres_aut,
                      'pres_eje' => $pres_eje);
        $this->db->where('id_act',$id_act);
        $this->db->update(ACTIVIDADES,$data );
    }
    
    
    
    
    

    

}
?>