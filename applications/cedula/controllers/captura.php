<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Captura extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/index"
		}
		//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
	public function index(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		//$this->load->model('resp_zona_model');
		//$this->load->model('resp_seccion_model');
		//$this->load->model('jefes_manzana_model');
		//$this->load->model('promotores_model');
		//$data['get_calif_rz'] = $this->resp_zona_model->get_calif();
		//$data['get_calif_rs'] = $this->resp_seccion_model->get_calif_total();
		//$data['get_calif_jm'] = $this->jefes_manzana_model->get_calif_total();
		//$data['get_calif_pr'] = $this->promotores_model->get_calif_pr();
		//$data['get_calif_pro'] = $this->promotores_model->get_calif_pro();
		$this->load->view('actividades_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */