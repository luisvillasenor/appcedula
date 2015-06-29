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
        
        
    <?php foreach ($get_one_act_edit as $actividades ) :     
    
        echo form_open('actividades/borrar_act'); 
        echo form_hidden('id_act', $actividades->id_act);?>
        
        <fieldset>
          <legend><div class="alert alert-error">ESTA A PUNTO DE BORRAR ESTE REGISTRO</div></legend>            
          <table>
            <tr>
            <th rowspan="1">CEDULA DE ACTIVIDAD</th>
            <td>                
                
                <input class="input-large" name="" id="" type="text" value="<?php echo $actividades->id_act;?>" disabled>
                <label></label>
                <input class="input-xxlarge" name="" id="" type="text" value="<?php echo $actividades->actividad;?>" disabled>
                <label></label>
                <input class="input-xxlarge" name="" id="" type="text" value="<?php echo $actividades->descripcion;?>" disabled>
                <label></label>
            </td>
            </tr>
           </table>
          <p><br>
          <button type="submit" class="btn btn-danger">¿ESTÁ SEGURO DE BORRARLO?</button>
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