<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Responsable</title>   
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
<script language="javascript">
    function getCoord() {
        var obj
        var mylist = document.getElementById("grupo");
        var VALOR = mylist.options[mylist.selectedIndex].value;
        
            if(VALOR == "coordinador"){
                    document.getElementById("id_coord").style.visibility="visible";
            }else{
                document.getElementById("id_coord").style.visibility="hidden";
            }
    }        
    function getCoordonLoad() {
        var obj
        var mylist = document.getElementById("grupo");
        var VALOR = mylist.options[mylist.selectedIndex].value;
        
            if(VALOR == "coordinador"){
                document.getElementById("id_coord").style.visibility="visible";
            }else{
                document.getElementById("id_coord").style.visibility="hidden";
            }
    } 
</script>
    
</head>

<body onload="getCoordonLoad()">
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <?php include 'include/nav_actividades.php';  ?>             
      
    <div class="row-fluid span8 control-group info">              
    <!--Body content-->
        <div class="well"><h3>Agregar Nuevo Responsable</h3></div>
                        
      <?php echo validation_errors(); ?>
    <?php echo form_open(base_url().'users/agregar'); ?>
        <div class="well">
              <?php
                echo form_label('Nombre(s): ',  'nombre' ) ; 
                echo form_input('nombre', set_value('nombre'), 'id="nombre"');
              ?>
              <?php
                echo form_label('Apellido(s): ',  'apellido' ) ; 
                echo form_input('apellido', set_value('apellido'), 'id="apellido"');
              ?>
              <?php 
                echo form_label('Email de Sesión: ',  'email_address' ) ; 
                echo form_input('email_address', set_value('email_address'), 'id="email_address" ');
                ?>
            <?php 
                echo form_label('Email de Notificación: ',  'email_notify' ) ; 
                echo form_input('email_notify', set_value('email_notify'), 'id="email_notify" ');
                ?>
              <?php 
                echo form_label('Password: ',  'password' ) ; 
                echo form_password('password', '', 'id="password" ');
              ?><br>
              <?php $grupo = array('gestor','administrador','coordinador');   
                echo form_label('Grupo: ',  'grupo' ) ;?>
                <select class="inline" id="grupo" name="grupo" onchange="getCoord()">  
                  <?php foreach ($grupo as $value ) : ?>
                    <option value="<?php echo $value;?>"><?php echo $value;?></option>
                  <?php endforeach; ?>
                </select>                                
                <select class="inline" id="id_coord" name="id_coord" style="visibility:hidden">                        
                    <option>Seleccione la Coordinación Responsable</option>
                    <?php foreach ($get_all_coords as $coord ) : ?>
                    <option value="<?php echo $coord->id_coord;?>"><?php echo $coord->coordinacion;?></option>                  
                    <?php endforeach; ?>
                </select>
            

          </div>
        
          <button type="submit" class="btn btn-primary">Agregar Responsable</button>
      <?php echo form_close(); ?>     
        
    </div><!— /row span8 —>        
    
        
        
        
        
        
        
        
        
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