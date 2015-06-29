<?php
class Responsables_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_resp = '';
    var $responsable = '';
        
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    
    function get_all_resps()
    {
        $query = $this->db->get('responsables');
        return $query->result();
    }
    function get_one_re()
    {
        $res = '';
        $res = $this->responsable = $_POST['responsable'];
        $this->db->select('*');
        $this->db->like('responsable', $res);
        $query = $this->db->get('responsables');
        return $query->result();
    }
    function get_re()
    {
        $res = '';
        $res = $this->id_resp = $_POST['id_resp'];
        $this->db->select('*');
        $this->db->where('id_resp', $res);
        $this->db->order_by('responsable','asc');
        $query = $this->db->get('responsables');
        return $query->result();            

    }

    function search_responsable($texto)
    {
        $this->db->select('*');
        $this->db->from('responsables');
        $this->db->like('voto', $texto);
        $query = $this->db->get();
        return $query->result();
    }

    function search_responsable2($responsable)
    {
        $this->db->select('*');
        $this->db->from('responsables');
        $this->db->like('responsable', $responsable);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_responsable()
    {
        $query = $this->db->get('responsables');
        return $query->result();
    }

    function get_one_resp_edit($id_resp){
        $this->db->select('*');
        $this->db->where('id_resp', $id_resp);
        $query = $this->db->get('responsables');
        return $query->result();
    }

    function insert_entry($responsable)
    {
        $this->responsable = $responsable;
                
        $this->db->insert('responsables', $this);
    }

    function update_entry($id_resp,$responsable)
    {
        $this->id_resp     = $id_resp;
        $this->responsable = $responsable;
                
        $this->db->where('id_resp', $this->id_resp);
        $this->db->update('responsables', $this);
    }

    

}
?>