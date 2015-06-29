<?php
class Fc_model extends CI_Model {
    var $id_fc = '';
    var $anio = '';
    var $edicion = '';
    var $status = '';

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_fc(){
        $this->db->order_by('anio','desc');
        $query = $this->db->get('fc');
        return $query->result();
    }


}
?>