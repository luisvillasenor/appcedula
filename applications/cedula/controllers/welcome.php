<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

		session_start();

		parent::__construct();

		if ( !isset($_SESSION['username'])){

			redirect('admin'); // Redirecciona la controlador "admin"
		}

	}

	public function index(){
        $e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);		
		$this->load->view('welcome_view',$data);
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */