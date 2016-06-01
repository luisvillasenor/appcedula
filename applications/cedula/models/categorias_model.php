<?php
    class Categorias_model extends CI_Model 
    {
	   var $id_categoria = '';
       var $grupo = '';
	   var $categoria = '';

        function __construct()
        {
            // Call the Model constructor
            parent::__construct();
            $this->load->database();
        }
        function get_all_cats($order = 'asc') 
        {   
            $this->db->order_by('categoria',$order);
            $query = $this->db->get('categorias');
            return $query->result();
        }
    
        function get_categorias($id_coord,$grupo) 
        {   
            switch ($grupo) {
              case 'administrador':
                $this->db->order_by('id_coord','asc');
                $this->db->order_by('categoria','asc');
                $query = $this->db->get('categorias');
                break;
              case 'coordinador':
                $this->db->where('id_coord', $id_coord);
                $this->db->order_by('categoria','asc');
                $query = $this->db->get('categorias');
                break;
              default:
                $this->db->order_by('categoria','asc');
                $query = $this->db->get('categorias');     
                break;
            } 
           return $query->result();
        }
                
        function insert_entry($categoria,$id_coord)
        {
            $this->categoria = strtoupper($categoria);
            $this->id_coord  = strtoupper($id_coord);
                    
            $this->db->insert('categorias', $this);
        }
        function get_one_cat_edit($id_categoria)
        {   
            $this->db->select('*');
            $this->db->where('id_categoria', $id_categoria);
            $query = $this->db->get('categorias');
            return $query->result();
        }
        
        function update_entry($id_categoria,$id_coord,$categoria)
        {
            $this->id_categoria = $id_categoria;
            $this->id_coord     = $id_coord;
            $this->categoria    = strtoupper($categoria);
                    
            $this->db->where('id_categoria', $this->id_categoria);
            $this->db->update('categorias', $this);
        }
        
            
			   
    }
?>