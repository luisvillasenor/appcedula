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
                <label><?php foreach ($get_fc as $fc) { if ($fc->id_fc === $edicion) { echo $fc->edicion ." (".$fc->anio.")";}}?></label>
                <input type="hidden" name="edicion" id="edicion" value="<?php echo $edicion;?>">
                <span class="help-block"><small>Edicion actual del Festival de Calaveras</small></span>
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
                    <option>Seleccione Categoría</option>
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
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Nombre Completo del Lider ó Responsable de la Cédula"> </i>
                <p>
                  <?php 
                      echo form_label('Responsable de la Cédula',  'quienpropone' ) ; 
                      echo form_input('quienpropone', '', 'id="quienpropone" class="input-block-level" placeholder="Escriba aquí el Nombre Completo del Lider ó Responsable de la Cédula"');
                  ?>
                </p>
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el Email"> </i>
                <p>
                  <?php 
                      echo form_label('Email para notificaciones',  'email' ) ; 
                      echo form_input('email', '', 'id="email" class="input-block-level" placeholder="Escriba aquí el Email"');
                  ?>
                </p>
                <!-- Se desactiva para 2016
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
                -->
            </td>
            </tr>
            <!--
            <tr>
            <th rowspan="1">CUANDO</th>
            <td>                
                <i class="icon-info-sign" data-toggle="tooltip" title="Fecha de Inicio Oficial"> </i>
                <p>
                  <?php 
                      echo form_label('Fecha de Inicio Oficial',  'fecha_act' ) ; 
                      echo form_input('fecha_act', '', 'id="fecha_act" class="input-large" placeholder="Seleccione Fecha"');
                  ?>
                </p>
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Fecha de Termino Oficial"> </i>
                <p>
                  <?php 
                      echo form_label('Fecha de Termino Oficial',  'fecha_aut' ) ; 
                      echo form_input('fecha_aut', '', 'id="fecha_aut" class="input-large" placeholder="Seleccione Fecha"');
                  ?>
                </p>
                
            </td>
            </tr>
            -->
            <tr>
            <th rowspan="1">CUANTO</th>

            <td>
            <!-- Desactivado por 2016                
                <label>Costo para SECTURE</label>                
                <label class="checkbox inline">
                <input id="is_costo_secture" name="is_costo_secture" type="radio" value="1" checked="checked"> Sí
                </label>
                <label class="checkbox inline">
                <input id="is_costo_secture" name="is_costo_secture" type="radio" value="0"> No
                </label>
            -->
                <label class="checkbox inline">Costo para el PÚBLICO</label>
                
                <label class="checkbox inline">
                <input id="is_costo_publico" name="is_costo_publico" type="radio" value="1"> Sí
                </label>
                <label class="checkbox inline">
                <input id="is_costo_publico" name="is_costo_publico" type="radio" value="0" checked="checked"> No
                </label>
            <!-- Desactivado por 2016
                <span class="add-on">$</span>
                <input id="costo_publico" name="costo_publico" type="text">
            -->
            </td>
            </tr>
            <!--
            <th rowspan="1">DONDE</th>
            <td>
              <br>

           <label>Sede</label>
                        <select class="input-md" id="sede" name="sede">
                  <option>Sede</option>
                  <?php foreach ($show_sedes as $sede ) : ?>
                    <option value="<?php echo $sede->sede; ?>"><?php echo $sede->sede; ?></option>
                  <?php endforeach; ?>   
              </select>
              <label>Ubicación</label>
              <select class="input-md" id="ubicacion" name="ubicacion">
                  <option>Ubicacion</option>
                  <?php foreach ($show_ubicaciones as $ubic ) : ?>
                    <option value="<?php echo $ubic->ubicacion; ?>"><?php echo $ubic->ubicacion; ?></option>
                  <?php endforeach; ?>   
              </select>

                
            </td>
            -->
            
           </table>
          <p><br>
          
          <button type="submit" class="btn btn-primary">Agregar Cédula</button>
        </fieldset>
      <?php echo form_close(); ?>
    </div><!— /row span12 —>
    </div>
</div><!— /container —>
    



<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>