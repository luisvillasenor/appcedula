<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Movimientos extends CI_Controller {
    
    /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
	public function __construct(){ 
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/index"
		}
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('movimientos_model');
        $this->load->model('fc_model');
	}
        
    /***********************************************************/
    /***********************************************************/
    /***********************   C R U D   ***********************/
    /***********************************************************/
    /***********************************************************/
    
    /**** READ ALL ****/
    public function index(){        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['title']= 'Gestion de Presupuesto';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
                
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
                
        $this->load->view('header_view',$data); 
        $this->load->view('movimientos_view',$data);
        $this->load->view('footer_view',$data); 
    }        

    public function movimientos($id_act){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		
		$data['get_all_movs'] = $this->movimientos_model->get_all_movs();
		$this->load->view('movimientos_view',$data);
	}
        
    /**** READ ONE ****/    
	public function edit_resp($id_mov){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $data['get_one_mov_edit'] = $this->movimientos_model->get_one_mov_edit($id_mov);        
        $this->load->view('movimientos_editar_view',$data);
	}
    
    /**** UPDATE ****/
	public function actualizar_resp(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        
        $id_mov = $this->input->post('id_mov');
        $responsable = $this->input->post('responsable');             
        
		      
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