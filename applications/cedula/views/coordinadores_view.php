<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Coordinadores View</title>   
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
      
        <div class="well"><h3>LISTADO DE COORDINACIONES</h3></div>           
                        
          <table class="table table-bordered">              
            <thead>
                <div>                    
                    <?php echo form_open('coordinadores/agregar_co'); ?>
                        <button type="submit" class="btn">Agregar Coordinación</button>
                    <?php echo form_close();?>                    
                </div>
            </thead>            
              <tr>
                <th></th> 
                <th>Coordinación</th>                                
              </tr>
              
              <?php foreach ($get_all_coords as $coord ) : ?>
              <tr>
                  <td>
                      <span><a href="<?php echo base_url();?>coordinadores/edit_coord/<?php echo $coord->id_coord;?>" data-toggle="tooltip" title="Editar Coordinador No. <?php echo $coord->id_coord;?>"><i class="icon-pencil"></i></a></span>                   
                  </td>
                  <td>
                      <?php echo $coord->coordinacion;?>
                      <?php foreach ($get_all_resps as $resps ) :
    
                        if($coord->id_resp == $resps->id_resp) {?>
                      
                        (<?php echo $resps->responsable;?>)
                        
                        <?php } ?>
                      
                      <?php endforeach; ?>
                  </td>                      
                  
              <?php endforeach; ?>            
          </table>        
          
        </div><!--Well content-->                        
        
    </div><!--Row Flow content-->

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