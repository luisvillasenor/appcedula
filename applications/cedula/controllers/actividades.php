<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actividades extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
        $this->load->library('email');
        $this->load->model('fc_model');
		if ( !isset($_SESSION['username'])){
			redirect(base_url('admin/logout')); // Redirecciona la controlador "admin/logout"
		}
	}
	public function index(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        
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
        $this->load->view('actividades_view',$data);
        $this->load->view('footer_view',$data); 
	}
    public function resumen(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        //$data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        // Numero de Registros Totales
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        // Numero de Registros Pendientes
        $data['get_regs_pendientes'] = $this->actividades_model->get_regs_pendientes($e_mail,$id_coord);
        foreach ($data['get_regs_pendientes'] as $regs_p ) {
            $data['num_regs_p']= $regs_p->tot;                        
        }
        // Numero de Registros Aprobados
        $data['get_regs_aprobados'] = $this->actividades_model->get_regs_aprobados($e_mail,$id_coord);
        foreach ($data['get_regs_aprobados'] as $regs_a ) {
            $data['num_regs_a']= $regs_a->tot;                        
        }
        // Numero de Registros No Aprobados
        $data['get_regs_Noaprobados'] = $this->actividades_model->get_regs_Noaprobados($e_mail,$id_coord);
        foreach ($data['get_regs_Noaprobados'] as $regs_Noa ) {
            $data['num_regs_Noa']= $regs_Noa->tot;                        
        }
                
		$this->load->view('header_view',$data); 
        $this->load->view('resumen_view',$data);
        $this->load->view('footer_view',$data); 
	}
    /***** FUNCIONES PARA EL FILTRO DE CÉDULAS *****/
    public function ordenar_id_asc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_orderbyID_asc'] = $this->actividades_model->get_all_orderbyID_asc($e_mail,$grupo,$id_coord);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_id_asc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_id_desc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$data['get_all_orderbyID_desc'] = $this->actividades_model->get_all_orderbyID_desc($e_mail,$grupo,$id_coord);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_id_desc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_act_asc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$data['get_all_orderbyACT_asc'] = $this->actividades_model->get_all_orderbyACT_asc($e_mail,$grupo,$id_coord);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_act_asc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_act_desc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$data['get_all_orderbyACT_desc'] = $this->actividades_model->get_all_orderbyACT_desc($e_mail,$grupo,$id_coord);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        
		$this->load->view('header_view',$data);
        $this->load->view('actividades_order_act_desc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function filtrar_status($status){ 
		/* Variables de SESSION */
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        /* Variables de la Página */
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		/* Cargar Módulos */
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        /* Variables tipo Array para almacenar las consultas a la base de datos */
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();        
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        $data['get_all_status'] = $this->actividades_model->get_all_status($e_mail,$grupo,$id_coord,$status);
        /* Reglas del Negocio */
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        /* Cargar Vistas para el Usuario */        
		$this->load->view('header_view',$data); 
        $this->load->view('filtrar_status_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    
    
    //************************************//
    //*    VISTA: AGREGAR NUEVA CEDULA   *//
    
	public function agregar_act(){
		
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('categorias_model');// LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
        $this->load->model('coordinadores_model');
            
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        // VALIDACION DEL FORMULARIO Y REGLAS
        $this->form_validation->set_rules('actividad', 'Actividad', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		
        
        if ($this->form_validation->run() == FALSE)
		{
            echo validation_errors();
			$this->load->view('actividades_agregar_view',$data);
		}
		else
		{
			$this->load->view('formsuccess');
		}
        
		
	}
    
    //************************************//
    
    public function insert_act(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->actividades_model->insert_entry($e_mail);
        redirect('actividades/');
	}
	public function buscar_act(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$txt = $this->input->post('txt');
		$data['get_one_act'] = $this->actividades_model->get_one_act($txt,$e_mail);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        
        $this->load->view('header_view',$data);
        $this->load->view('actividades_one_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_resp(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$txt = $this->input->post('email');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
		$data['get_filtro_por_resp'] = $this->actividades_model->get_filtro_por_resp($txt,$grupo,$id_coord);
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_resp_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$id_act = $this->input->post('id_act');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
		$data['get_filtro_por_ced'] = $this->actividades_model->get_filtro_por_ced($id_act,$grupo,$id_coord);
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_resumen_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$id_act = $this->input->post('id_act');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        // Numero de Registros Pendientes
        $data['get_regs_pendientes'] = $this->actividades_model->get_regs_pendientes($e_mail,$id_coord);
        foreach ($data['get_regs_pendientes'] as $regs_p ) {
            $data['num_regs_p']= $regs_p->tot;                        
        }
        // Numero de Registros Aprobados
        $data['get_regs_aprobados'] = $this->actividades_model->get_regs_aprobados($e_mail,$id_coord);
        foreach ($data['get_regs_aprobados'] as $regs_a ) {
            $data['num_regs_a']= $regs_a->tot;                        
        }
        // Numero de Registros No Aprobados
        $data['get_regs_Noaprobados'] = $this->actividades_model->get_regs_Noaprobados($e_mail,$id_coord);
        foreach ($data['get_regs_Noaprobados'] as $regs_Noa ) {
            $data['num_regs_Noa']= $regs_Noa->tot;                        
        }
		$data['get_filtro_res_ced'] = $this->actividades_model->get_filtro_res_ced($id_act,$grupo,$id_coord);
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_resumen_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_coord(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$id_coord = $this->input->post('id_coord');
        $data['get_master_plan_coord'] = $this->actividades_model->get_master_plan_coord($id_coord);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan();
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_coord_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_categoria(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$id_categoria = $this->input->post('id_categoria');
        $data['get_master_plan_categoria'] = $this->actividades_model->get_master_plan_categoria($id_categoria);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan();
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_categoria_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$id_act = $this->input->post('id_act');
        $data['get_master_plan_cedula'] = $this->actividades_model->get_master_plan_cedula($id_act);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan();
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}
	
    public function editar_actividad($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        // LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
		$this->load->view('actividades_editar_view',$data);
	}
    public function editar_fechas_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('categorias_model');
        $this->load->model('horarios_model');
        $this->load->model('coordinadores_model');
        
        // LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_horarios'] = $this->horarios_model->get_horarios();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
		$this->load->view('fechas_editar_view',$data);
	}
	public function actualizar_act(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        
        $id_act = $this->input->post('id_act');

        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		
        $is_ok = $this->actividades_model->update_entry($e_mail);        
        if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
            $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
            $this->load->view('is_ok_view',$data);
        }
        
        redirect('actividades/');
		
	}
    public function actualizar_tot_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$is_ok = $this->actividades_model->update_tot_act();
		if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
            $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
            $this->load->view('is_ok_view',$data);
        }
        redirect('actividades/');
        
	}
    public function necesidades_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('necesidades_view',$data);
	}
    public function comentarios_act($id_act){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
		$this->load->model('actividades_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
		$this->load->view('comentarios_view',$data);
	}
    public function order_by_encargado_asc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$id_act = $this->input->post('id_act');
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('necesidades_view',$data);
	}
    public function mis_cotizaciones($year = null, $month = null){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('endesarrollo_view',$data);		
	}
    public function cotizaciones_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('cotizaciones_view',$data);
	}
    public function calendario_act()
    {
    	$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $data['get_cal_act'] = $this->actividades_model->get_cal_act($e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('cal_act_view',$data);        
    }
    public function tree_file_view()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->view('tree_file_view',$data);        
    }
    public function vista_previa($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('vista_previa_view',$data);	
	}
    public function master_plan(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $data['title']= 'Master Plan del Festival de Calaveras';
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        
        // Código que pone en el encabezado de la página la Coordinación del Usuario.
        /////////////////////////////////////////////////////////////////////////////
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        /////////////////////////////////////////////////////////////////////////////
        
        $data['get_master_plan'] = $this->actividades_model->get_master_plan();
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all'] = $this->necesidades_model->get_all();
                
        $this->load->view('header_view',$data);
        $this->load->view('master_plan_view',$data);
        $this->load->view('footer_view',$data);
	}
    
    
    
    
    
    
    
    public function is_borrar_act($id_act)
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');  
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('is_actividad_view',$data);
    }
    public function borrar_act($id_act)
    {
        $this->load->model('actividades_model');
        $this->actividades_model->delete($id_act);
        redirect('actividades/');
    }
    public function en_desarrollo()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('endesarrollo_view',$data);	
    }
    
    public function tutorial()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('header_view',$data); 
        $this->load->view('tutorial_view',$data);
        $this->load->view('footer_view',$data);
        
    }
    
    public function padron_proveedores(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $data['title']= 'Padrón Único de Proveedores del Estado de Aguascalientes';
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('header_view',$data); 
        $this->load->view('padron_proveedores_view',$data);
        $this->load->view('footer_view',$data);
        
	}
    
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //////////////// NOTIFICAR POR EMAIL ///////////////
    
    function notificar_msg()
	{

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'sectureags@gmail.com';
    $config['smtp_pass']    = 'sECTUREd1';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);


    $this->email->from('appadmin@app.com', 'SECTURE');
    $this->email->to('luis.villasenor@aguascalientes.gob.mx'); 

    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');  

    $this->email->send();

    echo $this->email->print_debugger();

	}
    
    
    
    public function si_autorizar(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $succes  = $this->input->post('succes');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->si_autorizar($id_act,$succes);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_aprobacion($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function si_integrado(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $integrado  = $this->input->post('integrado');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->integrado($id_act,$integrado);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_integrado($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function si_presupuestado(){ 
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $presupuestado  = $this->input->post('presupuestado');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->presupuestado($id_act,$presupuestado);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_presupuestado($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function no_autorizar(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'No Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $fail = $this->input->post('fail');
        $id_act = $this->input->post('id_act');
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->no_autorizar($id_act,$fail);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function pendiente(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'No Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $pend = $this->input->post('pend');
        $id_act = $this->input->post('id_act');
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->pendiente($id_act,$pend);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    
    /* NOTIFICA POR MAIL LA APROBACION CONCEPTUAL DE LA CEDULA */
    function notificar_aprobacion($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'sectureags@gmail.com';
    $config['smtp_pass']    = 'sECTUREd1';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'APROBACIÓN CONCEPTUAL');
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, jorge.andrade@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 
    

    $this->email->subject('APROBACIÓN CONCEPTUAL DE LA CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>APROBADO CONCEPTUAL</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar al <a href="http://10.1.17.10/appcedula/admin/logout">Sistema de Control de Cedulas</a></p>
            
            <p><small>No responda a este mail, se envía desde un buzón no-supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una Orden de Servicio al Departamento de Informática aquí <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Ordenes de Servicio</a></small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
    
    /* NOTIFICA POR MAIL LA INTEGRACION AL PROGRAMA GENERAL DEL FESTIVAL DE CALAVERAS */
    function notificar_integrado($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'sectureags@gmail.com';
    $config['smtp_pass']    = 'sECTUREd1';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'INTEGRACION AL PROGRAMA GENERAL DEL FESTIVAL DE CALAVERAS');
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, jorge.andrade@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 
    

    $this->email->subject('INTEGRADO AL PROGRAMA GENERAL LA CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>INTEGRADO AL PROGRAMA GENERAL</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar al <a href="http://10.1.17.10/appcedula/admin/logout">Sistema de Control de Cedulas</a></p>
            
            <p><small>No responda a este mail, se envía desde un buzón no-supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una Orden de Servicio al Departamento de Informática aquí <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Ordenes de Servicio</a></small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
    
    /* NOTIFICA POR MAIL LA AUTORIZACION DEL PRESUPUESTO DE LA CEDULA  */
    function notificar_presupuestado($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'sectureags@gmail.com';
    $config['smtp_pass']    = 'sECTUREd1';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'PRESUPUESTO AUTORIZADO DE SU CEDULA');
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, jorge.andrade@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx,blanca.martinez@aguascalientes.gob.mx,oscar.morales@aguascalientes.gob.mx'); 
    

    $this->email->subject('PRESUPUESTO AUTORIZADO CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>PRESUPUESTO AUTORIZADO</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar al <a href="http://10.1.17.10/appcedula/admin/logout">Sistema de Control de Cedulas</a></p>
            
            <p><small>No responda a este mail, se envía desde un buzón no-supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Orden de Servicio</a> al Departamento de Informática.</small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
    
    
    public function actualizar_pres(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
        $id_act = $this->input->post('id_act');
        $pres_ant = $this->input->post('pres_ant');
        $pres_soli = $this->input->post('pres_soli');
        $pres_aut = $this->input->post('pres_aut');
        $pres_eje = $this->input->post('pres_eje');
        
        $is_ok = $this->actividades_model->act_pres_ant($id_act,$pres_ant,$pres_soli,$pres_aut,$pres_eje);
        if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);            
		    $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);            
            $this->load->view('is_ok_view',$data);
        }
        
        $this->vista_previa($id_act);        
        
	}
    
    public function actualizar_movs(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        $id_act = $this->input->post('id_act');
        $pres_soli = $this->input->post('pres_soli');
                
        $data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
                
        $this->vista_previa($id_act);        
        
	}
    
    
    
    
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */