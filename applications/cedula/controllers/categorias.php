<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categorias extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/indrex"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
    
    public function index()
    {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$this->load->view('categorias_view',$data);    
    }
	public function listar_categorias(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('categorias_model');
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
		$this->load->view('actividades_agregar_view',$data);
	}
    public function categorias_agregar_view()
    {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$this->load->view('categorias_agregar_view',$data);
    }
    public function add_cat(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $categoria = $this->input->post('categoria');
        $id_coord = $this->input->post('id_coord');
        
        $this->load->model('categorias_model');
        $this->categorias_model->insert_entry($categoria,$id_coord);
        
        redirect('categorias/index');
	}
    public function edit_cat($id_categoria){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $data['get_one_cat_edit'] = $this->categorias_model->get_one_cat_edit($id_categoria);
        $data['get_all'] = $this->coordinadores_model->get_all();
        $this->load->view('categorias_editar_view',$data);
	}
    public function actualizar_cat(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        $id_categoria = $this->input->post('id_categoria');
        $id_coord = $this->input->post('id_coord');
        $categoria = $this->input->post('categoria');             
        
		$this->load->model('categorias_model');        
		$this->categorias_model->update_entry($id_categoria,$id_coord,$categoria); 
        
        redirect('categorias/index');
	}

}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */