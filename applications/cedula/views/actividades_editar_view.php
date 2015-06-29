<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Cédula de Actividad</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/appcedula.css'); ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css'); ?>" />
  <script src="<?php echo base_url('jquery-ui/js/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('jquery-ui/js/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
  

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

    function getOption() {
            
            var obj
            var mylist = document.getElementById("id_categoria");
            var VALOR = mylist.options[mylist.selectedIndex].value;
            
            <?php foreach($get_categorias as $item) : ?>
            
                    if(VALOR == <?php echo $item->id_categoria;?>){

                        document.getElementById("id_coord").value  = <?php echo $item->id_coord;?>;
                    }
                   
            <?php endforeach ;?>
                    
            
        
        }   
    
    function getOption2() {
            
            var obj
            var mylist = document.getElementById("id_categoria");
            var VALOR = mylist.options[mylist.selectedIndex].value;
            
            <?php foreach($get_categorias as $item) : ?>
            
                    if(VALOR == <?php echo $item->id_categoria;?>){

                        document.getElementById("id_coord").value  = <?php echo $item->id_coord;?>;
                    }
                   
            <?php endforeach ;?>
                    
            
        
        }    
    
    </script>
</head>

<body onload="getOption()">
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>
        
        
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
        
        <div class="well"><h3>Editar Cédula de Actividad</h3></div>
        <div class="alert alert-error">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4>Evite perdida de información!</h4>
          Actualice inmediatamente sus cambios, el sistema no actualizará si detecta que no hay actividad despues de 15 minutos aproximadamente. Evite perdida de información.
        </div>

        
<?php foreach ($get_one_act_edit as $act ) : ?>                 
      <?php echo form_open(base_url('actividades/actualizar_act')); ?>
        <fieldset>
                 
          <table>
            <tr>
            <th rowspan="1">QUE</th>
            <td>                
                <label>ID: <?php echo $act->id_act;?></label>
                <input id="id_act" name="id_act" type="hidden" value="<?php echo $act->id_act;?>">
                <input id="status_act" name="status_act" type="hidden" value="<?php echo $act->status_act;?>">
                <textarea class="input-xxlarge" id="actividad" name="actividad" type="text" value="<?php echo $act->actividad;?>"><?php echo $act->actividad;?></textarea>
                <label></label>
                <textarea class="input-xxlarge" id="descripcion" name="descripcion" type="text" value="<?php echo $act->descripcion;?>"><?php echo $act->descripcion;?></textarea>
                <label></label>
                <textarea class="input-xxlarge" id="justificacion" name="justificacion" type="text" value="<?php echo $act->justificacion;?>"><?php echo $act->justificacion;?></textarea>
                <label>Categoría de la Actividad</label>
                <select class="span3 inline" id="id_categoria" name="id_categoria" onchange="getOption2()">
                  <?php foreach ($get_categorias as $categos ) :
                    if($act->id_categoria == $categos->id_categoria) {?>
                    <option value="<?php echo $categos->id_categoria;?>" selected><?php echo $categos->categoria;?></option>
                    <?php } else { ?>
                        <option value="<?php echo $categos->id_categoria;?>"><?php echo $categos->categoria;?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <input class="input-xlarge uneditable-input" type="hidden" name="id_coord" id="id_coord">
                
            </td>
            </tr>
                        <tr>
            <th rowspan="1">RESPONSABLE</th>
            <td>                
                <label></label>
                <input class="input-xxlarge" id="quienpropone" name="quienpropone" type="text" value="<?php echo $act->quienpropone;?>">
                <label></label>
                <input class="input-xxlarge" id="empresa" name="empresa" type="text" value="<?php echo $act->empresa;?>">
                <label></label>
                <input class="input-xxlarge" id="puesto" name="puesto" type="text" value="<?php echo $act->puesto;?>">
                <label></label>
                <input class="input-xxlarge" id="domicilio" name="domicilio" type="text" value="<?php echo $act->domicilio;?>">
                <label></label>
                <input class="input-xxlarge" id="telefono" name="telefono" type="text" value="<?php echo $act->telefono;?>">
                <label></label>
                <input class="input-xxlarge" id="email" name="email" type="text" value="<?php echo $act->email;?>">
                <label></label>
                <input class="input-xxlarge" id="web" name="web" type="text" value="<?php echo $act->web;?>">
            </td>
            </tr>
            <tr>
            <th rowspan="1">CUANDO</th>
            <td>                
                <label></label>
                <input class="input-xxlarge" id="fecha_act" name="fecha_act" type="text" value="<?php echo $act->fecha_act;?>">
                <label></label>
                <input class="input-xxlarge" id="fecha_aut" name="fecha_aut" type="text" value="<?php echo $act->fecha_aut;?>">
            </td>
            </tr>
            <tr>
            <th rowspan="1">CUANTO</th>
            <td>                
                <label>Costo para SECTURE</label>
                <small><span class="help-block">Este costo es Calulado por el Sistema y refleja la Sumatoria de las necesidades de la Cédula. Para modificar la cantidad, debe hacerlo en la sección de necesidades. <a href="<?php echo base_url();?>/actividades/necesidades_act/<?php echo $act->id_act;?>" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $act->id_act;?>"><i class="icon-list"></i></a></span></small>
                
                <span class="add-on">$</span><span class="input-medium uneditable-input"><?php echo $act->costo_secture;?></span>
                <input class="uneditable-input" id="costo_secture" name="costo_secture" type="hidden" value="<?php echo $act->costo_secture;?>">
                
                <?php switch($act->is_costo_secture) {
                    case '1':?>
                        <label class="checkbox inline">
                        <input id="is_costo_secture" name="is_costo_secture" type="radio" value="1" checked="checked"> Sí </label>
                        <label class="checkbox inline">
                        <input id="is_costo_secture" name="is_costo_secture" type="radio" value="0" > No </label>
                <?php break; 
                    case '0':?>
                        <label class="checkbox inline">
                        <input id="is_costo_secture" name="is_costo_secture" type="radio" value="1"> Sí </label>
                        <label class="checkbox inline">
                        <input id="is_costo_secture" name="is_costo_secture" type="radio" value="0" checked="checked" > No </label>                
                <?php break; }?>
                
                <label>Costo para el PÚBLICO</label>
                <span class="add-on">$</span>
                <input id="costo_publico" name="costo_publico" type="text" value="<?php echo $act->costo_publico;?>">
                
                <?php switch($act->is_costo_publico) {
                    case '1':?>
                        <label class="checkbox inline">
                        <input id="is_costo_publico" name="is_costo_publico" type="radio" value="1" checked="checked"> Sí </label>
                        <label class="checkbox inline">
                        <input id="is_costo_publico" name="is_costo_publico" type="radio" value="0" > No </label>
                <?php break; 
                    case '0':?>
                        <label class="checkbox inline">
                        <input id="is_costo_publico" name="is_costo_publico" type="radio" value="1"> Sí </label>
                        <label class="checkbox inline">
                        <input id="is_costo_publico" name="is_costo_publico" type="radio" value="0" checked="checked" > No </label>                
                <?php break; }?>
            </td>
            </tr>
            <th rowspan="1">DONDE</th>
            <td>                
                <label></label>
                <textarea class="input-xxlarge" id="ubicacion" name="ubicacion" type="text" value="<?php echo $act->ubicacion;?>"><?php echo $act->ubicacion;?></textarea>
            </td>
            
           </table>
            <input id="d1" name="d1" type="hidden" value="<?php echo $act->d1;?>">
            <input id="d2" name="d2" type="hidden" value="<?php echo $act->d2;?>">
            <input id="d3" name="d3" type="hidden" value="<?php echo $act->d3;?>">
            <input id="d4" name="d4" type="hidden" value="<?php echo $act->d4;?>">
            <input id="d5" name="d5" type="hidden" value="<?php echo $act->d5;?>">
            <input id="d6" name="d6" type="hidden" value="<?php echo $act->d6;?>">
            <input id="d7" name="d7" type="hidden" value="<?php echo $act->d7;?>">
            <input id="d8" name="d8" type="hidden" value="<?php echo $act->d8;?>">
            <input id="d9" name="d9" type="hidden" value="<?php echo $act->d9;?>">
            <input id="d10" name="d10" type="hidden" value="<?php echo $act->d10;?>">
            <input id="hora_ini" name="hora_ini" type="hidden" value="<?php echo $act->hora_ini;?>">
            <input id="hora_fin" name="hora_fin" type="hidden" value="<?php echo $act->hora_fin;?>">
            <input id="id_fc" name="id_fc" type="hidden" value="<?php echo $act->id_fc;?>">
            <input id="idresp" name="id_resp" type="hidden" value="<?php echo $act->id_resp;?>">
            <!-- <input type="hidden" name="id_coord" id="id_coord">Ver funcion JavaScript -->
            
          <p><br>
          <button type="submit" class="btn btn-primary">Actualizar Cédula</button>
        </fieldset>
      <?php echo form_close(); ?>
    
<?php endforeach; ?>        
        
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