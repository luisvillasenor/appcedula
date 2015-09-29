<?php
class Consolidados_model extends CI_Model
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_con = '';
    var $id_nec = '';
    var $id_act = '';
    var $tipo = '';    
    var $clasificacion = '';
    var $proveedor = '';
    var $concepto = '';
    var $cantidad = '';
    var $precio_unitario = '';
    var $iva = '';
    var $precio_total = '';
    var $fecha = '';
    var $fecha_ult_modificacion = '';
    var $quien_modifica = '';
    var $status_cons = '';

        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        //$this->load->database();
        define("TABLA", "consolidados");
    }
            
    function get_all()
    {
        // Llama a la tabla de la base de datos y se trae como respuesta TODOS los registro. 
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    function get_one_nec($txt)
    {
        $res = $txt;
        //$res = $this->descripcion = $_POST['id_con'];
        $this->db->select('*');
        $this->db->like('concepto', $res);
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    
    function get_one_nec_edit($id_con)
    {
        $res = $id_con;
        //$res = $this->descripcion = $_POST['id_con'];
        $this->db->select('*');
        $this->db->where('id_con', $res);
        $this->db->limit(1);
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    
    function get_all_cons_act($id_act = FALSE)
    {
        if ( $id_act === FALSE ) {
            $this->db->order_by('id_con','asc');
            $query = $this->db->get(TABLA);
            return $query->result();            
        }
        //
        $this->db->where('id_act', $id_act);
        $this->db->order_by('id_con','asc');
        $query = $this->db->get(TABLA);
        return $query->result();
    }

    function get_all_cons_tipo($tipo,$clasificacion)
    {
        if ( $tipo === '' && $clasificacion === 'todo') {
            $this->db->order_by('clasificacion','asc');
            $query = $this->db->get(TABLA);
            return $query->result();
        }
        //
        $this->db->where('tipo', $tipo);
        $this->db->or_where('clasificacion', $clasificacion);
        $this->db->order_by('clasificacion','asc');
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    
    function get_total_act_cons($id_act)
    {
        // Obtiene el total del costo de la cédula de actividad. Sumatoria de sus necesidades
        $this->db->select('sum(precio_total) as total_act,sum(iva) as tot_iva,(sum(precio_total) + sum(iva)) as tot_tot');
        $this->db->where('id_act', $id_act);
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    
    function get_all_nec_act_by_encargado_asc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','asc');
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    function get_all_nec_act_by_encargado_desc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','desc');
        $query = $this->db->get(TABLA);
        return $query->result();
    }
    
    function get_nec()
    {
        $res = '';
        $res = $this->id_coord = $_POST['id_con'];
        $this->db->select('*');
        $this->db->where('id_con', $res);
        $this->db->order_by('concepto','asc');
        $query = $this->db->get(TABLA);
        return $query->result();            

    }

    function get_groupby_clasificacion()
    {
        $this->db->select('clasificacion');
        $this->db->group_by('clasificacion');
        $this->db->order_by('clasificacion','asc');
        $query = $this->db->get(TABLA);
        return $query->result();
    }

    function insert_entry($id_act,$id_nec,$tipo,$clasificacion,$proveedor,$concepto,$cantidad,$precio_unitario,$quien_modifica,$status_cons)
    {
        $data['id_act']          = $id_act;
        $data['id_nec']          = $id_nec;
        $data['tipo']            = $tipo;
        $data['clasificacion']   = $clasificacion;
        $data['proveedor']       = $proveedor;
        $data['concepto']        = trim($concepto);
        $data['cantidad']        = (int)$cantidad;
        $data['precio_unitario'] = $precio_unitario;
        $data['iva']             = ( $data['cantidad'] * $data['precio_unitario'] ) * 0.16;
        $data['precio_total']    = ( $data['cantidad'] * $data['precio_unitario'] );
        $data['fecha']           = date('Y-m-d H:i:s'); 
        $data['fecha_ult_modificacion'] = date('Y-m-d H:i:s'); 
        $data['quien_modifica']  = $quien_modifica;
        $data['status_cons']     = $status_cons;
            
        $this->db->insert(TABLA, $data);
        return $this->db->insert_id();
    }    

    function paste($nec,$last_id)
    {
        foreach ($nec as $value) {
            $data['id_act']          = $last_id;
            $data['concepto']        = $value->concepto;
            $data['clasificacion']   = $value->clasificacion;
            $data['cantidad']        = (int)$value->cantidad;
            $data['precio_unitario'] = $value->precio_unitario;
            $data['iva']             = ($value->cantidad * $value->precio_unitario)*0.16;
            $data['precio_total']    = ($value->cantidad * $value->precio_unitario);
            $data['encargado']       = $value->encargado;
            $this->db->insert(TABLA, $data);            
        }        
    }

    function update_entry($id_con,$id_nec,$id_act,$tipo,$clasificacion,$proveedor,$concepto,$cantidad,$precio_unitario,$quien_modifica,$status_cons,$fecha)
    {
        $data['id_con']          = $id_con;
        $data['id_nec']          = $id_nec;
        $data['id_act']          = $id_act;
        $data['tipo']            = $tipo;
        $data['clasificacion']   = $clasificacion;
        $data['proveedor']       = $proveedor;
        $data['concepto']        = $concepto;
        $data['cantidad']        = (int)$cantidad;
        $data['precio_unitario'] = $precio_unitario;
        $data['iva']             = ( $data['cantidad'] * $data['precio_unitario'] )*0.16 ;
        $data['precio_total']    = ( $data['cantidad'] * $data['precio_unitario'] ) ;
        $data['fecha']           = $fecha; 
        $data['fecha_ult_modificacion'] = date('Y-m-d H:i:s'); 
        $data['quien_modifica']  = $quien_modifica;
        $data['status_cons']     = $status_cons;
        
        $this->db->where('id_con', $id_con);
        $this->db->update(TABLA, $data);
    }
    
    function delete($id_con)
    {
        $this->db->delete(TABLA, array('id_con' => $id_con)); 
    }
    
    function get_registros()
    {
        $this->db->select('id_act as id_act,count(*) as regs');
        $this->db->from(TABLA);
        $this->db->group_by('id_act');         
        return $query = $this->db->get();
    }
    
    

}
?>