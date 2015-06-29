<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Comentarios extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
        $this->load->library('email');
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
        $data['title']= 'Comentarios';
		$this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$data['get_all_com'] = $this->comentarios_model->get_all_com();
        
        $this->load->view('header_view',$data); 
        $this->load->view('all_comentarios_view',$data);
        $this->load->view('footer_view',$data); 
		
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
	public function agregar_com(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('comentarios_model');
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
		$this->load->view('comentarios_agregar_view',$data);
	}
    public function add_com(){
		$e_mail = $_SESSION['username'];// Usuario en Session
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $id_act = $this->input->post('id_act');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
        $comentarios = $this->input->post('comentarios');
        $actividad = $this->input->post('actividad');
        $this->load->model('comentarios_model');
        $this->load->model('actividades_model');
        $this->load->model('users_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        $this->comentarios_model->insert_entry($id_act,$comentarios,$e_mail,$usuario);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
    
                        if($usuario == $usrs->email_address) {
                            
                            $autor = $usrs->email_notify;
                        }
        }
        $this->notificar_msg($id_act,$comentarios,$e_mail,$autor,$actividad);
                
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        
        $this->load->view('comentarios_view',$data);
	}
    public function agregar_com_preview(){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('comentarios_model');
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
		$this->load->view('comentarios_agregar_preview',$data);
	}
    public function add_com_preview(){
		$e_mail = $_SESSION['username'];// Usuario en Session
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $id_act = $this->input->post('id_act');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
        $comentarios = $this->input->post('comentarios');        
        $actividad = $this->input->post('actividad');
        $this->load->model('comentarios_model');
        $this->load->model('actividades_model');
        $this->load->model('users_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        $this->comentarios_model->insert_entry($id_act,$comentarios,$e_mail,$usuario);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
    
                        if($usuario == $usrs->email_address) {
                            
                            $autor = $usrs->email_notify;
                        }
        }
        $this->notificar_msg($id_act,$comentarios,$e_mail,$autor,$actividad);
                
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        
        //$this->load->view('comentarios_view',$data);
        redirect('actividades/vista_previa/'.$id_act.'');
	}
    public function edit_com($id_act,$id_com){
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
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_one_com_edit'] = $this->comentarios_model->get_one_com_edit($id_com);
        $this->load->view('comentarios_editar_view',$data);
	}
	
	public function actualizar_com(){
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
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $id_act = $this->input->post('id_act');
        $id_com = $this->input->post('id_com');
        $dueno = $this->input->post('dueno');
        $comentarios = $this->input->post('comentarios');        		
		$this->comentarios_model->update_entry($id_com,$id_act,$comentarios,$e_mail,$dueno);                        
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);        
        $this->load->view('comentarios_view',$data);	
	} 
    
    function notificar_msg($id_act,$comentarios,$e_mail,$autor,$actividad)
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
    $config['validate'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, $e_mail);
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, jorge.andrade@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 
    

    $this->email->subject('NUEVO COMENTARIO EN CEDULA NO. '.$id_act.' - '.$actividad);
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
            </style>
            </head>
            <body>
            
            <h3>Tiene un nuevo comentario.</h3>
            
            <table>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$actividad.'</td>
            </tr>
            <tr>
              <th>Publicado por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>
            <tr>
              <th>Comentario:</th>
              <td>'.$comentarios.'</td>
            </tr>
            </table>
            
            <p>Para agregar un nuevo comentario debe accesar al <a href="http://10.1.17.10/appcedula/admin/logout">Sistema de Control de Cedulas</a></p>
            
            <p><small>No responda a este mail, se envia desde un buzon no-supervisado. Este mail se envia con copia para los Coordinadores Generales</small></p>
            
            <p><small>Para mayor informacion sobre este mail solicite ayuda tecnica a la extension 4336</small></p>
            
            </body>
            </html>
            
            ');  

    $this->email->send();

    //echo $this->email->print_debugger();

     

	}
    
    
    
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */