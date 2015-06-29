<?php
class Promotores_model extends CI_Model 
{
    // Definicion de variables iguales a los votos de los campos de la tabla 
    var $id_promotor = '';
    var $folio = '';
    var $promotor = '';
    var $seccion = '';
    var $voto = '';
    var $id_jefe_manzana = '';
    var $promovidos = '';
    var $reales = '';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }

    //* Querys para PAGINATION *//////////////////////////
    public function record_count() {
        return $this->db->count_all("promotores");
    }
    public function get_calif_pm($limit,$start){
        $this->db->limit($limit,$start);
        $this->db->order_by('promotor','asc');
        $query = $this->db->get("promotores");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    //////////////////////////////////////////////////////

    function get_calif()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('jefes_manzana.jefe_manzana,jefes_manzana.voto,count(promotores.id_promotor) as estructura,sum(promotores.voto) as votaron,((sum(promotores.voto)/count(promotores.id_promotor))*100) as calificacion');
        $this->db->from('promotores');
        
        $this->db->join('jefes_manzana', 'jefes_manzana.id_jefe_manzana = promotores.id_jefe_manzana');
        $this->db->group_by('promotores.id_jefe_manzana');
        $this->db->order_by('jefes_manzana.jefe_manzana','asc');
        $query = $this->db->get();
        return $query->result();
    }
    function export_promotores()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('jefes_manzana.jefe_manzana,jefes_manzana.seccion,jefes_manzana.voto,count(promotores.id_promotor) as estructura,sum(promotores.voto) as votaron,((sum(promotores.voto)/count(promotores.id_promotor))*100) as calificacion');
        $this->db->from('promotores');
        $this->db->join('jefes_manzana', 'jefes_manzana.id_jefe_manzana = promotores.id_jefe_manzana');
        $this->db->group_by('promotores.id_jefe_manzana');
        $this->db->order_by('jefes_manzana.jefe_manzana','asc');
        $query = $this->db->get();
        return $query->result();
    }
    function export_promovidos()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('promotor,seccion,voto,promovidos,reales,(((reales/promovidos))*100) as calificacion');
        $this->db->from('promotores');
        $this->db->order_by('promotor','asc');
        $query = $this->db->get();
        return $query->result();
    }
    function get_calif_pr()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('count(id_promotor) as estructura,sum(voto) as votaron,((sum(voto)/count(id_promotor))*100) as calificacion');
        $this->db->from('promotores');
        $query = $this->db->get();
        return $query->result();
    }
    function get_calif_pro()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('sum(promovidos) as estructura,sum(reales) as votaron,((sum(reales)/sum(promovidos))*100) as calificacion');
        $this->db->from('promotores');        
        $query = $this->db->get();
        return $query->result();
    }
    function get_calif_pm2()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('promotor,voto,promovidos,reales');
        
        $this->db->order_by('promotor','asc');
        $query = $this->db->get('promotores');
        return $query->result();
    }
    function get_calif_total()// Tabla de evaluacin del Coordinador (Padre)
    {
        $this->db->select('count(id_promotor) as estructura,sum(voto) as votaron,((sum(voto)/count(id_promotor))*100) as calificacion');
        $this->db->from('promotores');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all()
    {
        $query = $this->db->get('promotores');
        return $query->result();
    }
    function get_one_pr()
    {
        $res = '';
        $res = $this->promotor = $_POST['promotor'];
        $this->db->select('*');
        $this->db->like('promotor', $res);
        $query = $this->db->get('promotores');
        return $query->result();
    }
    function get_one_jm()
    {
        $res = '';
        $res = $this->jefe_manzana = $_POST['jefe_manzana'];
        $this->db->select('jefes_manzana.id_jefe_manzana,jefes_manzana.jefe_manzana,jefes_manzana.voto,count(promotores.id_promotor) as estructura,sum(promotores.voto) as votaron,((sum(promotores.voto)/count(promotores.id_promotor))*100) as calificacion');
        $this->db->from('promotores');
        $this->db->join('jefes_manzana', 'jefes_manzana.id_jefe_manzana = promotores.id_jefe_manzana');
        $this->db->like('jefes_manzana.jefe_manzana', $res);
        $this->db->group_by('promotores.id_jefe_manzana');
        $query = $this->db->get();
        return $query->result();
    }
    function insert_entry()
    {
        $this->promotor        = $_POST['promotor'];
        $this->folio           = $_POST['folio'];
        $this->seccion         = $_POST['seccion'];
        $this->promovidos      = $_POST['promovidos'];
        $this->reales          = $_POST['reales'];
        $this->voto            = $_POST['voto'];
        $this->id_jefe_manzana = $_POST['id_jefe_manzana'];

        $this->db->insert('promotores', $this);
    }
    function get_pr()
    {
        $res = '';
        $res = $this->id_promotor = $_POST['id_promotor'];
        $this->db->select('*');
        $this->db->where('id_promotor', $res);
        $this->db->order_by('promotor','asc');
        $query = $this->db->get('promotores');
        return $query->result();            

    }
    function update_entry()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->promotor        = $_POST['promotor'];
        $this->folio           = $_POST['folio'];
        $this->seccion         = $_POST['seccion'];
        $this->promovidos      = $_POST['promovidos'];
        $this->reales          = $_POST['reales'];
        $this->voto            = $_POST['voto'];
        $this->id_jefe_manzana = $_POST['id_jefe_manzana'];

        $this->db->where('id_promotor', $this->id_promotor);
        $this->db->update('promotores', $this); 

        //$this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_promotor()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->promotor        = $_POST['promotor'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_folio()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->folio           = $_POST['folio'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_seccion()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->seccion         = $_POST['seccion'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_promovidos()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->promovidos      = $_POST['promovidos'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_reales()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->reales            = $_POST['reales'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
    function update_voto()
    {
        $this->id_promotor     = $_POST['id_promotor'];
        $this->voto            = $_POST['voto'];
        $this->db->update('promotores', $this, array('id_promotor' => $_POST['id_promotor']));
    }
}
?>