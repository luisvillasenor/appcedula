<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agregar Nuevo Comentario</title>   
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
        
        <div class="well"><h3>Agregar Nuevo Comentario de Cédula de Actividad</h3></div> 
        <?php foreach ($get_one_act_edit as $actividades ) : ?>                     
                    
            <table class="table table-bordered">
                <tr>
                <th rowspan="1">CÉDULA</th>
                </tr>
                <tr>
                <td>                
                    <?php echo $actividades->actividad;?>
                </td>
                </tr>
            </table>        
                
          <?php echo form_open('comentarios/add_com'); 
                echo form_hidden('id_act', $actividades->id_act);
                echo form_hidden('usuario', $actividades->e_mail);
                echo form_hidden('actividad', $actividades->actividad);
                ?>            
            <fieldset>                    
              <table>
                <tr>
                    <th rowspan="1">COMENTARIOS</th>
                    <td>                
                        <i class="icon-info-sign" data-toggle="tooltip" title="Escriba aquí sus comentarios..."></i><textarea class="input-xxlarge" id="comentarios" name="comentarios" rows="3" placeholder="Escriba aquí sus Comentarios a la cédula..."></textarea>
                    </td>                              
               </table>
               <br>
              <button type="submit" class="btn btn-primary">Agregar Comentario</button>
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