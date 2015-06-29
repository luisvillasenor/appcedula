<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Coordinacion</title>   
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
      
    <div class="row-fluid span10 control-group info">              
    <!--Body content-->
        
                    
    <?php foreach ($get_one_coord_edit as $coordinacion ) : 
        echo form_open('coordinadores/actualizar_coord'); 
        echo form_hidden('id_fc', $coordinacion->id_fc);
        echo form_hidden('id_coord', $coordinacion->id_coord);                
        echo form_hidden('coordinacion', $coordinacion->coordinacion);?>        
        <fieldset>
          <legend>Actualizar Coordinación</legend>            
          <table> 
            <tr>
                <th>COORDINACION ID <span class="label label-warning"><?php echo $coordinacion->id_coord;?></span></th>
            </tr>
            <tr>
            <th>COORDINACIÓN</th>            
            <td>
                <input class="input-xxlarge" name="coordinacion" id="coordinacion" type="text" value="<?php echo $coordinacion->coordinacion;?>">
            </td>
            </tr>
            <tr>
                <th>RESPONSABLE</th>
                <td>
                <select class="input-xxlarge inline" id="id_resp" name="id_resp">
                  <?php foreach ($get_all_resps as $resps ) :
                    if($coordinacion->id_resp == $resps->id_resp) {?>
                    <option value="<?php echo $resps->id_resp;?>" selected><?php echo $resps->responsable;?></option>
                    <?php } else { ?>
                        <option value="<?php echo $resps->id_resp;?>"><?php echo $resps->responsable;?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                </td>
            </tr>           
            
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </fieldset>
      <?php echo form_close(); 
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