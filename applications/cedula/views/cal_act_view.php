<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mis Cédulas</title>   
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
        
        <?php include 'include/nav_actividades.php';  ?>

        <div class="span10">
          <!--Body content-->      
            
            <div class="well"><h3>TABLA-CALENDARIO DE CÉDULAS</h3></div>           
          
                   
          <table class="table table-bordered">
            <thead></thead>
            <tbody>
              <tr>                
                <th>CÉDULA DE ACTIVIDAD</th>
                <th>RESPONSABLE</th>
                <th>31 OCT</th>
                <th>1 NOV</th>
                <th>2 NOV</th>
                <th>3 NOV</th>
                <th>4 NOV</th>
                  <th>5 NOV</th>
                  <th>6 NOV</th>
                  <th>7 NOV</th>
                  <th>8 NOV</th>
                  <th>9 NOV</th>
                  <th>HORA INICIO</th>
                  <th>HORA FIN</th>
                
              </tr>
            <?php foreach ($get_cal_act as $actividades ) : ?>
              <tr>
                  <td><?php echo $actividades->actividad;?></td>                  
                  <td><?php echo $actividades->quienpropone;?></td>                  
                  <td><?php if ($actividades->d1 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d2 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>
                  <td><?php if ($actividades->d3 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d4 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d5 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d6 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d7 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d8 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d9 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($actividades->d10 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php echo $actividades->hora_ini;?></td> 
                  <td><?php echo $actividades->hora_fin;?></td> 
                  
                  
              </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
          
          
        </div><!— /span8 —>

        
            
            
            
        </div>

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