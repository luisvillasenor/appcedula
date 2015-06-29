<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Categoria</title>   
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
        
                    
    <?php foreach ($get_one_cat_edit as $categoria ) : 
        echo form_open('categorias/actualizar_cat'); 
        echo form_hidden('id_categoria', $categoria->id_categoria);
        echo form_hidden('id_coord', $categoria->id_coord);                
        echo form_hidden('categoria', $categoria->categoria);?>        
        <fieldset>
          <legend>Reasignar Categoria</legend>            
          <table> 
            <tr>
                <th>CATEGORIA ID <span class="label label-warning"><?php echo $categoria->id_categoria;?></span></th>
            </tr>
            <tr>
                <th>NOMBRE DE LA CATEGORIA</th>
                <td><?php echo $categoria->categoria;?></td>                
            </tr>            
            <tr>
                <th>COORDINADOR ASIGNADO</th>
                <td>
                    <select class="input-xxlarge" id="id_coord" name="id_coord">
                      <?php foreach ($get_all as $coord ) :
                        if($categoria->id_coord == $coord->id_coord) {?>
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