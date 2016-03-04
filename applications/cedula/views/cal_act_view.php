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
            
            <div class="well"><h3>PROGRAMACION GENERAL</h3></div>           
          
                   
          <table class="table table-bordered">
            <thead>
            <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
        </thead>
            <tbody>
              <tr>
                <th>EVENTO</th>
                <?php
                  $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                  foreach ($fechas as $value) {?>
                    <th><?php echo date("d M",strtotime($value));?></th>
                <?php }?>                
              </tr>
            <?php foreach ($get_cal_act as $actividades ) : ?>
              <tr>
                  <td>

                    <?php
                      if ( $fcTrabajo != $edicion ) { ?>
                        <span class="label"><?php echo "<b><small>".$actividades->actividad."</small></b>";?></span>
                    <?php  } else { ?>
                        <a href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Programa Detallado de la Cédula No. <?php echo $actividades->id_act;?>"><span class="label"><?php echo "<b><small>".$actividades->actividad ."</small></b>"?></span></a>
                    <?php  } ?>

                    
                  
                  </td>
                  <td>
                      <?php if ($actividades->d1 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d1 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>        
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d2 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d2 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d3 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d3 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>       
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>                 
                  <td>
                      <?php if ($actividades->d4 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d4 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>       
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>                
                  <td>
                      <?php if ($actividades->d5 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d5 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>       
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d6 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d6 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>        
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d7 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d7 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>        
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d8 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d8 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>        
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d9 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d9 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>        
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>
                  <td>
                      <?php if ($actividades->d10 != 0) 
                      {  ?>
                      <div class="text-center"><i class="icon-ok"></i></div>
                      <ul>
                            <?php foreach ($show_subacts as $necs ) : 
                                if ($actividades->id_act == $necs->id_act AND $actividades->d10 == $necs->fecha_taller){ ?>
                                <li>
                                    <?php include 'include/subactividad.php';  ?>
                                </li>       
                                <?php } ?>                                                    
                            <?php endforeach; ?>
                      </ul>
                      <?php } ?>
                  </td>                  

                  
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