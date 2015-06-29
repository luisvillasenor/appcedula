<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Responsables extends CI_Controller {
    
    /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
	public function __construct(){ 
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/index"
		}
	}
        
    /***********************************************************/
    /***********************************************************/
    /***********************   C R U D   ***********************/
    /***********************************************************/
    /***********************************************************/
    
    /**** READ ALL ****/    
    public function index(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('users_model');
		$data['get_all_users'] = $this->users_model->get_all_users();
		$this->load->view('responsables_view',$data);
	}    
        
    /**** READ ONE ****/    
	public function edit_resp($id_resp){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('responsables_model');
        $data['get_one_resp_edit'] = $this->responsables_model->get_one_resp_edit($id_resp);        
        $this->load->view('responsables_editar_view',$data);
	}
    
    /**** UPDATE ****/
	public function actualizar_resp(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        
        $id_resp = $this->input->post('id_resp');
        $responsable = $this->input->post('responsable');             
        
		$this->load->model('responsables_model');        
		$this->responsables_model->update_entry($id_resp,$responsable); 
        
        redirect('responsables/index');
	}
    
    /**** CREATE ****/
    public function add_resp(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $responsable = $this->input->post('responsable');
        //$id_fc = 4; // el id_fc representa la edicion correspondiente. Ver Tabla "fc"
        
        $this->load->model('responsables_model');
        $this->responsables_model->insert_entry($responsable);
        
        redirect('responsables/index');
	}
    
    /**** CREATE ****/
	public function agregar_re(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->view('responsables_agregar_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */