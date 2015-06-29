<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	

	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */

		//session_cache_expire(15);
		//$cache_expire = session_cache_expire();

		session_start();

		parent::__construct();

		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/indrex"
		}

		//var_dump(session_get_cookie_params()); //Muestra el valor de la variable

	}

	public function index(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->view('proveedores_view',$data);
			
	}

	

	public function proveedores(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);
		
 
		$this->load->view('proveedores_view',$data);
	}

	public function agregar_pv(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);
		
 
		$this->load->view('proveedores_agregar_view',$data);
	}

	public function agregar_pv2(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('proveedores_model');

		$this->proveedores_model->insert_entry();

		$this->proveedores();


	}


















	public function reporte_proveedores(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('proveedores_model');

		$data['get_all_proveedores'] = $this->proveedores_model->get_all_proveedores();
		

		$this->load->view('reportes_proveedores_view',$data);


	}








	public function seguimiento(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		$this->load->model('solicitudes_model');
		$this->load->model('referencias_model');

		$data['get_all_referencias'] = $this->referencias_model->get_all();
		$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
		$data['get_all_solicitudes'] = $this->solicitudes_model->get_all_solicitudes(); 

		$this->load->view('seguimiento_view',$data);


	}

	public function entradas(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		$this->load->model('solicitudes_model');
		$this->load->model('referencias_model');

		$data['get_all_referencias'] = $this->referencias_model->get_all();
		$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
		$data['get_all_solicitudes'] = $this->solicitudes_model->get_all_solicitudes(); 

		$this->load->view('entradas_view',$data);


	}


	public function productox(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('proveedores_model');

		$data['get_last_ten_prods'] = $this->proveedores_model->get_last_ten_prods();
		

		$this->load->view('productox_view',$data);


	}


	public function buscar_proveedores(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('proveedores_model');

		$texto = $this->input->post('texto');

		$data['get_last_ten_prods'] = $this->proveedores_model->search_proveedores($texto);
		

		$this->load->view('productox_view',$data);


	}

	public function buscar_codigo(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('proveedores_model');

		$codigo = $this->input->post('codigo');

		$data['search_codigo'] = $this->proveedores_model->search_codigo($codigo);
		

		$this->load->view('entradas_view',$data);


	}

	public function salidas(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		$this->load->model('solicitudes_model');
		$this->load->model('referencias_model');

		$data['get_all_referencias'] = $this->referencias_model->get_all();
		$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
		$data['get_all_solicitudes'] = $this->solicitudes_model->get_all_solicitudes(); 

		$this->load->view('salidas_view',$data);


	}

	public function endesarrollo(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		$this->load->model('solicitudes_model');
		$this->load->model('referencias_model');

		$data['get_all_referencias'] = $this->referencias_model->get_all();
		$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
		$data['get_all_solicitudes'] = $this->solicitudes_model->get_all_solicitudes(); 

		$this->load->view('endesarrollo_view',$data);


	}












	//////////////////////////////////////////////////////////////////////////////////////
	
	

}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */