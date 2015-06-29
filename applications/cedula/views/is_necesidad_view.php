<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Necesidad</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" />
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
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
  </style>
    
    <style>
table, th, td
{
border-collapse:collapse;
border:1px solid black;
}
th, td
{
padding:15px;
}
</style>

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( ".datepicker" ).datepicker({ 
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
      
    <div class="row-fluid span10 control-group info">              
    <!--Body content-->
        
        
    <?php foreach ($get_one_act_edit as $actividades ) : ?>    
    <?php foreach ($get_one_nec_edit as $necesidades ) : ?>
      <?php echo form_open('necesidades/borrar_nec');

        echo form_hidden('id_act', $necesidades->id_act);
                        
        echo form_hidden('e_mail', $actividades->e_mail);
        echo form_hidden('actividad', $actividades->actividad);
        echo form_hidden('descripcion', $actividades->descripcion);
        echo form_hidden('justificacion', $actividades->justificacion);
        echo form_hidden('id_categoria', $actividades->id_categoria);
        echo form_hidden('quienpropone', $actividades->quienpropone);
        echo form_hidden('empresa', $actividades->empresa);
        echo form_hidden('puesto', $actividades->puesto);
        echo form_hidden('domicilio', $actividades->domicilio);
        echo form_hidden('telefono', $actividades->telefono);
        echo form_hidden('email', $actividades->email);
        echo form_hidden('web', $actividades->web);
        echo form_hidden('fecha_act', $actividades->fecha_act);
        echo form_hidden('fecha_aut', $actividades->fecha_aut);
        echo form_hidden('costo_secture', $actividades->costo_secture);
        echo form_hidden('costo_publico', $actividades->costo_publico);
        echo form_hidden('is_costo_secture', $actividades->is_costo_secture);
        echo form_hidden('is_costo_publico', $actividades->is_costo_publico);
        echo form_hidden('ubicacion', $actividades->ubicacion);
        echo form_hidden('id_coord', $actividades->id_coord);
        echo form_hidden('status_act', $actividades->status_act);
        echo form_hidden('d1', $actividades->d1);
        echo form_hidden('d2', $actividades->d2);
        echo form_hidden('d3', $actividades->d3);
        echo form_hidden('d4', $actividades->d4);
        echo form_hidden('d5', $actividades->d5);
        echo form_hidden('d6', $actividades->d6);
        echo form_hidden('d7', $actividades->d7);
        echo form_hidden('d8', $actividades->d8);
        echo form_hidden('d9', $actividades->d9);
        echo form_hidden('d10', $actividades->d10);
        echo form_hidden('hora_ini', $actividades->hora_ini);
        echo form_hidden('hora_fin', $actividades->hora_fin);
        
        echo form_hidden('id_nec', $necesidades->id_nec); 
        
        ?>
        
        <fieldset>
          <legend><div class="alert alert-error">ESTA A PUNTO DE BORRAR ESTE REGISTRO</div></legend>            
          <table>
            <tr>
            <th rowspan="1">NECESIDAD</th>
            <td>                
                
                <input class="input-xxlarge" name="descripcionec" id="descripcionec" type="text" value="<?php echo $necesidades->descripcionec;?>" disabled>
                <label></label>
                <input class="input-xxlarge" name="observaciones" id="observaciones" type="text" value="<?php echo $necesidades->observaciones;?>" disabled>
                <label></label>
            </td>
            </tr>
            <tr>
                <th rowspan="1">CANTIDAD</th>
                <td>                
                    <label></label>
                    <input class="input-xxlarge" name="cantidad" id="cantidad" type="text" value="<?php echo $necesidades->cantidad;?>" disabled>
                </td>
            </tr>
            <tr>
            <th rowspan="1">PRECIO UNITARIO</th>
            <td>                
                <label></label>
                <input class="input-xxlarge" name="precio_unitario" id="precio_unitario" type="text" value="<?php echo $necesidades->precio_unitario;?>" disabled>
            </td>
            </tr>
            <tr>
                <th rowspan="1">ENCARGADO DE ESTA NECESIDAD</th>
                <td>                
                    <label></label>
                    <input class="input-xxlarge" name="encargado" id="encargado" type="text" value="<?php echo $necesidades->encargado;?>" disabled>
                </td>
            </tr>              
           </table>
          <p><br>
          <button type="submit" class="btn btn-danger">¿ESTÁ SEGURO DE BORRARLO?</button>
        </fieldset>
      <?php echo form_close(); ?>
    <?php endforeach; ?> 
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