<?php
class Comentarios_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_com = '';
    var $usuario = '';
    var $dueno = '';
    var $comentarios = '';
    
        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
            
    function get_all_com()
    {
               
        
        $this->db->select('*');
        //$this->db->where('id_act', $id_act);
        $this->db->order_by('id_com','desc');
        $query = $this->db->get('comentarios');
        return $query->result();
    }
    function get_one_nec($txt)
    {
        $res = $txt;
        //$res = $this->descripcion = $_POST['id_nec'];
        $this->db->select('*');
        $this->db->like('descripcionec', $res);
        $query = $this->db->get('necesidades');
        return $query->result();
    }
    
    function get_one_com_edit($id_com)
    {
        $res = $id_com;
        //$res = $this->descripcion = $_POST['id_nec'];
        $this->db->select('*');
        $this->db->where('id_com', $res);
        $query = $this->db->get('comentarios');
        return $query->result();
    }
    
    function get_all_com_act($id_act,$e_mail,$grupo,$id_coord)
    {
        switch ($grupo) {
              case 'administrador':
                $this->db->select('*');
                $this->db->where('id_act', $id_act);
                //$this->db->order_by('id_com','asc');
                $query = $this->db->get('actividades');        
                break;
              case 'coordinador':
                $this->db->select('*');
                $this->db->where('id_act', $id_act);
                $this->db->or_where('id_coord', $id_coord);
                $this->db->or_where('e_mail', $e_mail);
                //$this->db->order_by('id_com','asc');
                $query = $this->db->get('actividades');        
                break;
              default:
                $this->db->select('*');
                $this->db->where('id_act', $id_act);
                $this->db->or_where('e_mail', $e_mail);
                //$this->db->order_by('id_com','asc');
                $query = $this->db->get('actividades');              
                break;
            }        
        
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('id_com','asc');
        $query = $this->db->get('comentarios');
        return $query->result();
    }
    
    function get_total_act($id_act)
    {
        // Obtiene el total del costo de la cédula de actividad. Sumatoria de sus necesidades
        $this->db->select('sum(precio_total) as total_act');
        $this->db->where('id_act', $id_act);
        $query = $this->db->get('necesidades');
        return $query->result();
    }
    
    function get_all_nec_act_by_encargado_asc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','asc');
        $query = $this->db->get('necesidades');
        return $query->result();
    }
    
    function get_all_nec_act_by_encargado_desc($id_act)
    {
        $this->db->select('*');
        $this->db->where('id_act', $id_act);
        $this->db->order_by('encargado','desc');
        $query = $this->db->get('necesidades');
        return $query->result();
    }
        

    function insert_entry($id_act,$comentarios,$e_mail,$usuario)
    {
        $this->id_act          = $id_act;
        $this->dueno           = $usuario;
        $this->usuario         = $e_mail;
        $this->comentarios     = $comentarios;        
            
        $this->db->insert('comentarios', $this);
    }

    function update_entry($id_com,$id_act,$comentarios,$e_mail,$dueno)
    {
        $this->id_com      = $id_com;
        $this->id_act      = $id_act;
        $this->comentarios = $comentarios;
        $this->usuario     = $e_mail;        
        $this->dueno       = $dueno;
                
        $this->db->where('id_com', $id_com);
        $this->db->update('comentarios', $this);
    }
    
    function get_registros()
    {
        $this->db->select('id_act as id_act,count(*) as regs');
        $this->db->from('necesidades');
        $this->db->group_by('id_act');         
        return $query = $this->db->get();
    }
    
    

}
?>