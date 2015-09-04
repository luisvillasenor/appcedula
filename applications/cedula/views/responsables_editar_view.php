<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Responsable</title>   
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
                document.getElementById("id_coord").value="0";
                document.getElementById("id_coord").style.visibility="hidden";
            }
    }        
</script>
</head>

<body onLoad="getCoord()">
<?php include 'include/nav_perfil.php';  ?>
<div class="container-fluid">
    <div id="wrapper" class="row-fluid"><?php include 'include/nav_actividades.php';  ?>      
    <div class="row-fluid span10 control-group info">
    <!--Body content-->                    
    <?php 
        foreach ($get_one_usr_edit as $resps ) : 
        echo form_open('users/actualizar_resp'); 
        echo form_hidden('id', $resps->id);                
        echo form_hidden('password', $resps->password);                
        echo form_hidden('fecha_creacion', $resps->fecha_creacion);
        ?> 
        <fieldset>
          <legend>Actualizar Responsable</legend>            
          <table> 
            <tr><th>RESPONSABLE ID <span class="label label-warning"><?php echo $resps->id;?></span></th></tr>
            <tr><th>Nombre</th>
                <td><input class="input-xxlarge" name="nombre" id="nombre" type="text" value="<?php echo $resps->nombre;?>"></td>
            </tr>
              <tr><th>Apellido</th>
                <td><input class="input-xxlarge" name="apellido" id="apellido" type="text" value="<?php echo $resps->apellido;?>"></td>
            </tr>
              <tr><th>Email de Sesión</th>
                <td><input class="input-xlarge" name="email_address" id="email_address" type="text" value="<?php echo $resps->email_address;?>"></td>
            </tr>
              <tr><th>Email de Notificación</th>
                <td><input class="input-xlarge" name="email_notify" id="email_notify" type="text" value="<?php echo $resps->email_notify;?>"></td>
            </tr>
              <tr><th>Grupo</th>
                  <td>
                  <?php $grupo = array('gestor','administrador','coordinador','presupuesto');   ?>
                <select class="inline" id="grupo" name="grupo" onchange="getCoord()">  
                  <?php foreach ($grupo as $value ) : 
                    if($value == $resps->grupo) {?>
                            <option value="<?php echo $value;?>" selected><?php echo $value;?></option>
                        <?php } else { ?>
                            <option value="<?php echo $value;?>"><?php echo $value;?></option>
                        <?php } ?>
                  <?php endforeach; ?>
                </select>
                    </td>
                  
            </tr>
            <tr>
              <tr><th>Coordinación</th>
                <td>
                    <select class="inline" id="id_coord" name="id_coord">                        
                    
                      <?php foreach ($get_all_coords as $coord ) :
                        if($resps->id_coord == $coord->id_coord) {?>
                        <option value="<?php echo $coord->id_coord;?>" selected><?php echo $coord->coordinacion;?></option>
                        <?php } else { ?>
                            <option value="<?php echo $coord->id_coord;?>"><?php echo $coord->coordinacion;?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                </td>
            </tr>
                
              
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </fieldset>
    <?php 
        echo form_close(); 
        endforeach; ?>          
    </div><!--Body content-->      
    </div> <!--Wrap content-->   
</div><!--Conteiner content-->
    





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