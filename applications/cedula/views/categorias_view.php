<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Categorias View</title>   
	<meta name="description" content="App Cédulas sobre Bootstrap 2.0">
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
      th
{
background-color:darkolivegreen;
color:white;
}
      h3{text-align:center;}
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
        
      <?php include 'include/nav_actividades.php';   ?>      
        
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
      
        <div class="well"><h3>LISTADO DE CATEGORIAS</h3></div>           
                        
          <table class="table table-bordered">              
            <thead>
                <div>                    
                    <?php echo form_open('categorias/categorias_agregar_view'); ?>
                        <button type="submit" class="btn">Agregar Categoria</button>
                    <?php echo form_close();?>                    
                </div>
            </thead>            
              <tr>
                <th colspan="1"></th>
                <th>Categoria</th>
                <th>Tipo de Coordinación</th>
              
                
              </tr>
              <?php foreach ($get_categorias as $cat ) : ?>
                  <tr>
                      <td>
                      <span><a href="<?php echo base_url();?>categorias/edit_cat/<?php echo $cat->id_categoria;?>" data-toggle="tooltip" title="Editar Necesidad No. <?php echo $cat->id_categoria;?>"><i class="icon-pencil"></i></a></span>
                      
                      </td>
                      <td><?php echo $cat->categoria;?></td>
                      
                      <?php foreach ($get_all_coords as $coord ) :

                        if($cat->id_coord == $coord->id_coord) {?>
                      
                        <td><?php echo $coord->coordinacion;?></td>
                        
                        <?php } ?>
                      
                      <?php endforeach; ?>
                  </tr>              
              <?php endforeach; ?>            
          </table>
        
          
        </div><!— /span9 —>
                        
        
    </div><!— /row —>

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