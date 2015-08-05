<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Nuevo Necesidad</title>   
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
        th
{
background-color:darkolivegreen;
color:white;
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
        if($.isNumeric($('#EmpNum').val())
    });      
  </script>
    
    
    <script language="javascript">

        function valida_numero() {
            
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
        
        <div class="well"><h3>Agregar Nueva Necesidad de Cédula de Actividad</h3></div> 
        <?php foreach ($get_one_act_edit as $actividades ) : ?>                                        
                    
                    
        <table class="table table-bordered">
            <tr>
            <th rowspan="1">CÉDULA</th>
            <td>                
                
                <label></label>
                <input class="input-xxlarge uneditable-input" type="text" value="<?php echo $actividades->actividad;?>">
                <label></label>
                <input class="input-xxlarge uneditable-input" type="text" value="<?php echo $actividades->descripcion;?>">
                
            </td>
            </tr>
        </table>
        
                
      <?php echo form_open('necesidades/add_nec'); 
        echo form_hidden('id_act', $actividades->id_act);
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

        ?>
        <fieldset>
                    
          <table>
            <tr>
            <th rowspan="1">NECESIDAD</th>
            <td>                
                
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la descripción..."> </i><input class="input-xxlarge" name="descripcionec" id="descripcionec" type="text" placeholder="Escriba aquí la descripción...">
                <label></label>
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí las observaciones ó unidad de medida..."> </i>
                <input class="input-xxlarge" name="observaciones" id="observaciones" type="text" placeholder="Escriba aquí las observaciones...">
                <label></label>
            </td>
            </tr>
            <tr>
                <th rowspan="1">CANTIDAD</th>
                <td>                
                    <label></label>
                    <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí la cantidad"> </i>
                    <input class="input-xxlarge" name="cantidad" id="cantidad" type="text" placeholder="Escriba aquí la cantidad" value="0">
                </td>
            </tr>
            <tr>
            <th rowspan="1">PRECIO UNITARIO sin IVA</th>
            <td>                
                <label></label>
                <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el precio unitario SIN iva"> </i>
                <input class="input-xxlarge" name="precio_unitario" id="precio_unitario" type="text" placeholder="Escriba aquí el precio unitario SIN iva" value="0.00">
            </td>
            </tr>
            <tr>
                <th rowspan="1">PROVEEDOR Ó ENCARGADO DE ESTE RUBRO</th>
                <td>                
                    <label></label>
                    <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí el encargado de esta necesidad"> </i>
                    <input class="input-xxlarge" name="encargado" id="encargado" type="text" placeholder="Escriba aquí el encargado de esta necesidad">
                </td>
            </tr>              
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Agregar</button>
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