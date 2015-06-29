<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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
			redirect(base_url()); // Redirecciona la controlador "admin"
		}

		//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
	}
    public function index(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('users_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$data['get_all_users'] = $this->users_model->get_all_users();
		$this->load->view('responsables_view',$data);
	}
    public function edit_resp($id){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('users_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_one_usr_edit'] = $this->users_model->get_one_usr_edit($id);        
        $this->load->view('responsables_editar_view',$data);
	}
    public function actualizar_resp(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $email_address = $this->input->post('email_address');
        $email_notify = $this->input->post('email_notify');
        $password = $this->input->post('password');
        $fecha_creacion = $this->input->post('fecha_creacion');
        $grupo = $this->input->post('grupo');
        $id_coord = $this->input->post('id_coord');
        
		$this->load->model('users_model');
        $this->load->model('coordinadores_model');
        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        
		$this->users_model->update_entry($id,$nombre,$apellido,$email_address,$email_notify,$password,$fecha_creacion,$grupo,$id_coord); 
        
        redirect('users/index');
	}

	public function agregar(){

		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->helper(array('form','url'));
		
		$this->load->model('users_model');
        $this->load->model('coordinadores_model');
        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$this->users_model->insert_entry();
        
        redirect('users/index');	
		
	}
    public function agregar_usr(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$this->load->view('responsables_agregar_view',$data);
    }

	public function actualizar(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('users_model');

		$this->users_model->update_entry($this->input->post('id'));

		redirect('users/ver_miembros');
		
	}

	public function detalle(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('users_model');
		
		$data['get_one_ciudadano'] = $this->users_model->get_one_ciudadano($id);

		$this->load->view('captura_view',$data);
		
	}


	public function ver_miembros(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('users_model');
		
		$data['get_all_users'] = $this->users_model->get_all_users();

		$this->load->view('zona_miembros',$data);
		
	}





	
	function solicitar_autorizacion()
	{
		$this->load->model('bienesoservicios_model');

		// Configuracion para el envio de email utilizando GOOGLE MAIL
		$configuracion4 = array(
			'protocol' => 'mail', 
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'sectureags@gmail.com',
			'smtp_pass' => 'sECTUREd1',
			'mailtype' => 'text'
		);

		$solicitudes_id   = $this->input->post('solicitudes_id');
		$bienoservicio_id = $this->input->post('bienoservicio_id');
		$status_actual 	  = $this->input->post('status');
		$bienoservicio    = $this->input->post('bienoservicio');
		$cantidad 		  = $this->input->post('cantidad');
		$monto 			  = $this->input->post('monto');
		$nombre_proveed   = $this->input->post('nombre_proveed');
		$mensaje 		  = $this->input->post('mensaje');
		$tipo_compra 	  = $this->input->post('tipo_compra');
		$useremail 		  = $this->input->post('user');


		$this->bienesoservicios_model->update_tipo_compra();

		$this->load->library('email', $configuracion4);
		$this->email->set_newline("\r\n");

		$this->email->from('sectureags@gmail.com','Sistema de Solicitudes de Compras.');
		$this->email->to('luis.villasenor@aguascalientes.gob.mx');
		$this->email->bcc('blanca.martinez@aguascalientes.gob.mx , oscar.moralez@aguascalientes.gob.mx , '.$useremail.'');

		$this->email->subject('AUTORIZACIÓN de compra. Folio:'.$solicitudes_id.'--'.$bienoservicio_id);
		$this->email->message(
			'
SOLICITUD DE AUTORIZACION DE COMPRA:

FOLIO--ID       	: '.$solicitudes_id.'--'.$bienoservicio_id.'			
BIEN ó SERVICIO 	: '.$bienoservicio.'
CANTIDAD        	: '.$cantidad.'
MONTO CON IVA   	: $'.number_format($monto,2).'
PROVEEDOR PROPUESTO : '.$nombre_proveed.'


COMENTARIOS DE LA DIRECCION ADMINISTRATIVA:
'.$mensaje.'.

Para autorizar el FOLIO--ID ('.$solicitudes_id.'--'.$bienoservicio_id.') debe ingresar al Sistema: {unwrap}http://10.1.17.10/ci21test/authentication.php/admin/{/unwrap}

<< Este mail es enviado a través del Sistema de Solicitudes de Compra desarrollado por el área de informática >>');


		if ($this->email->send()) 
		{
			$data['solicitudes_id'] = $this->input->post('solicitudes_id');
			$this->detalle_bienesoservicios_solicitud_view();

		}else{
			show_error($this->email->print_debugger());
		}

	}

	// Funcion solo para la Secretaria
	function pendientes_view(){

		$e_mail = $_SESSION['username'];

		$this->load->model('prioridades_model');
		$this->load->model('clasificados_model');
		$this->load->model('solicitudes_model');
		$this->load->model('bienesoservicios_model');

		$data['listado_prioridades'] = $this->prioridades_model->get_all_prioridades();
		$data['listado_clasificados'] = $this->clasificados_model->get_all_clasificados();
		$data['mis_solicitudes'] = $this->solicitudes_model->get_all_pendientes($e_mail);
		$data['cuenta_bultos'] = $this->bienesoservicios_model->cuenta_bultos();

		$this->load->view('pendientes_view',$data);

	}

	function detalle_bienesoservicios_pendientes_view(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);
		
		$this->load->model('clasificados_model');
		$this->load->model('bienesoservicios_model');

		$data['listado_clasificados'] = $this->clasificados_model->get_all_clasificados();
		$data['listado_bienesoservicios_solicitud'] = $this->bienesoservicios_model->get_all_bienesoservicios_pendientes();
		$data['cuenta_bultos_pendientes'] = $this->bienesoservicios_model->cuenta_bultos_pendientes();

		

		$this->load->view('detalle_bienesoservicios_pendientes_view',$data);
	}

	function autorizar()
	{
		
		$e_mail = $_SESSION['username'];

		$this->load->model('bienesoservicios_model');

		$solicitudes_id2 = $this->input->post('solicitudes_id');
		$bienoservicio_id2 = $this->input->post('bienoservicio_id');
		$status_actual2 = $this->input->post('status2');
		$bienoservicio2 = $this->input->post('bienoservicio2');
		$cantidad2 = $this->input->post('cantidad2');
		$monto2 = $this->input->post('monto2');
		$nombre_proveed2 = $this->input->post('nombre_proveed2');
		$mensaje2 = $this->input->post('mensaje2');
		

		$this->bienesoservicios_model->update_status();

		// Configuracion para el envio de email utilizando GOOGLE MAIL
		$configuracion2 = array(
			'protocol' => 'mail', 
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'sectureags@gmail.com',
			'smtp_pass' => 'sECTUREd1',
			'mailtype' => 'text'
		);

		
		$this->load->library('email', $configuracion2);
		$this->email->set_newline("\r\n");

		$this->email->from('sectureags@gmail.com','Sistema de Solicitud de Compras.');
		$this->email->to('luis.villasenor@aguascalientes.gob.mx');
		$this->email->bcc('blanca.martinez@aguascalientes.gob.mx , oscar.moralez@aguascalientes.gob.mx');		

		$this->email->subject('RESULTADO de la Autorización de Compra FOLIO: '.$solicitudes_id2.'--'.$bienoservicio_id2);
		$this->email->message(
			'
RESULTADO DE LA AUTORIZACIN DE COMPRA:

FOLIO--ID       : '.$solicitudes_id2.'--'.$bienoservicio_id2.'
Bien ó Servicio : '.$bienoservicio2.'
Cantidad        : '.$cantidad2.'
Monto           : $'.number_format($monto2,2).'
Proveedor       : '.$nombre_proveed2.'

COMENTARIOS DEL TITULAR:
'.$mensaje2.'.

Para visualizar el resultado debe ingresar al Sistema y buscar el FOLIO y ID correspondientes:
Link: {unwrap}http://10.1.17.10/ci21test/authentication.php/admin/{/unwrap}

<< Este mail es enviado automáticamente a través del Sistema de Solicitudes de Compra desarrollado por el área de informática >>');


		if ($this->email->send()) 
		{
			
			$this->detalle_bienesoservicios_pendientes_view();

		}else{
			show_error($this->email->print_debugger());
		}


	}

	function rechazar()
	{
		
		$e_mail = $_SESSION['username'];

		$this->load->model('bienesoservicios_model');

		$solicitudes_id2 = $this->input->post('solicitudes_id');
		$user = $this->input->post('user');
		$bienoservicio_id2 = $this->input->post('bienoservicio_id');
		$status2 = $this->input->post('status2');
		$bienoservicio2 = $this->input->post('bienoservicio');
		
		$mensaje2 = $this->input->post('mensaje2');
		

		$this->bienesoservicios_model->update_status();

		// Configuracion para el envio de email utilizando GOOGLE MAIL
		$configuracion2 = array(
			'protocol' => 'mail', 
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'sectureags@gmail.com',
			'smtp_pass' => 'sECTUREd1',
			'mailtype' => 'text'
		);

		
		$this->load->library('email', $configuracion2);
		$this->email->set_newline("\r\n");

		$this->email->from('sectureags@gmail.com','Sistema de Solicitud de Compras.');
		$this->email->to('luis.villasenor@aguascalientes.gob.mx'); // Enviar al dueño del registro "user"
		
		$this->email->subject('DEVOLUCION del FOLIO: '.$solicitudes_id2.'--'.$bienoservicio_id2);
		$this->email->message(
			'
DEVOLUCION DE LA SOLICITUD:

FOLIO--ID       : '.$solicitudes_id2.'--'.$bienoservicio_id2.'
Bien ó Servicio : '.$bienoservicio2.'

COMENTARIOS DEL TITULAR:
'.$mensaje2.'.

Para visualizar el resultado debe ingresar al Sistema y buscar el FOLIO y ID correspondientes:
Link: {unwrap}http://10.1.17.10/ci21test/authentication.php/admin/{/unwrap}

<< Este mail es enviado automáticamente a través del Sistema de Solicitudes de Compra desarrollado por el área de informática >>');


		if ($this->email->send()) 
		{
			
			$data['solicitudes_id'] = $this->input->post('solicitudes_id');
			$this->detalle_bienesoservicios_solicitud_view();

		}else{
			show_error($this->email->print_debugger());
		}


	}

	// Genera un PDF en linea
	function hello_world()
	{
		$contenido = array('Hola' => 'Mundo');
		$this->load->library('cezpdf');

		prep_pdf(); // creates the footer for the document we are creating.
		 
		$this->cezpdf->ezText('Solicitud de Compra', 12, array('justification' => 'center'));
		$this->cezpdf->ezSetDy(-10);
		 
		$content = '
		Este documento esta EN DESARROLLO y pretender mostrar la Solicitud de Compra autorizada por la Secretaria la cual sera entregada al proveedor.

		

		DOCUMENTO EN DESARROLLO
		';		
		 
		$this->cezpdf->ezText($content, 10,array('justification' => 'center'));
		 
		$this->cezpdf->ezStream();		
	}

	function pdf(){

		$this->load->library('pdf');
		//$this->load->library('html_table');

		// Creación del objeto de la clase heredada
		$pdf = new PDF();
		
		$pdf->AliasNbPages(); // Calcula el total de paginas del documento

		$pdf->Output();
	}

	function html2pdf()
	{
		
		$num_solicitud = 2;
		$concepto = 'Computadora Portatil';
		$monto = 13500 ;

		$this->load->library('html_table');

		$pdf=new html_table();
		$pdf->AddPage();
		$pdf->SetFont('Arial','',12);

		$html='<table border="1">
<tr>
<th>Cantidad</th>                  
<th>Concepto</th>     
<th>Monto con IVA</th>                  
</tr>
<tr><td>'.$num_solicitud.'</td>     <td>'. $concepto .'</td>     <td>'. number_format($monto,2) .'</td>
</tr>
</table>';

		$pdf->WriteHTML($html);
		$pdf->Output();
	}



	function qr()
    {
        
		$this->load->library('barcodeqr');

		$titulo = 'MiTitulo';
		$miurl =  'www.sector7mx.wordpress.com';

		$name = 'Luis Gabriel';
		$address = 'Av. Aguascalientes #606';
		$phone = '910 2088';
		$email = 'luis.villasenor@aguascalientes.gob.mx';

		$contacto = array(
		
			'url' => 'www.sector7mx.wordpress.com' 

		);

		//$this->barcodeqr->bookmark($titulo,$miurl);
		$this->barcodeqr->url($miurl);

		// contact 
		$this->barcodeqr->contact($name, $address, $phone, $email); 

		$this->barcodeqr->draw();

    }

    function codifica_sha1($parametro){
    // Esta funcion toma el "paramtero" desde la URL de la forma "controller/parametro"
    	echo sha1($parametro);
    }

	
	

}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */