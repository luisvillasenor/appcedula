<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Calendario</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>bootstrap/css/appcedula.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" />
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
  
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
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>
        
        
    
    <div class="row-fluid span10 control-group warning">              
    <!--Body content-->

        
<?php foreach ($get_one_act_edit as $act ) : ?>                 
      <?php echo form_open(base_url().'/actividades/actualizar_act'); ?>
        <fieldset>
          <legend>Calendario de la Actividad</legend>            
          <table>
            <tr>
            <th rowspan="1">QUE</th>
            <td>                
                <label>ID: <?php echo $act->id_act;?></label>
                <input class="input-xxlarge" id="id_act" name="id_act" type="hidden" value="<?php echo $act->id_act;?>">
                <input class="input-xxlarge" id="actividad" name="actividad" type="text" value="<?php echo $act->actividad;?>">
                <label></label>
                <input class="input-xxlarge" id="descripcion" name="descripcion" type="text" value="<?php echo $act->descripcion;?>">
                <label></label>
                <input class="input-xxlarge" id="justificacion" name="justificacion" type="text" value="<?php echo $act->justificacion;?>">
                <label>Categoría de la Actividad</label>
                <select class="span3 inline" id="id_categoria" name="id_categoria">
                  <?php foreach ($get_categorias as $categos ) :
                    if($act->id_categoria == $categos->id_categoria) {?>
                    <option value="<?php echo $categos->id_categoria;?>" selected><?php echo $categos->categoria;?></option>
                    <?php } else { ?>
                        <option value="<?php echo $categos->id_categoria;?>"><?php echo $categos->categoria;?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
            </td>
            </tr>
                        <tr>
            <th rowspan="1">QUIEN</th>
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
                <span class="add-on">$</span>
                <input class=" uneditable-input" id="costo_secture" name="costo_secture" type="text" value="<?php echo $act->costo_secture;?>">
                
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
                <input class="input-xxlarge" id="ubicacion" name="ubicacion" type="text" value="<?php echo $act->ubicacion;?>">
            </td>
            
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Actualizar Cédula</button>
        </fieldset>
      <?php echo form_close(); ?>
    
<?php endforeach; ?>        
        
    </div><!— /row span12 —>
    </div>   
</div><!— /container —>


<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-button.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-modal.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-popover.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-typeahead.js"></script>
</body>
</html>