<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jefes_manzana extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/indrex"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
	public function index(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		$data['get_calif'] = $this->promotores_model->get_calif();
		$this->load->view('jefes_manzana_view',$data);
	}
	public function export_jm(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		$data['export_promotores'] = $this->promotores_model->export_promotores();
		$this->load->view('export_jm',$data);
	}
	public function agregar_jm(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_seccion_model');
		$data['get_all'] = $this->resp_seccion_model->get_all();
		$this->load->view('jefes_manzana_agregar_view',$data);
	}
	public function buscar_jm(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('promotores_model');
		//$res = $this->input->post('promotor');
		$data['get_one_jm'] = $this->promotores_model->get_one_jm();
		$this->load->view('jefes_manzana_one_view',$data);
	}
	public function editar_jm(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_seccion_model');
		$this->load->model('jefes_manzana_model');
		$data['get_all'] = $this->resp_seccion_model->get_all();
		$data['get_jm'] = $this->jefes_manzana_model->get_jm();
		$this->load->view('jefes_manzana_editar_view',$data);
	}
	public function actualizar_jm(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('jefes_manzana_model');
		$this->jefes_manzana_model->update_entry();
		$this->load->view('is_ok_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */