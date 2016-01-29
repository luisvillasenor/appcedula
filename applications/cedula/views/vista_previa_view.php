<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>VISTA PREVIA</title>   
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
    #pesos{text-align: right}
    #cantidad{text-align: center}
    #pesos_total{text-align: right; background-color: black; color: white; font-size: 16px;}
th
{
background-color:#000;
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
    
<script>
  function validacion() {
      
      pres_ant2 = document.getElementById("pres_ant2").value;
      pres_aut2 = document.getElementById("pres_aut2").value;
      pres_eje2 = document.getElementById("pres_eje2").value;
      
        if( pres_ant2 == null || pres_ant2.length == 0 || /^\s+$/.test(pres_ant2)) {
          alert('[ERROR] El campo PRESUPUESTO AÑO ANTERIOR debe tener un valor NUMËRICO');
          return false;
        }
          else if ( pres_aut2 == null || pres_aut2.length === 0 || /^\s+$/.test(pres_aut2)) {
            // Si no se cumple la condicion...
            alert('[ERROR] El campo AUTORIZADO debe tener un valor NUMËRICO');
            return false;
          }
            else if ( pres_eje2 == null || pres_eje2.length === 0 || /^\s+$/.test(pres_eje2)) {
            // Si no se cumple la condicion...
            alert('[ERROR] El campo EJERCIDO debe tener un valor NUMËRICO');
            return false;
          }
            else if( isNaN(pres_ant2) ) {
                alert('[ERROR] El campo PRESUPUESTO AÑO ANTERIOR debe tener un valor NUMËRICO');
                return false;
            }
              else if ( isNaN(pres_aut2) ) {
                // Si no se cumple la condicion...
                alert('[ERROR] El campo AUTORIZADO debe tener un valor NUMËRICO');
                return false;
              }
     
      // Si el script ha llegado a este punto, todas las condiciones
      // se han cumplido, por lo que se devuelve el valor true
      return true;
    }
</script>
    
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">
    <div id="wrapper" class="row-fluid">        

        <div class="span12">
        <!--Body content-->
            <div class="text-center"><h5>VISTA PREVIA DE LA CÉDULA</h5></div>
            
            <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
            
            <hr>

<?php /* APROBACION CONCEPTUAL.- VISTA SOLO PARA LOS COORDINADORES */
$app = $_SESSION['username']; /** Cacho la sesion del usaurio **/
  switch ($app) {
      case 'rabingarcia@app.com':      
        foreach ($get_one_act_edit as $actividades2 ) : 
            include 'include/nav_ops_aut_2.php';  
        endforeach;        
        break;      
      case 'appcedula@app.com':      
        foreach ($get_one_act_edit as $actividades2 ) : 
            include 'include/nav_ops_aut_2.php';  
        endforeach;        
        break;
      default:                                            
        break; 
    } 
?>
            
            <div class="well">
             
            <table class="table table-bordered">
                <?php foreach ($get_one_act_edit as $actividades ) : ?>
                <thead>CÉDULA No. 
                    <span class="badge badge-inverse"><?php echo $actividades->id_act;?>
                    
                        <?php switch ($actividades->status_act) {
                              case '1':?>
                                <th><span name="flag" id="flag" class="label label-important"><h3>No Autorizado</h3></span></th>
                        <?php break;
                              case '2':?>
                                <th><span name="flag" id="flag" class="label label-success"><h3>Autorizado Conceptual</h3></span></th>
                        <?php break;
                              case '3':?>
                                <th><span name="flag" id="flag" class="label label-info"><h3>Integrado al Programa General</h3></span></th>
                        <?php break;
                              case '4':?>
                                <th><span name="flag" id="flag" class="label label-inverse"><h3>Presupuesto Autorizado</h3></span></th>
                        <?php break;
                              case '6':?>
                                <th><span name="flag" id="flag" class="label label-default"><h3>Fuera de Presupuesto</h3></span></th>
                        <?php break;
                              default: ?>
                                <th><span name="flag" id="flag" class="label label-warning"><h3>Pendiente Aprobación</h3></span></th>
                        <?php break;
                              } ?>
                    </span>
                    <span>EDICION 201<?php echo $actividades->id_fc;?></span>
                </thead>
                <tr>
                    <th>ACTIVIDAD</th>
                    <td><?php echo $actividades->actividad;?></td>
                </tr>
                <tr>
                    <th>CATEGORIA</th>
                        <td>
                            <?php 
                                foreach ($get_categorias as $categos ) :
                                    if($actividades->id_categoria == $categos->id_categoria) 
                                        { echo $categos->categoria; } 
                                endforeach;
                            ?>                        
                        </td>
                        
                </tr>
                <tr><th>DESCRIPCIÓN</th><td><?php echo $actividades->descripcion;?></td></tr>
                <tr><th>JUSTIFICACIÓN</th><td><?php echo $actividades->justificacion;?></td></tr>
                <tr><th>RESPONSABLE</th><td><?php echo $actividades->quienpropone;?></td></tr>
                <?php endforeach; ?>
            </table>
                <hr>            
            <table class="table table-bordered">
            <thead>DESGLOSE DE NECESIDADES</thead>
              <tr>                
                <th>Necesidades, Descripción</th>
                <th>Necesidades, Observaciones</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>Precio Total</th>                               
              </tr>
              <?php $tot = 0; foreach ($get_all_nec_act as $necesidades ) : ?>
                  <tr>                      
                      <td><?php echo $necesidades->descripcionec;?></td>
                      <td><?php echo $necesidades->observaciones;?></td>
                      <td id="cantidad"><?php echo $necesidades->cantidad;?></td>
                      <td id="pesos">$<?php echo number_format($necesidades->precio_unitario,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format($necesidades->precio_total,2,".",",");?></td>
                      
                  </tr>                    
              <?php $tot += $necesidades->precio_total;?>              
              <?php endforeach; ?>
                <tr>
                  <td colspan="3"></td>
                  <td id="pesos" colspan="1">SUBTOTAL:</td>
                  <td id="pesos">$
                     <?php
                        foreach ($get_total_act as $tot2 ) : 
                            echo number_format($tot2->total_act,2,".",",");
                        endforeach;
                      ?>
                  </td>            
              </tr>
                <tr>
                  <td colspan="3"></td>
                  <td id="pesos" colspan="1">IVA:</td>
                  <td id="pesos">$
                     <?php
                        foreach ($get_total_act as $tot2 ) : 
                            echo number_format($tot2->tot_iva,2,".",",");
                        endforeach;
                      ?>
                  </td>            
              </tr>
              <tr>
                  <td colspan="3"></td>
                  <td id="pesos" colspan="1">GRAN TOTAL:</td>
                  <td id="pesos_total">$
                     <?php 
                        foreach ($get_total_act as $tot ) : 
                            echo number_format($tot->tot_tot,2,".",",");
                        endforeach;
                      ?>
                  </td>            
              </tr>
            </table>
            <hr> 
            <!-- *********************************************************************** -->
                  
            <?php /* APROBACION PRESUPUESTAL.- VISTA SOLO POR EL COORDINADOR GENERAL y APPCEDULA */
            $app = $_SESSION['username']; /** Cacha la sesion del usuario **/
              switch ($app) {
                  case 'appcedula@app.com':      
                        include 'include/nav_ops_aut_4B.php';
                    break;
                  case 'jorgeandrade@app.com':      
                        include 'include/nav_ops_aut_4B.php';
                    break;
                  case 'blancamartinez@app.com':      
                        include 'include/nav_ops_aut_4B.php';
                    break;
                  case 'oscarmorales@app.com':      
                        include 'include/nav_ops_aut_4B.php';
                    break;
                  default:
                        include 'include/nav_ops_aut_5.php';
                    break;
                } 
            ?>
            
            <hr>
            <table class="table table-bordered">            
            <tbody class="text-center">
              <tr>                
                <th>Frecuencia de la actividad</th>
                <?php
                  $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                  foreach ($fechas as $value) {?>
                    <th><?php echo date("d M",strtotime($value));?></th>
                <?php }?>
                
                  <th>HORA INICIO</th>
                  <th>HORA FIN</th>
                
              </tr>
            <?php foreach ($get_cal_id_act as $get_cal ) : ?>
              <tr>
                  <td><?php echo $get_cal->actividad;?></td>                  
                  <td><?php if ($get_cal->d1 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d2 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>
                  <td><?php if ($get_cal->d3 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d4 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d5 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d6 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d7 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d8 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d9 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php if ($get_cal->d10 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                  <td><?php echo $get_cal->hora_ini;?></td> 
                  <td><?php echo $get_cal->hora_fin;?></td>                  
              </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
                <hr>
            <table class="table table-bordered">
            <thead>                
                <div >
                    <?php foreach ($get_one_act_edit as $actividad ) : ?>                                        
                        <?php 
                            echo form_open('comentarios/agregar_com_preview'); 
                            echo form_hidden('id_act', $actividad->id_act);
                            
                        ?>
                        <button type="submit" class="btn">Agregar Comentario</button>
                        <?php echo form_close();?>
                    
                    <?php endforeach; ?>                     
                </div>
            </thead>
            <tbody>
              <tr>                
                <th>Fecha</th>
                <th>Publicado por</th>                
                <th>Comentarios</th>
              </tr>
            <?php foreach ($get_all_com_act as $comentarios ) : ?>
              <tr>
                  <td><?php echo $comentarios->fecha_ult_com;?></td>
                      <td><?php echo $comentarios->usuario;?></td>
                      
                      <td><?php echo $comentarios->comentarios;?></td>  
                
              </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
                
           
                
            </div>
            
        </div><!— /span12 —>
        
    </div><!— /row —>    
    
</div><!— /container —>
    
    




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