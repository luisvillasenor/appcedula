<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resp_seccion extends CI_Controller {
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
		$this->load->model('jefes_manzana_model');
		$data['get_calif'] = $this->jefes_manzana_model->get_calif();
		$this->load->view('resp_seccion_view',$data);
	}
	public function export_rs(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('jefes_manzana_model');
		$data['export_jefes_manzana'] = $this->jefes_manzana_model->export_jefes_manzana();
		$this->load->view('export_rs',$data);
	}
	public function agregar_rs(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_zona_model');
		$data['get_all'] = $this->resp_zona_model->get_all();
		$this->load->view('resp_seccion_agregar_view',$data);
	}
	public function buscar_rs(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('jefes_manzana_model');
		//$res = $this->input->post('promotor');
		$data['get_one_rs'] = $this->jefes_manzana_model->get_one_rs();
		$this->load->view('resp_seccion_one_view',$data);
	}
	public function editar_rs(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_zona_model');
		$this->load->model('resp_seccion_model');
		$data['get_all'] = $this->resp_zona_model->get_all();
		$data['get_rs'] = $this->resp_seccion_model->get_rs();
		$this->load->view('resp_seccion_editar_view',$data);
	}
	public function actualizar_rs(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_seccion_model');
		$this->resp_seccion_model->update_entry();
		$this->load->view('is_ok_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */