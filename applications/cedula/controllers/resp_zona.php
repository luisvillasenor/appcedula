<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Resp_zona extends CI_Controller {
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
		$this->load->model('resp_seccion_model');
		$data['get_calif'] = $this->resp_seccion_model->get_calif();
		$this->load->view('resp_zona_view',$data);
	}
	public function export_rz(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_seccion_model');
		$data['export_resp_zona'] = $this->resp_seccion_model->export_resp_zona();
		$this->load->view('export_rz',$data);
	}
	public function agregar_rz(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
		$data['get_all'] = $this->coordinadores_model->get_all();
		$this->load->view('resp_zona_agregar_view',$data);
	}
	public function buscar_rz(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_seccion_model');
		//$res = $this->input->post('promotor');
		$data['get_one_rz'] = $this->resp_seccion_model->get_one_rz();
		$this->load->view('resp_zona_one_view',$data);
	}
	public function editar_rz(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
		$this->load->model('resp_zona_model');
		$data['get_all'] = $this->coordinadores_model->get_all();
		$data['get_rz'] = $this->resp_zona_model->get_rz();
		$this->load->view('resp_zona_editar_view',$data);
	}
	public function actualizar_rz(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('resp_zona_model');
		$this->resp_zona_model->update_entry();
		$this->load->view('is_ok_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */