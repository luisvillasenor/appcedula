<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Compras extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
        $this->load->model('fc_model');
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/index"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
	public function index(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		//$this->load->model('actividades_model');
		//$data['get_calif'] = $this->resp_zona_model->get_calif();
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('actividades_view',$data);
	}
	public function agregar_nec(){
		$e_mail = $_SESSION['username'];
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
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
		$this->load->view('necesidades_agregar_view',$data);
	}
    public function add_nec(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $total = '';
        $total_iva = '';
        $gran_total = '';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $id_act = $this->input->post('id_act');
        $e_mail = $this->input->post('e_mail');
        $actividad = $this->input->post('actividad');
        $descripcionec = $this->input->post('descripcionec');
        $descripcion = $this->input->post('descripcion');
        $justificacion = $this->input->post('justificacion');
        $id_categoria = $this->input->post('id_categoria');
        $quienpropone = $this->input->post('quienpropone');
        $empresa = $this->input->post('empresa');
        $puesto = $this->input->post('puesto');
        $domicilio = $this->input->post('domicilio');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $web = $this->input->post('web');
        $fecha_act = $this->input->post('fecha_act');
        $fecha_aut = $this->input->post('fecha_aut');
        $costo_secture = $this->input->post('costo_secture');
        $costo_publico = $this->input->post('costo_publico');
        $is_costo_secture = $this->input->post('is_costo_secture');
        $is_costo_publico = $this->input->post('is_costo_publico');
        $ubicacion = $this->input->post('ubicacion');
        $id_coord = $this->input->post('id_coord');
        $status_act = $this->input->post('status_act');
        $d1 = $this->input->post('d1');
        $d2 = $this->input->post('d2');
        $d3 = $this->input->post('d3');
        $d4 = $this->input->post('d4');
        $d5 = $this->input->post('d5');
        $d6 = $this->input->post('d6');
        $d7 = $this->input->post('d7');
        $d8 = $this->input->post('d8');
        $d9 = $this->input->post('d9');
        $d10 = $this->input->post('d10');
        $hora_ini = $this->input->post('hora_ini');
        $hora_fin = $this->input->post('hora_fin');
        
        $this->load->model('necesidades_model');
        $this->necesidades_model->insert_entry($id_act);
        $this->load->model('actividades_model');
        
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        foreach ($data['get_total_act'] as $tot ) : 
            $total += $tot->total_act; 
        endforeach;        
        $this->actividades_model->update_tot_act($id_act,$e_mail,$total,$actividad,$descripcion,$justificacion,$id_categoria,$quienpropone,$empresa,$puesto,$domicilio,$telefono,$email,$web,$fecha_act,$fecha_aut,$costo_secture,$costo_publico,$is_costo_secture,$is_costo_publico,$ubicacion,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$hora_ini,$hora_fin,$id_coord,$status_act);
                
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $this->load->view('necesidades_view',$data);
	}
    public function edit_nec($id_act,$id_nec){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('necesidades_model');
        $this->load->model('actividades_model');  
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_one_nec_edit'] = $this->necesidades_model->get_one_nec_edit($id_nec);
        $this->load->view('necesidades_editar_view',$data);
	}
	public function buscar_nec(){
		$e_mail = $_SESSION['username'];
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
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
		$this->load->view('coordinador_one_view',$data);
	}
    public function editar_nec(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $id_nec = $this->input->post('id_nec');
		$data['get_one_nec_edit'] = $this->necesidades_model->get_one_nec_edit($id_nec);
		$this->load->view('necesidades_editar_view',$data);
	}
	public function actualizar_nec(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $total = '';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        $id_act = $this->input->post('id_act');
        $e_mail = $this->input->post('e_mail');
        $actividad = $this->input->post('actividad');
        $descripcionec = $this->input->post('descripcionec');
        $descripcion = $this->input->post('descripcion');
        $justificacion = $this->input->post('justificacion');
        $id_categoria = $this->input->post('id_categoria');
        $quienpropone = $this->input->post('quienpropone');
        $empresa = $this->input->post('empresa');
        $puesto = $this->input->post('puesto');
        $domicilio = $this->input->post('domicilio');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $web = $this->input->post('web');
        $fecha_act = $this->input->post('fecha_act');
        $fecha_aut = $this->input->post('fecha_aut');
        $costo_secture = $this->input->post('costo_secture');
        $costo_publico = $this->input->post('costo_publico');
        $is_costo_secture = $this->input->post('is_costo_secture');
        $is_costo_publico = $this->input->post('is_costo_publico');
        $ubicacion = $this->input->post('ubicacion');
        $id_coord = $this->input->post('id_coord');
        $status_act = $this->input->post('status_act');
        $d1 = $this->input->post('d1');
        $d2 = $this->input->post('d2');
        $d3 = $this->input->post('d3');
        $d4 = $this->input->post('d4');
        $d5 = $this->input->post('d5');
        $d6 = $this->input->post('d6');
        $d7 = $this->input->post('d7');
        $d8 = $this->input->post('d8');
        $d9 = $this->input->post('d9');
        $d10 = $this->input->post('d10');
        $hora_ini = $this->input->post('hora_ini');
        $hora_fin = $this->input->post('hora_fin');
        
		$this->load->model('necesidades_model');
		$this->necesidades_model->update_entry($e_mail);
        
        $this->load->model('actividades_model');        
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        foreach ($data['get_total_act'] as $tot ) : 
            $total += $tot->total_act;
        endforeach;        
        $this->actividades_model->update_tot_act($id_act,$e_mail,$total,$actividad,$descripcion,$justificacion,$id_categoria,$quienpropone,$empresa,$puesto,$domicilio,$telefono,$email,$web,$fecha_act,$fecha_aut,$costo_secture,$costo_publico,$is_costo_secture,$is_costo_publico,$ubicacion,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$hora_ini,$hora_fin,$id_coord,$status_act);
                
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $this->load->view('necesidades_view',$data);
        
		
	}
    public function necesidades_act(){
		$e_mail = $_SESSION['username'];
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
		//$this->load->model('coordinadores_model');
		//$this->coordinadores_model->update_entry();
		$this->load->view('necesidades_view',$data);
	}
    
    public function borrar_nec()
    {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $total = '';
        $id_nec = $this->input->post('id_nec');
		$this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->necesidades_model->delete($id_nec);
        
        $id_act = $this->input->post('id_act');
        $e_mail = $this->input->post('e_mail');
        $actividad = $this->input->post('actividad');
        //$descripcionec = $this->input->post('descripcionec');
        $descripcion = $this->input->post('descripcion');
        $justificacion = $this->input->post('justificacion');
        $id_categoria = $this->input->post('id_categoria');
        $quienpropone = $this->input->post('quienpropone');
        $empresa = $this->input->post('empresa');
        $puesto = $this->input->post('puesto');
        $domicilio = $this->input->post('domicilio');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $web = $this->input->post('web');
        $fecha_act = $this->input->post('fecha_act');
        $fecha_aut = $this->input->post('fecha_aut');
        $costo_secture = $this->input->post('costo_secture');
        $costo_publico = $this->input->post('costo_publico');
        $is_costo_secture = $this->input->post('is_costo_secture');
        $is_costo_publico = $this->input->post('is_costo_publico');
        $ubicacion = $this->input->post('ubicacion'); 
        $id_coord = $this->input->post('id_coord'); 
        $status_act = $this->input->post('status_act'); 
        $d1 = $this->input->post('d1'); 
        $d2 = $this->input->post('d2'); 
        $d3 = $this->input->post('d3'); 
        $d4 = $this->input->post('d4'); 
        $d5 = $this->input->post('d5'); 
        $d6 = $this->input->post('d6'); 
        $d7 = $this->input->post('d7'); 
        $d8 = $this->input->post('d8'); 
        $d9 = $this->input->post('d9'); 
        $d10 = $this->input->post('d10'); 
        $hora_ini = $this->input->post('hora_ini'); 
        $hora_fin = $this->input->post('hora_fin'); 
        
		      
        $this->load->model('actividades_model');        
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        foreach ($data['get_total_act'] as $tot ) : 
            $total += $tot->total_act;
        endforeach;        
        $this->actividades_model->update_tot_act($id_act,$e_mail,$total,$actividad,$descripcion,$justificacion,$id_categoria,$quienpropone,$empresa,$puesto,$domicilio,$telefono,$email,$web,$fecha_act,$fecha_aut,$costo_secture,$costo_publico,$is_costo_secture,$is_costo_publico,$ubicacion,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$hora_ini,$hora_fin,$id_coord,$status_act);
                
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail);
        $this->load->view('necesidades_view',$data);
    }
     public function is_borrar_nec($id_act,$id_nec)
    {
        $e_mail = $_SESSION['username'];
         $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('necesidades_model');
        $this->load->model('actividades_model');
         $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
		$data['get_one_nec_edit'] = $this->necesidades_model->get_one_nec_edit($id_nec);
        $this->load->view('is_necesidad_view',$data);
    }
    
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */