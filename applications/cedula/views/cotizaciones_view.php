<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cotizaciones View</title>   
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
background-color:#FE9042;
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
        
      <?php include 'include/nav_actividades.php';   ?>      
        
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
      
                  
            <table class="table table-bordered">
                <?php foreach ($get_one_act_edit as $actividades ) : ?>
            <tr>
            <th rowspan="1">CÉDULA No. <?php echo $actividades->id_act;?></th>
            <td>
                <?php echo $actividades->actividad;?>                
            </td>
            </tr>
                <?php endforeach; ?>
                </table>
          <table class="table table-bordered">              
            <thead>
                <div >
                    <?php foreach ($get_one_act_edit as $actividades ) : ?>                                        
                        <?php 
                            echo form_open('necesidades/agregar_nec'); 
                            echo form_hidden('id_act', $actividades->id_act);
                        ?>
                        <button type="submit" class="btn">Agregar Cotización</button>
                        <?php echo form_close();?>
                    <?php endforeach; ?>                    
                </div>
            </thead>            
              <tr>
                <th colspan="2"></th>
                <th>Proveedor</th>
                <th>Necesidades, Observaciones</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Precio Total</th>
                <th colspan="2">Status</th>
                
              </tr>
              <?php $tot = 0; foreach ($get_all_nec_act as $necesidades ) : ?>
                  <tr>
                      <td>
                      <a href="<?php echo base_url();?>necesidades/edit_nec/<?php echo $necesidades->id_act;?>/<?php echo $necesidades->id_nec;?>" data-toggle="tooltip" title="Editar Necesidad No. <?php echo $necesidades->id_nec;?>"><i class="icon-edit"></i></a></td>
                      <td>
                      <a href="<?php echo base_url();?>necesidades/is_borrar_nec/<?php echo $necesidades->id_act;?>/<?php echo $necesidades->id_nec;?>" data-toggle="tooltip" title="Borrar Necesidad No. <?php echo $necesidades->id_nec;?>"><i class="icon-trash"></i></a>
                      
                  </td>
                      <td><?php echo $necesidades->descripcion;?></td>
                      <td><?php echo $necesidades->observaciones;?></td>
                      <td><?php echo $necesidades->cantidad;?></td>
                      <td>$<?php echo number_format($necesidades->precio_unitario,2,".",",");?></td>
                      <td>$<?php echo number_format($necesidades->precio_total,2,".",",");?></td>
                      <td><input type="checkbox" id="d1" name="d1" value=""></td>
                      <td><a href="<?php echo base_url();?>necesidades/is_borrar_nec/<?php echo $necesidades->id_act;?>/<?php echo $necesidades->id_nec;?>" data-toggle="tooltip" title="Actualizar"><i class="icon-refresh"></i></a></td>
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