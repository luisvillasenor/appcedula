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

public function programa($id_categoria = 'todo'){
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
        $id_categoria = ( isset($id_categoria) ) ? $id_categoria : 'todo' ;
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
    function pdf($edicion = '', $id_categoria = 'todo', $marca = ''){

        $this->load->helper('pdf_helper');
        /*
        -------------
        Aqui el codigo
        -------------
        */
        $data['titles']= 'Master del Programa General para el Festival de Calaveras Edición 201'.$edicion;
        
        #CARGA LOS MODELOS A USAR
        $modelos = array(
            'necesidades_model',
            'categorias_model',
            'subactividades_model',
            'ubicaciones_model',
            'municipios_model',
            'sedes_model',
            'horarios_model',
            'fc_model',
            'actividades_model'
        );
        foreach ($modelos as $value) {
            $this->load->model($value);
        }
        
        $id_categoria = ( isset($id_categoria) ) ? $id_categoria : 'todo' ;
        $marca        = ( isset($marca) AND empty($marca) ) ? '0' : '1' ;
        
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion, $id_categoria, $marca);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats($order = 'asc');
        #$data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all'] = $this->subactividades_model->show($id_subact = null,$id_act = null);
                
        #$this->load->view('header_view',$data);
        $this->load->view('pdfreport', $data);
        #$this->load->view('footer_view',$data);

    }

    # Exportar a PDF
    function pdfdiario($edicion = '', $fechaPrograma = 'todo', $marca = ''){

        $this->load->helper('pdf_helper');
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion = ( isset($_SESSION['fc']) ) ? $_SESSION['fc'] : null ;
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        /*
        -------------
        Aqui el codigo
        -------------
        */
        $data['titles']= 'Master del Programa General DIARIO para el Festival de Calaveras Edición 201'.$edicion;
        
        #CARGA LOS MODELOS A USAR
        $modelos = array(
            'necesidades_model',
            'categorias_model',
            'subactividades_model',
            'ubicaciones_model',
            'municipios_model',
            'sedes_model',
            'horarios_model',
            'fc_model',
            'actividades_model'
        );
        foreach ($modelos as $value) {
            $this->load->model($value);
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
                    $data['fcTrabajo'] = $fcTrabajo;
                }
            }
        
        #$fechaPrograma = $this->input->post('fecha');
        #$marca = $this->input->post('marca');
        $fechaPrograma = ( isset($fechaPrograma) ) ? $fechaPrograma : 'todo' ;
        $marca = ( isset($marca) AND empty($marca) ) ? '0' : '1' ;
        
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['marca'] = $marca;
        $data['edicion'] = $edicion;
        $data['fechaPrograma'] = $fechaPrograma;
        $data['fechas_oficiales'] =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
        $data['show_subacts'] = $this->subactividades_model->show($id_subact = null,$id_act = null);
        
        $data['get_cal_act'] = $this->actividades_model->get_cal_act($e_mail,$grupo,$id_coord,$edicion);
        #$data['get_master_diario'] = $this->actividades_model->get_master_diario($edicion, $fechaPrograma, $marca);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        #$data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all_subactividades'] = $this->subactividades_model->show_programa_diario($fechaPrograma);
        $activities = array();
        $activities2 = array();
        
        foreach ($data['get_all_subactividades'] as $value) {
            array_push($activities, $value->id_act);
        }
        # ELIMINA LAS ACTIVIDADES DUPLICADOS
        $activities2 = array_unique($activities);
        #var_dump($data['get_all_subactividades']);
        #die();
        $data['activities'] = $activities2;
        $data['get_all_conciertos'] = $this->subactividades_model->show_conciertos_diario($fechaPrograma);
                
        #$this->load->view('header_view',$data);
        $this->load->view('pdfreportdiario', $data);
        #$this->load->view('footer_view',$data);

    }

}



/* End of file solicitud.php */
/* Location: ./application/controllers/merca.php */