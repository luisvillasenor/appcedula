<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Coordinacion</title>   
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
    });      
  </script>
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <?php include 'include/nav_actividades.php';  ?>             
      
    <div class="row-fluid span8 control-group info">              
    <!--Body content-->
        
        <div class="well"><h3>Agregar Nueva Coordinación</h3></div> 
        
                
      <?php echo form_open('coordinadores/add_coord'); ?>
        <fieldset>                    
          <table>
            <tr>
            <th>COORDINACIÓN</th>
            <td>
                <input class="input-xxlarge" name="coordinacion" id="coordinacion" type="text" placeholder="Escriba aquí el nombre de la Coordinación"><span class="help-block"><small>Ejemplo: " Coordinacion de Participacion Ciudadana ". Sin comillas dobles</small></span>
                <label></label>
            </td>
            </tr>
            <tr>
                <th>RESPONSABLE</th>
                <td>                
                    <label>Seleccione al Responsable:</label>
                    <select class="input-xlarge inline" id="id_resp" name="id_resp">
                        <option></option>
                  <?php foreach ($get_all_resps as $resps ) :?>
                    <option value="<?php echo $resps->id_resp;?>"><?php echo $resps->responsable;?></option>                    
                  <?php endforeach; ?>
                </select>                    
                </td>
                <span class="help-block"><small>Agrege un nuevo responsable: <a data-toggle="modal" href="<?php echo base_url();?>/responsables/index"><i class="icon-user"></i> Administrador de Responsables &raquo;</a></small></span>
            </tr>
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </fieldset>
      <?php echo form_close(); ?>
        
        
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