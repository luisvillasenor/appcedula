<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Promotores extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
		$this->load->helper("url");
        $this->load->library("pagination");

		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/indrex"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
	public function index(){
		$this->load->model('promotores_model');
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$config = array();
        $config["base_url"] = base_url() . "index.php/promotores/index";
        $config["total_rows"] = $this->promotores_model->record_count();
        $config["per_page"] = 10000;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['get_calif_pm'] = $this->promotores_model->get_calif_pm($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$this->load->view('promotores_view',$data);
	}
	public function export_promovidos(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		$data['export_promovidos'] = $this->promotores_model->export_promovidos();
		$this->load->view('export_promovidos',$data);
	}
	public function promotores_agregar_view(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('jefes_manzana_model');
		$data['get_all'] = $this->jefes_manzana_model->get_all();
		$this->load->view('promotores_agregar_view',$data);
	}	
	public function agregar_pr(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		$this->promotores_model->insert_entry();
		$this->load->view('is_ok_view',$data);
	}
	public function buscar_pr(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		//$res = $this->input->post('promotor');
		$data['get_pr'] = $this->promotores_model->get_one_pr();
		$this->load->view('promotor_one_view',$data);
	}
	public function editar_pr(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('jefes_manzana_model');
		$this->load->model('promotores_model');
		$data['get_all'] = $this->jefes_manzana_model->get_all();
		$data['get_pr'] = $this->promotores_model->get_pr();
		$this->load->view('promotores_editar_view',$data);
	}
	public function actualizar_pr(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		$this->promotores_model->update_entry();
		$this->load->view('is_ok_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */