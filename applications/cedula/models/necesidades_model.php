<?php
class Necesidades_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_nec = '';
    var $descripcionec = '';
    var $observaciones = '';
    var $id_act = '';
    var $cantidad = '';
    var $precio_unitario = '';
    var $iva = '';
    var $precio_total = '';
    var $encargado = '';
    
        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->database();
        define("NECESIDADES", "necesidades");
    }
            
    function get_all()
    {
        // Llama a la tabla de la base de datos y se trae como respuesta TODOS los registro. 
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    function get_one_nec($txt)
    {
        $res = $txt;
        //$res = $this->descripcion = $_POST['id_nec'];
        $this->db->select('*');
        $this->db->like('descripcionec', $res);
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    
    function get_one_nec_edit($id_nec)
    {
        $res = $id_nec;
        //$res = $this->descripcion = $_POST['id_nec'];
        $this->db->select('*');
        $this->db->where('id_nec', $res);
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    
    function get_all_nec_act($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('id_nec','asc');
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    
    function get_total_act($id_act)
    {
        // Obtiene el total del costo de la cédula de actividad. Sumatoria de sus necesidades
        $this->db->select('sum(precio_total) as total_act,sum(iva) as tot_iva,(sum(precio_total) + sum(iva)) as tot_tot');
        $this->db->where('id_act', $id_act);
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    
    function get_all_nec_act_by_encargado_asc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','asc');
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    function get_all_nec_act_by_encargado_desc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','desc');
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }
    
    function get_nec()
    {
        $res = '';
        $res = $this->id_coord = $_POST['id_nec'];
        $this->db->select('*');
        $this->db->where('id_nec', $res);
        $this->db->order_by('descripcionec','asc');
        $query = $this->db->get(NECESIDADES);
        return $query->result();            

    }

    function get_all_necesidades()
    {
        $query = $this->db->get(NECESIDADES);
        return $query->result();
    }

    function insert_entry($id_act)
    {
        $this->id_act          = $id_act;
        $this->descripcionec   = strtoupper($_POST['descripcionec']);
        $this->observaciones   = strtoupper($_POST['observaciones']);
        $this->cantidad        = (int)$_POST['cantidad'];
        $this->precio_unitario = $_POST['precio_unitario'];
        $this->iva             = ($this->cantidad * $this->precio_unitario)*0.16 ;
        $this->precio_total    = ($this->cantidad * $this->precio_unitario) ;
        $this->encargado       = strtoupper($_POST['encargado']);
        //$this->quien_modifica  = $e_mail;
    
        $this->db->insert(NECESIDADES, $this);
    }

    function paste($nec,$last_id)
    {
        foreach ($nec as $value) {
            $data['id_act']          = $last_id;
            $data['descripcionec']   = $value->descripcionec;
            $data['observaciones']   = $value->observaciones;
            $data['cantidad']        = (int)$value->cantidad;
            $data['precio_unitario'] = $value->precio_unitario;
            $data['iva']             = ($value->cantidad * $value->precio_unitario)*0.16;
            $data['precio_total']    = ($value->cantidad * $value->precio_unitario);
            $data['encargado']       = $value->encargado;
            $this->db->insert(NECESIDADES, $data);            
        }
        
        
        
    }

    function update_entry($e_mail)
    {
        $this->id_nec          = $_POST['id_nec'];
        $this->descripcionec   = strtoupper($_POST['descripcionec']);
        $this->observaciones   = strtoupper($_POST['observaciones']);
        $this->id_act          = $_POST['id_act'];
        $this->cantidad        = (int)$_POST['cantidad'];
        $this->precio_unitario = $_POST['precio_unitario'];
        $this->iva             = ($this->cantidad * $this->precio_unitario)*0.16 ;
        $this->precio_total    = ($this->cantidad * $this->precio_unitario) ;
        $this->encargado       = strtoupper($_POST['encargado']);
        $this->fecha_ult_modificacion = date('Y-m-d H:i:s'); 
        $this->quien_modifica  = $e_mail; 
        
        $this->db->where('id_nec', $this->id_nec);
        $this->db->update(NECESIDADES, $this);
    }
    
    function delete($id_nec)
    {
        $this->db->delete(NECESIDADES, array('id_nec' => $id_nec)); 
    }
    
    function get_registros()
    {
        $this->db->select('id_act as id_act,count(*) as regs');
        $this->db->from(NECESIDADES);
        $this->db->group_by('id_act');         
        return $query = $this->db->get();
    }
    
    

}
?>