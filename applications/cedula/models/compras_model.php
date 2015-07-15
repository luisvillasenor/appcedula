<?php
class Compras_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_comp = '';
    var $id_act = '';
    var $concepto = '';
    var $observaciones = '';    
    var $cantidad = '';
    var $precio_unitario = '';
    var $iva = '';
    var $precio_total = '';
    var $proveedor = '';
    
        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
            
    function get_all()
    {
        // Llama a la tabla de la base de datos y se trae como respuesta TODOS los registro. 
        $query = $this->db->get('compras');
        return $query->result();
    }
    function get_one_nec($txt)
    {
        $res = $txt;
        //$res = $this->descripcion = $_POST['id_comp'];
        $this->db->select('*');
        $this->db->like('concepto', $res);
        $query = $this->db->get('compras');
        return $query->result();
    }
    
    function get_one_nec_edit($id_comp)
    {
        $res = $id_comp;
        //$res = $this->descripcion = $_POST['id_comp'];
        $this->db->select('*');
        $this->db->where('id_comp', $res);
        $query = $this->db->get('compras');
        return $query->result();
    }
    
    function get_all_nec_act($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('id_comp','asc');
        $query = $this->db->get('compras');
        return $query->result();
    }
    
    function get_total_act($id_act)
    {
        // Obtiene el total del costo de la cédula de actividad. Sumatoria de sus compras
        $this->db->select('sum(precio_total) as total_act,sum(iva) as tot_iva,(sum(precio_total) + sum(iva)) as tot_tot');
        $this->db->where('id_act', $id_act);
        $query = $this->db->get('compras');
        return $query->result();
    }
    
    function get_all_nec_act_by_proveedor_asc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('proveedor','asc');
        $query = $this->db->get('compras');
        return $query->result();
    }
    function get_all_nec_act_by_proveedor_desc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('proveedor','desc');
        $query = $this->db->get('compras');
        return $query->result();
    }
    
    function get_nec()
    {
        $res = '';
        $res = $this->id_coord = $_POST['id_comp'];
        $this->db->select('*');
        $this->db->where('id_comp', $res);
        $this->db->order_by('concepto','asc');
        $query = $this->db->get('compras');
        return $query->result();            

    }

    function get_all_compras()
    {
        $query = $this->db->get('compras');
        return $query->result();
    }

    function insert_entry($id_act)
    {
        $this->id_act          = $id_act;
        $this->concepto   = strtoupper($_POST['concepto']);
        $this->observaciones   = strtoupper($_POST['observaciones']);
        $this->cantidad        = (int)$_POST['cantidad'];
        $this->precio_unitario = $_POST['precio_unitario'];
        $this->iva             = ($this->cantidad * $this->precio_unitario)*0.16 ;
        $this->precio_total    = ($this->cantidad * $this->precio_unitario) ;
        $this->proveedor       = strtoupper($_POST['proveedor']);
        //$this->quien_modifica  = $e_mail;
    
        $this->db->insert('compras', $this);
    }

    function update_entry($e_mail)
    {
        $this->id_comp          = $_POST['id_comp'];
        $this->concepto   = strtoupper($_POST['concepto']);
        $this->observaciones   = strtoupper($_POST['observaciones']);
        $this->id_act          = $_POST['id_act'];
        $this->cantidad        = (int)$_POST['cantidad'];
        $this->precio_unitario = $_POST['precio_unitario'];
        $this->iva             = ($this->cantidad * $this->precio_unitario)*0.16 ;
        $this->precio_total    = ($this->cantidad * $this->precio_unitario) ;
        $this->proveedor       = strtoupper($_POST['proveedor']);
        $this->fecha_ult_modificacion = date('Y-m-d H:i:s'); 
        $this->quien_modifica  = $e_mail; 
        
        $this->db->where('id_comp', $this->id_comp);
        $this->db->update('compras', $this);
    }
    
    function delete($id_comp)
    {
        $this->db->delete('compras', array('id_comp' => $id_comp)); 
    }
    
    function get_registros()
    {
        $this->db->select('id_act as id_act,count(*) as regs');
        $this->db->from('compras');
        $this->db->group_by('id_act');         
        return $query = $this->db->get();
    }
    
    

}
?>