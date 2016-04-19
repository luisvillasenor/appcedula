<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Merca extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
        $this->load->library('email');
        $this->load->model('ubicaciones_model');
        $this->load->model('municipios_model');
        $this->load->model('sedes_model');
        $this->load->model('fc_model');
        $this->load->model('subactividades_model');


		if ( !isset($_SESSION['username'])){
			redirect(base_url('admin/logout')); // Redirecciona la controlador "admin/logout"
		}
        $date = new DateTime();
        $anioActual = $date->format('Y'); // Calcula en año actual
        define('anioActual', $anioActual);

	}

public function programa(){
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion = ( isset($_SESSION['fc']) ) ? $_SESSION['fc'] : null ;
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['title']= 'Master Plan del Festival de Calaveras';
        #$marca = '0'; // Es una referencia a la variable Global definida en el __contructor
        

        
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        

        $this->load->model('subactividades_model');
        $this->load->model('ubicaciones_model');
        $this->load->model('municipios_model');
        $this->load->model('sedes_model');
        $this->load->model('horarios_model');
        $this->load->model('fc_model');
        $this->load->model('actividades_model');
        
        // Código que pone en el encabezado de la página la Coordinación del Usuario.
        /////////////////////////////////////////////////////////////////////////////
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

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
        /////////////////////////////////////////////////////////////////////////////

        $id_categoria = $this->input->post('id_categoria');
        $marca = $this->input->post('marca');
        $id_categoria = ( isset($id_categoria) ) ? $id_categoria : null ;
        $marca = ( isset($marca) AND empty($marca) ) ? '0' : '1' ;
        
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();


        $data['marca'] = $marca;
        $data['id_categoria'] = $id_categoria;
        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion, $id_categoria, $marca);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all'] = $this->subactividades_model->show($id_subact = null,$id_act = null);

                        
        $this->load->view('header_view',$data);
        $this->load->view('programa_resumido_view',$data);
        $this->load->view('footer_view',$data);
    }

    # Exportar a PDF
    function pdf($edicion = '', $id_categoria = '', $marca = ''){

        $this->load->helper('pdf_helper');
        /*
        -------------
        Aqui el codigo
        -------------
        */
        $data['titles']= 'Master del Programa General para el Festival de Calaveras Edición 201'.$edicion;
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('subactividades_model');
        $this->load->model('ubicaciones_model');
        $this->load->model('municipios_model');
        $this->load->model('sedes_model');
        $this->load->model('horarios_model');
        $this->load->model('fc_model');
        $this->load->model('actividades_model');
        
        $id_categoria = ( isset($id_categoria) ) ? $id_categoria : null ;
        $marca = ( isset($marca) AND empty($marca) ) ? '0' : '1' ;
        
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion, $id_categoria, $marca);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        #$data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all'] = $this->subactividades_model->show($id_subact = null,$id_act = null);
                
        #$this->load->view('header_view',$data);
        $this->load->view('pdfreport', $data);
        #$this->load->view('footer_view',$data);

    }

}

/* End of file solicitud.php */
/* Location: ./application/controllers/merca.php */