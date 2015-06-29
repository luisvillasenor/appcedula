<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Nuevo Coordinador</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo base_url('jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css'); ?>" />
  <script src="<?php echo base_url('jquery-ui/js/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('jquery-ui/js/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
  <style type="text/css">
    #subheader {
      background-color: #CCC;
      margin: auto;
      height: 20px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }
    #wrapper {
      background-color: transparent;
      margin-top: 70px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;
      
    }
th
{
background-color:#FE9042;
color:white;
}
      h3{text-align:center;}

  </style>
  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha_act" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( "#fecha_aut" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
      });
    });       
      
  </script>
    
    <script language="javascript">

        function myFunction() {
            
            var obj
            var mylist = document.getElementById("id_categoria");
            var VALOR = mylist.options[mylist.selectedIndex].value;
            
            <?php foreach($get_categorias as $item) : ?>
            
                    if(VALOR == <?php echo $item->id_categoria;?>){

                        document.getElementById("id_coord").value = <?php echo $item->id_coord;?>;
                    }
                   
            <?php endforeach ;?>        
        
        }        
    
    </script>
    
    
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <?php include 'include/nav_actividades.php';  ?>             
      
    <div class="row-fluid span8 control-group info">              
    <!--Body content-->
        
        <div class="well"><h3>Agregar una Nueva Cédula de Actividad</h3></div>  
        
      
        
      <?php $attributes = array('name' => 'nuevacedula', 'id' => 'nuevacedula', 'class' => 'form-signin');
        echo form_open(base_url('actividades/insert_act'),$attributes); ?>
        <fieldset>
                   
          <table>
            <tr>
            <th rowspan="1">CÉDULA</th>
            <td>
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Nombre de la Actividad..."> </i>
                <?php 
                          echo form_label('Nombre de la Cédula:',  'actividad' ) ; 
                          echo form_input('actividad', set_value('actividad'), 'id="actividad" class="input-block-level input-xxlarge" placeholder="Escriba aquí el Nombre de la Actividad..."');
                      ?> 
                <span class="help-block"><small>Evite utilizar estos simbolos en el texto: %,&,$,¬,|,",#,@</small></span>
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Descripción de la Actividad..."> </i>
                <p>
                      <?php 
                          echo form_label('Descripción:',  'descripcion' ) ; 
                          echo form_textarea('descripcion', '', 'id="descripcion" class="input-block-level" placeholder="Escriba aquí la Descripción..."');
                      ?>
                  </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la justificacion de la Actividad..."> </i>
                <p>
                      <?php 
                          echo form_label('Justificacion:',  'justificacion' ) ; 
                          echo form_textarea('justificacion', '', 'id="justificacion" class="input-block-level" placeholder="Escriba aquí la Justificacion..."');
                      ?>
                  </p>
                
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Seleccione aquí la Categoria de la Actividad"> </i>
                <label>Categoría de la Actividad</label>
                <select class="inline" id="id_categoria" name="id_categoria" onchange="myFunction()">  
                    <option></option>
                  <?php foreach ($get_categorias as $categos ) : ?>
                    <option value="<?php echo $categos->id_categoria;?>"><?php echo $categos->categoria;?></option>
                  <?php endforeach; ?>
                </select>                
                <input class="input-xlarge uneditable-input" type="hidden" name="id_coord" id="id_coord" >
            </td>
            </tr>
                        <tr>
            <th rowspan="1">RESPONSABLE</th>
            <td>                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Nombre del Lider ó Responsable de la Cédula"> </i>
                <p>
                  <?php 
                      echo form_label('Responsable de la Cédula',  'quienpropone' ) ; 
                      echo form_input('quienpropone', '', 'id="quienpropone" class="input-block-level" placeholder="Escriba aquí el Nombre del Lider ó Responsable de la Cédula"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Empresa ú Organización"> </i>
                <p>
                  <?php 
                      echo form_label('Empresa ú Organización',  'empresa' ) ; 
                      echo form_input('empresa', '', 'id="empresa" class="input-block-level" placeholder="Escriba aquí la Empresa ú Organización"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Puesto"> </i>
                <p>
                  <?php 
                      echo form_label('Puesto',  'puesto' ) ; 
                      echo form_input('puesto', '', 'id="puesto" class="input-block-level" placeholder="Escriba aquí el Puesto"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Domicilio"> </i>
                <p>
                  <?php 
                      echo form_label('Domicilio',  'domicilio' ) ; 
                      echo form_input('domicilio', '', 'id="domicilio" class="input-block-level" placeholder="Escriba aquí el Domicilio"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Teléfono"> </i>
                <p>
                  <?php 
                      echo form_label('Telefono',  'telefono' ) ; 
                      echo form_input('telefono', '', 'id="telefono" class="input-block-level" placeholder="Escriba aquí el Telefono"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Email"> </i>
                <p>
                  <?php 
                      echo form_label('Email',  'email' ) ; 
                      echo form_input('email', '', 'id="email" class="input-block-level" placeholder="Escriba aquí el Email"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Página Web"> </i>
                <p>
                  <?php 
                      echo form_label('Web',  'web' ) ; 
                      echo form_input('web', '', 'id="web" class="input-block-level" placeholder="Escriba aquí la Página Web"');
                  ?>
                </p>
                
            </td>
            </tr>
            <tr>
            <th rowspan="1">CUANDO</th>
            <td>                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Fecha de Realización de la Actividad"> </i>
                <p>
                  <?php 
                      echo form_label('Fecha de Inicio de la Actividad',  'fecha_act' ) ; 
                      echo form_input('fecha_act', '', 'id="fecha_act" class="input-block-level" placeholder="Escriba aquí la Fecha de Inicio de la Actividad"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Fecha Límite de Decisión de Aceptación"> </i>
                <p>
                  <?php 
                      echo form_label('Fecha de Límite de Aceptación',  'fecha_aut' ) ; 
                      echo form_input('fecha_aut', '', 'id="fecha_aut" class="input-block-level" placeholder="Escriba aquí la Fecha de Límite de Aceptación"');
                  ?>
                </p>
                
            </td>
            </tr>
            <tr>
            <th rowspan="1">CUANTO</th>
            <td>                
                <label>Costo para SECTURE</label>                
                <label class="checkbox inline">
                <input id="is_costo_secture" name="is_costo_secture" type="radio" value="1" checked="checked"> Sí
                </label>
                <label class="checkbox inline">
                <input id="is_costo_secture" name="is_costo_secture" type="radio" value="0"> No
                </label>
                <label>Costo para el PÚBLICO</label>
                
                <label class="checkbox inline">
                <input id="is_costo_publico" name="is_costo_publico" type="radio" value="1"> Sí
                </label>
                <label class="checkbox inline">
                <input id="is_costo_publico" name="is_costo_publico" type="radio" value="0" checked="checked"> No
                </label>
                <span class="add-on">$</span>
                <input id="costo_publico" name="costo_publico" type="text">
            </td>
            </tr>
            <th rowspan="1">DONDE</th>
            <td>                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la Ubicación de la Actividad..."> </i>
                <p>
                      <?php 
                          echo form_label('Ubicacion:',  'ubicacion' ) ; 
                          echo form_textarea('ubicacion', '', 'id="ubicacion" class="input-block-level" placeholder="Escriba aquí la Ubicacion de la Actividad..."');
                      ?>
                  </p>
                
            </td>
            
           </table>
          <p><br>
          <?php echo form_submit('submit',  'Agregar Cédula','class="btn btn-medium btn-primary"' ); ?>    
          
        </fieldset>
      <?php echo form_close(); ?>
    </div><!— /row span12 —>
    </div>
</div><!— /container —>
    





<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('bootstrap/js/bootstrap.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-alert.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-button.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-carousel.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-collapse.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-dropdown.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-modal.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-popover.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-scrollspy.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-tab.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-tooltip.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-transition.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-typeahead.js'); ?>"></script>
</body>
</html>