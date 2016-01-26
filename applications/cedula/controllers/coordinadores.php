<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coordinadores extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
		if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/indrex"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable
		$date = new DateTime();
        $anioActual = $date->format('Y'); // Calcula en año actual
        define('anioActual', $anioActual);
	}
    
	public function index(){
		$grupo    = $_SESSION['grupo'];
		$data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';

		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
		$this->load->model('fc_model');
        $this->load->model('responsables_model');
		$data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all_resps'] = $this->responsables_model->get_all_resps();
        $data['get_fc'] = $this->fc_model->get_fc();

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

		$this->load->view('coordinadores_view',$data);
	}
	public function agregar_co(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('responsables_model');
        $data['get_all_resps'] = $this->responsables_model->get_all_resps();
		$this->load->view('coordinadores_agregar_view',$data);
	}
	public function buscar_co(){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
		//$res = $this->input->post('promotor');
		$data['get_one_co'] = $this->resp_zona_model->get_one_co();
		$this->load->view('coordinador_one_view',$data);
	}
	public function edit_coord($id_coord){
		$e_mail = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('coordinadores_model');
        $this->load->model('responsables_model');
        $data['get_one_coord_edit'] = $this->coordinadores_model->get_one_coord_edit($id_coord);
        $data['get_all_resps'] = $this->responsables_model->get_all_resps();
        $this->load->view('coordinadores_editar_view',$data);
	}
	public function actualizar_coord(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);        
        
        $id_coord = $this->input->post('id_coord');
        $id_resp = $this->input->post('id_resp');
        $coordinacion = $this->input->post('coordinacion');             
        
		$this->load->model('coordinadores_model');        
		$this->coordinadores_model->update_entry($id_coord,$coordinacion,$id_resp); 
        
        redirect('coordinadores/index');
	}
    public function add_coord(){
		$e_mail = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $coordinacion = $this->input->post('coordinacion');
        $id_resp = $this->input->post('id_resp');
        //$id_fc = 4; // el id_fc representa la edicion correspondiente. Ver Tabla "fc"
        
        $this->load->model('coordinadores_model');
        $this->coordinadores_model->insert_entry($coordinacion,$id_resp);
        
        redirect('coordinadores/index');
	}
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */