<?php
class Productos_model extends CI_Model 
{
    // Definicion de variables iguales a los nombres de los campos de la tabla 
    var $prod_id = '';
    var $codigo = '';
    var $nombre = '';
    var $descripcion = '';
    var $medida = '';
    var $costo = '';
    var $precio = '';
    var $fecha_creacion = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->helper('date');
    }


    function get_last_ten_prods()
    {
        $query = $this->db->get('productos', 10);
        return $query->result();
    }

    function search_productos($texto)
    {
        $this->db->select('*');
        $this->db->from('productos');
        $this->db->like('nombre', $texto);
        $query = $this->db->get();
        return $query->result();
    }

    function search_codigo($codigo)
    {
        $this->db->select('*');
        $this->db->from('productos');
        $this->db->like('codigo', $codigo);
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }


    function get_all_productos()
    {
        $query = $this->db->get('productos');
        return $query->result();
    }

    function get_one_producto($res)
    {
        $this->db->select('*');
        $this->db->like('nombre', $res);
        $this->db->or_like('descripcion', $res);     
        $query = $this->db->get('productos');
           
        return $query->result();
    }

    function insert_entry()
    {
        $this->codigo         = $_POST['codigo'];
        $this->nombre         = $_POST['nombre'];
        $this->descripcion    = $_POST['descripcion'];
        $this->medida         = $_POST['medida'];
        $this->costo          = $_POST['costo'];
        $this->precio         = $_POST['precio'];
        $this->fecha_creacion = date('Y-m-d H:i:s');

        $this->db->insert('productos', $this);
    }

    function update_entry()
    {
        $this->prod_id        = $_POST['prod_id'];
        $this->codigo         = $_POST['codigo'];
        $this->nombre         = $_POST['nombre'];
        $this->descripcion    = $_POST['descripcion'];
        $this->medida         = $_POST['medida'];
        $this->costo          = $_POST['costo'];
        $this->precio         = $_POST['precio'];
        $this->proveed_id     = $_POST['proveed_id'];
        $this->fecha_creacion = date('Y-m-d H:i:s');
        $this->usuario        = $_POST['usuario'];

        $this->db->update('productos', $this, array('prod_id' => $_POST['prod_id']));
    }

    

}
?>