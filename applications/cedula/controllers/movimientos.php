<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Movimientos extends CI_Controller {
    
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
		$this->load->model('movimientos_model');
		$data['get_all_movs'] = $this->movimientos_model->get_all_movs();
		$this->load->view('movimientos_view',$data);
    }
    public function movimientos($id_act){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('movimientos_model');
		$data['get_all_movs'] = $this->movimientos_model->get_all_movs();
		$this->load->view('movimientos_view',$data);
	}
        
    /**** READ ONE ****/    
	public function edit_resp($id_mov){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('movimientos_model');
        $data['get_one_mov_edit'] = $this->movimientos_model->get_one_mov_edit($id_mov);        
        $this->load->view('movimientos_editar_view',$data);
	}
    
    /**** UPDATE ****/
	public function actualizar_resp(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        
        $id_mov = $this->input->post('id_mov');
        $responsable = $this->input->post('responsable');             
        
		$this->load->model('movimientos_model');        
		$this->movimientos_model->update_entry($id_mov,$responsable); 
        
        redirect('movimientos/index');
	}
    
    /**** CREATE ****/
    public function add_mov(){
        
        /** RECIBE DATOS DE LA SESION ACTIVA **/
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        /** RECIBE DATOS DEL FORMULARIO DE CAPTURA DE MOVIMIENTOS **/
        $id_act = $this->input->post('id_act'); /** Id de la cédula correspondiente **/
        $pres_soli = $this->input->post('pres_soli'); /** Id de la cédula correspondiente **/
        $tipo_mov = $this->input->post('tipo_mov'); /** Tipo del Movimiento **/
        $monto_mov = $this->input->post('monto_mov');/** Monto del movimiento **/
        $comm_mov = $this->input->post('comm_mov');/** Comentario del movimiento **/
        
        /** VALIDACION DE DATOS **/
        
        
        /** REGLAS DEL NEGOCIO **/        
        $this->load->model('movimientos_model');
        $this->load->model('actividades_model');
        
        /*if (!$this->movimientos_model->insert_entry($tipo_mov, $monto_mov, $comm_mov, $e_mail, $id_act)) {
            echo "HAY UN PROBLEMA AL REGISTRAR LOS DATOS EN LA BASE DE DATOS";
        }else{
            $data['movimientos'] = strstr($e_mail,'@',true);
            foreach() {
            
            }
            $this->actualizar_pres_soli();
        }*/
        
        //redirect('actividades/vista_previa/'id_act);
	}
    
    /**** VISTA TIPO FORMULARIO PARA CREATE ****/
	public function agregar_re(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->view('movimientos_agregar_view',$data);
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */