<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Responsables View</title>   
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
        
    
    <div class="row-fluid span10 control-group warning">              
    <!--Body content-->
      
        <div class="well"><h3>LISTADO DE RESPONSABLES</h3></div>           
                        
          <table class="table table-bordered">              
            <thead>
                <div>                    
                    <?php echo form_open('users/agregar_usr'); ?>
                        <button type="submit" class="btn">Agregar Responsable</button>
                    <?php echo form_close();?>                    
                </div>
            </thead>            
              <tr>
                <th></th> 
                <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Email de Sesión</th>
                  <th>Email de Notificación</th>
                  <th>Fecha Alta</th>
                  <th>Fecha Ult Acceso</th>
                  <th>Grupo</th>
                  <th>Coordinacion Responsable</th> 
              </tr>
              
              <?php foreach ($get_all_users as $resps ) : ?>
              <tr>
                  <td>
                      <span><a href="<?php echo base_url();?>users/edit_resp/<?php echo $resps->id;?>" data-toggle="tooltip" title="Editar Coordinador No. <?php echo $resps->id;?>"><i class="icon-pencil"></i></a></span>                   
                  </td>
                  <td><?php echo $resps->id;?></td>
                  <td><?php echo $resps->nombre;?></td>
                  <td><?php echo $resps->apellido;?></td>
                  <td><?php echo $resps->email_address;?></td>
                  <td><?php echo $resps->email_notify;?></td>
                  <td><?php echo $resps->fecha_creacion;?></td>
                  <td><?php echo $resps->fecha_ult_acceso;?></td>
                  <td><?php echo $resps->grupo;?></td>
                  <?php foreach ($get_all_coords as $coord ) :

                        if($resps->id_coord == $coord->id_coord) {?>
                      
                        <td><?php echo $coord->coordinacion;?></td>
                        
                        <?php } ?>
                      
                      <?php endforeach; ?>
              </tr>              
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