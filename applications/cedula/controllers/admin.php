<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	
	function __construct(){/* esta funcion sobre escribe el CI_Controller y toma PHP nativo*/

		parent::__construct();// Se hacer fererencia al "parent" que en este caso el CI_Controller
		
        session_start();
        // Con estas variables puedes verificar que la variable $_SESSION esta en CEROS
		//var_dump($_SESSION);
		//print_r($_SESSION);
		//$_SESSION['fc_if'] = $this->input->post('edicion');


	}

	
	public function index(){
		
		//echo sha1(appcedula); die();// Esta funcion te regresa el texto encriptado. Se usa tener un password encriptado*/
        //shal(appcedula) genera esta clave "61d9e6a73a4af25c650d07cd37609ff4bbb07c86"
		//echo APPPATH;// applications/authentication/ */
		//echo base_url();// http://10.1.17.10/appcedula/appcedula.php */
		//echo base_url();// http://10.1.17.10/ci21test/ */
		//var_dump($_SESSION['username']);
		//print_r($_SERVER);
		//echo '<pre>' . print_r(mcrypt_list_modes(), TRUE) . '<pre>';
		//$salt = 'LUIS';
		//print_r($password = $salt . md5('xxxxxx*') . $salt);

		$rol = '';
		
		if ( isset($_SESSION['username']) == FALSE ){
			//redirect('admin/login');
            $this->logout();

			//$this->load->view('login_view');
			//redirect(base_url());
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Dirección de Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('edicion', 'Edicion de Trabajo', 'required');


		if ( $this->form_validation->run() !== false ) {
			// Esta validacion paso OK. Obtenido de la BD

			$this->load->model('admin_model');
			
			// Security Layer
			// Filtering POST DATA
			$edicion = $this->input->post('edicion');
			$clean_edicion = $this->security->xss_clean($edicion);
			$email_address = $this->input->post('email_address');
			$clean_email_address = $this->security->xss_clean($email_address);			
			$password = $this->input->post('password');
			$clean_password = $this->security->xss_clean($password);	

			$res = $this->admin_model->verify_user($clean_email_address,$clean_password);
			
			if ( $res !== false){
				// la persona SI tiene una cuenta registrada en el sistema
				
				// Verifica el rol que tiene el usuario en el Sistema
				$rol['rol'] = $this->admin_model->verify_rol($clean_email_address,$clean_password);
				foreach ($rol['rol'] as $key => $value) {
					$clean_id 	 = $value->id;
                    $clean_grupo = $value->grupo;
                    $clean_coord = $value->id_coord;
				}

				// Actualiza fecha de ultimo acceso
				$this->admin_model->up_date($clean_id);
				
				# Se inicializan las variables de la SESION para validar el GRUPO en cada funcion del Controlador.
				switch ($clean_grupo) {
					case 'coordinador':
						$_SESSION['username'] = $clean_email_address;
						$_SESSION['grupo'] 	  = $clean_grupo;
                        $_SESSION['fc']       = $clean_edicion;
                        $_SESSION['id_coord'] = $clean_coord;
						redirect('actividades/');
						break;
					case 'gestor':
						$_SESSION['username'] = $clean_email_address;
						$_SESSION['grupo'] 	  = $clean_grupo;
                        $_SESSION['fc'] 	  = $clean_edicion;
                        $_SESSION['id_coord'] = $clean_coord;
						redirect('actividades/');
						break;
					case 'administrador':
						$_SESSION['username'] = $clean_email_address;
						$_SESSION['grupo'] 	  = $clean_grupo;
                        $_SESSION['fc'] 	  = $clean_edicion;
                        $_SESSION['id_coord'] = $clean_coord;
						redirect('actividades/');
						break;							
					default:
						echo '<div class="alert alert-block alert-error">';
						echo '<p>';
						echo 'Por favor solicite ayuda al administrador del sitio a la extensión 4336';
						echo '</p>';
						echo '<p>';
						echo '<a class="btn btn-danger" href="'.base_url('admin/logout').'">Cerrar</a>';
						echo '</p>';
						echo '</div>';
						//$this->logout();
						break;
				}
			}
		}
	}

	public function logout(){

		if ( isset($_SESSION['username']) == TRUE){

			$_SESSION['username'] = NULL;
			$_SESSION['grupo'] 	  = NULL;
            $_SESSION['fc'] 	  = NULL;
            $_SESSION['id_coord'] = NULL;
            unset(
            	$_SESSION['username'],
				$_SESSION['grupo'],
            	$_SESSION['fc'],
            	$_SESSION['id_coord']
            );
			session_destroy();
		
		}
		//CARGA LOGIN VIEW
		$this->load->model('fc_model');
		$data['get_fc'] = $this->fc_model->get_fc();
		$this->load->view('login_view',$data);
	}

	


}



/* End of file welcome.php */
/* Location: ./application/controllers/admin.php */