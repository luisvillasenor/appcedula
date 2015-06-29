<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ciudadano extends CI_Controller {

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

	public function agregar(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');

		$this->ciudadanos_model->insert_entry();

		redirect('captura/');
		
	}

	public function actualizar(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');

		$this->ciudadanos_model->update_entry($this->input->post('ciud_id'));

		redirect('captura/');
		
	}

public function buscar(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		$this->load->model('referencias_model');
		$this->load->model('solicitudes_model');
		$this->load->model('secciones_model');
		$res = $this->input->post('nombre');
		//print_r($res);

		if ($res !== '') {
			$data['get_one_ciudadano'] = $this->ciudadanos_model->get_one_ciudadano($res);
			$data['get_all_referencias'] = $this->referencias_model->get_all();
			$data['get_all_secciones'] = $this->secciones_model->get_all_secciones(); 
			$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
			$data['get_solicitud_vs_ciudadano'] = $this->solicitudes_model->get_solicitud_vs_ciudadano($res);
			$this->load->view('captura_one_view',$data);
		} else {
			$data['get_all_ciudadanos'] = $this->ciudadanos_model->get_all_ciudadanos();
			$data['get_all_secciones'] = $this->secciones_model->get_all_secciones(); 
			$data['get_all_referencias'] = $this->referencias_model->get_all();
			$data['get_all_solicitudes'] = $this->solicitudes_model->get_all_solicitudes(); 
			$this->load->view('captura_view',$data);
		}
		
		
	}
	public function detalle(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('ciudadanos_model');
		
		$data['get_one_ciudadano'] = $this->ciudadanos_model->get_one_ciudadano($ciud_id);

		$this->load->view('captura_view',$data);
		
	}













	///////////////////////////////////////////////////////////////////////////////////////

	function elconcepto(){

		$this->load->view('elconcepto');
	}

	function solicitudes_view(){

		$e_mail = $_SESSION['username'];

		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->helper('array');
		$this->load->library('pagination');
		$this->load->library('table');

		$config['base_url'] = 'http://10.1.17.10/ci21test/authentication.php/solicitud/solicitudes_view';
		$config['total_rows'] = $this->db->get('solicitudes')->num_rows();
		$config['per_page'] = 5;
		$config['num_links'] = 5;

		$this->pagination->initialize($config);

		$this->load->model('prioridades_model');
		//$this->load->model('clasificados_model');
		$this->load->model('solicitudes_model');
		//$this->load->model('bienesoservicios_model');

		$data['listado_prioridades'] = $this->prioridades_model->get_all_prioridades();
		//$data['listado_clasificados'] = $this->clasificados_model->get_all_clasificados();
		$data['solicitudes'] = $this->db->get('solicitudes',$config['per_page'],$this->uri->segment(3));
		$data['mis_solicitudes'] = $this->solicitudes_model->get_all_solicitudes($e_mail);
		//$data['cuenta_bultos'] = $this->bienesoservicios_model->cuenta_bultos();


		

		$haypendientes = $this->solicitudes_model->haypendientes();
		if ($haypendientes !== true) {
			# code...
			$data['haypendientes'] = 0;
		}else{
			$data['haypendientes'] = $haypendientes;
		}



		$this->load->view('solicitudes_view',$data);



	}

	function upsagregar(){

		$this->load->model('solicitudes_model');

		$this->solicitudes_model->insert_entry();

		redirect('solicitud/solicitudes_view');

	}

	function agregar_bienoservicio(){

		$e_mail = $_SESSION['username'];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('bienoservicio', 'bienoservicio', 'required');
		$this->form_validation->set_rules('precio_u', 'precio_u', 'required');

		if ( $this->form_validation->run() !== false ) {

			

		}	

		$this->load->model('bienesoservicios_model');
		$this->bienesoservicios_model->insert_entry();

		$data['solicitudes_id'] = $this->input->post('solicitudes_id');
		$this->detalle_bienesoservicios_solicitud_view();	
		

	}

	function notificar_administrativo(){

		$e_mail = $_SESSION['username'];

		// Configuracion para el envio de email utilizando GOOGLE MAIL
		$configuracion3 = array(
			'protocol' => 'mail', 
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'sectureags@gmail.com',
			'smtp_pass' => 'sECTUREd1',
			'mailtype' => 'text'
		);

		
		$solicitudes_id = $this->input->post('solicitudes_id');
		$ID = $this->input->post('bienoservicio_id');
		$bienoservicio_id = $this->input->post('bienoservicio');
		$descripcion = $this->input->post('descripcion');
		$justificacion = $this->input->post('justificacion');
		$bienoservicio = $this->input->post('bienoservicio');
		$cantidad = $this->input->post('cantidad');
		$monto = $this->input->post('monto');
		$nombre_proveed = $this->input->post('nombre_proveed');
		$mensaje = $this->input->post('mensaje');
		$tipo_compra = $this->input->post('tipo_compra');

		$this->load->library('email', $configuracion3);
		$this->email->set_newline("\r\n");

		$this->email->from('sectureags@gmail.com','Sistema de Solicitudes de Compras.');
		$this->email->to('luis.villasenor@aguascalientes.gob.mx');
		//$this->email->to('blanca.martinez@aguascalientes.gob.mx ');
		//$this->email->bcc('oscar.moralez@aguascalientes.gob.mx');

		$this->email->subject('NOTIFICACION DEL SISTEMA.');
		$this->email->message(
			'
UNA SOLICITUD SE HA AGREGADO Ó ACTUALIZADO:

FOLIO 			: '.$solicitudes_id.'--'.$ID.'			
Bien ó Servicio : '.$bienoservicio.'
Cantidad        : '.$cantidad.'
Monto con IVA   : $'.number_format($monto,2).'
Proveedor       : '.$nombre_proveed.'



Debe ingresar al Sistema y buscar el FOLIO correspondiente:
Link: {unwrap}http://10.1.17.10/ci21test/authentication.php/admin/{/unwrap}


<< Este mail es enviado a través del Sistema de Solicitudes de Compra desarrollado por el área de informática >>');


		if ($this->email->send()) 
		{

			$this->load->model('bienesoservicios_model');


			$this->bienesoservicios_model->update_status_enviado();


			$data['solicitudes_id'] = $this->input->post('solicitudes_id');
			
			$this->detalle_bienesoservicios_solicitud_view();

		}else{
			show_error($this->email->print_debugger());
		}

	}

	function crear_solicitudes_view(){
		$this->load->view('crear_solicitudes_view');
	}

	function detalle_generales_solicitud_view(){
		$this->load->view('detalle_generales_solicitud_view');
	}

	function detalle_bienesoservicios_solicitud_view(){

		$e_mail = $_SESSION['username'];
		$solicitud_no = $this->input->post('solicitudes_id');

		
		$data['onlyusername'] = strstr($e_mail,'@',true);
			
		$this->load->model('clasificados_model');
		$this->load->model('bienesoservicios_model');

		$data['listado_clasificados'] = $this->clasificados_model->get_all_clasificados();
		$data['listado_bienesoservicios_solicitud'] = $this->bienesoservicios_model->get_all_bienesoservicios_solicitud($this->input->post('solicitudes_id'));
		$data['num_solicitud'] = $this->input->post('solicitudes_id');
		$data['clasificado_id'] = $this->input->post('clasificado_id');
		
		$this->load->view('detalle_bienesoservicios_solicitud_view',$data);

		
	}

	function detalle_cotizaciones_solicitud_view(){
		$this->load->view('detalle_cotizaciones_solicitud_view');
	}

	function mis_solicitudes(){

		$this->load->model('solicitudes_model');

			$res = $this->solicitudes_model->get_all_solicitudes($this->input->post('users_id'));

				if ( $res !== false){
					// la persona si tiene una cuenta registrada en el sistema
					$_SESSION['username'] = $this->input->post('email_address');

					redirect('welcome');// Redirecciona al controlado "welcome". Se puede redireccionar a una accion en especifico. Zona de miembros

				}
	}

	function get_bienoserevicio()
	{

		$this->load->model('bienesoservicios_model');

		$data['get_one'] = $this->bienesoservicios_model->get_one($this->input->post('bienoservicio_id'));

		if (! isset($data['get_one'])) {
			echo "FALSE";
		} else {
			echo "TURE";
		}
	}

	function borrar_bienoservicio(){

		$this->load->model('bienesoservicios_model');

		$this->bienesoservicios_model->delete_one($this->input->post('bienoservicio_id'));

		$data['solicitudes_id'] = $this->input->post('bienoservicio_id');

		$this->detalle_bienesoservicios_solicitud_view();

	}

	function actualizar_bienoservicio(){

		$this->load->model('bienesoservicios_model');

		$this->bienesoservicios_model->update_bienoservicio($this->input->post('bienoservicio_id'));

		$data['solicitudes_id'] = $this->input->post('solicitudes_id');
		$this->detalle_bienesoservicios_solicitud_view();
	

	}

	function editar_bienoservicio(){

		$this->load->model('bienesoservicios_model');

		$this->bienesoservicios_model->get_one($this->input->post('bienoservicio_id'));

		$data['solicitudes_id'] = $this->input->post('solicitudes_id');

		$this->detalle_bienesoservicios_solicitud_view();

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