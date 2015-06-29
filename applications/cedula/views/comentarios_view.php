<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Comentarios View</title>   
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
background-color:#CAEAAD;color:black;
}
      h3 h4{text-align:center;}
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
        $('#myModal').modal('hide')
      });
    });  
      
  
          
          
  </script>
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
      <?php include 'include/nav_actividades.php';   ?>      
        
    
    <div class="span10 row-fluid">              
    <!--Body content-->
      
        <div class="well"><h4>CRONOLOGÍA DE COMENTARIOS</h4></div>
        
                  
                  
            <table class="table table-bordered">
                <?php foreach ($get_one_act_edit as $actividades ) : ?>
            <tr>
            <th rowspan="1">CÉDULA No. <?php echo $actividades->id_act;?></th>
            </tr>
            <tr>
            <td>
                <a href="<?php echo base_url();?>actividades/vista_previa/<?php echo $actividades->id_act;?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><?php echo $actividades->actividad;?></i></a>              
            </td>
            </tr>
                <?php endforeach; ?>
                </table>
          <table class="table table-bordered">              
            <thead>
                <div >
                    <?php foreach ($get_one_act_edit as $actividades ) : ?>                                        
                        <?php 
                            echo form_open('comentarios/agregar_com'); 
                            echo form_hidden('id_act', $actividades->id_act);
                            echo form_hidden('e_mail', $actividades->e_mail);
                            
                        ?>
                        <button type="submit" class="btn">Agregar Comentario</button>
                        <?php echo form_close();?>
                    
                    <?php endforeach; ?>                     
                </div>
                
            </thead>            
              <tr> 
                <th colspan="1"></th>
                <th>Fecha</th>
                <th>Publicado por</th>
                
                <th>Comentario</th>
                
                
              </tr>
              <?php foreach ($get_all_com_act as $comentarios ) : ?>
                  <tr>
                      <td></td>
                      <td><?php echo $comentarios->fecha_ult_com;?></td>
                      <td><?php echo $comentarios->usuario;?></td>
                      
                      <td><?php echo $comentarios->comentarios;?></td>
                      
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