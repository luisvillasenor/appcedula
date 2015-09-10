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
            <div class="text-center"><h2>CONSOLIDADO DE LA CÉDULA</h2></div>
            


<?php /* APROBACION CONCEPTUAL.- VISTA SOLO PARA LOS ADMINISTRADORES */
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
                <thead>                   
                    
                        <?php switch ($actividades->status_act) {
                              case '1':?>
                                <th><span name="flag" id="flag" class="label label-important"><h4>STATUS: CÉDULA NO AUTORIZADA</h4></span></th>
                        <?php break;
                              case '2':?>
                                <th><span name="flag" id="flag" class="label label-success"><h4>STATUS: Autorizado Conceptual</h4></span></th>
                        <?php break;
                              case '3':?>
                                <th><span name="flag" id="flag" class="label label-info"><h4>STATUS: Integrado al Programa General</h4></span></th>
                        <?php break;
                              case '4':?>
                                <th><span name="flag" id="flag" class="label label-inverse"><h4>STATUS: Presupuesto Autorizado</h4></span></th>
                        <?php break;
                              case '5':?>
                                <th><span name="flag" id="flag" class="label label-inverse"><h4>STATUS: UPS!!! Bloqueado</h4></span></th>
                        <?php break;
                              case '6':?>
                                <th><span name="flag" id="flag" class="label label-inverse"><h4>STATUS: Fuera de Presupuesto</h4></span></th>
                        <?php break;
                              default: ?>
                                <th><span name="flag" id="flag" class="label label-warning"><h4>STATUS: Pendiente Aprobación</h4></span></th>
                        <?php break;
                              } ?>
                    
                </thead>
                <tr>
                    <th>ID: <?php echo $actividades->id_act;?></th>
                </tr>
                <tr>
                    <th>ACTIVIDAD: <?php echo $actividades->actividad;?></th>
                </tr>
                <tr><th>RESPONSABLE: <?php echo $actividades->quienpropone;?></th></tr>
                <?php endforeach; ?>
            </table>
            <hr>            
            <table class="table table-bordered">
            <thead><h2>DETALLE DE LA CEDULA</h2></thead>
              <tr>
                <th></th>
                <th>Necesidades, Descripción</th>
                <th>Necesidades, Observaciones</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>Precio Total</th>                               
              </tr>
              <?php $tot = 0; foreach ($get_all_nec_act as $necesidades ) : ?>
                  <tr>                      
                      <td>
                        <!-- Button to trigger modal -->
                          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal_<?php echo $necesidades->id_nec;?>">Clasificar</button>
                          <!-- Modal -->
                          <div id="myModal_<?php echo $necesidades->id_nec;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form role="form" class="form-horizontal" action="<?php echo base_url('actividades/consolidar');?>" method="post">  
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Clasificación por Concepto del Gasto</h3>
                              <small>Cédula ID: <?php echo $necesidades->id_act; ?></small>
                            </div>
                            <div class="modal-body">
                                <input name="id_act" id="id_act" type="hidden" value="<?php echo $necesidades->id_act; ?>">
                                
                                <div class="control-group">
                                  <div class="controls">
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="F"> Factura
                                    </label>
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="R"> Requisición
                                    </label>
                                  </div>
                                </div>

                                
                                <div class="control-group">
                                  <label class="control-label" for="clasificacion">Clasificacion del Gasto</label>
                                  <div class="controls">
                                    <input type="text" name="clasificacion" id="clasificacion">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="proveedor">Proveedor</label>
                                  <div class="controls">
                                    <input type="text" name="proveedor" id="proveedor">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="concepto">Descripcion / Observaciones</label>
                                  <div class="controls">
                                    <textarea cols="5" name="concepto" id="concepto" type="text">
                                      <?php echo $necesidades->descripcionec;?>
                                      <?php echo $necesidades->observaciones;?>
                                    </textarea>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="cantidad">Cantidad <small>Numero entero</small></label>
                                  <div class="controls">
                                    <input type="text" name="cantidad" id="cantidad" value="<?php echo $necesidades->cantidad;?>">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="preciounitario">Precio Unitario:</label>
                                  <div class="controls">
                                    <input type="text" name="precio_unitario" id="precio_unitario" value="<?php echo number_format($necesidades->precio_unitario,2,".",",");?>">
                                  </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success btn-block">ENVIAR A CONSOLIDADO</button>                              
                            </div>
                          </form>  

                          </div>
                          <!-- End Modal --> 
                      </td>
                      <td><?php echo $necesidades->descripcionec;?></td>
                      <td><?php echo $necesidades->observaciones;?></td>
                      <td><?php echo $necesidades->encargado;?></td>
                      <td><?php echo $necesidades->cantidad;?></td>
                      <td>$<?php echo number_format($necesidades->precio_unitario,2,".",",");?></td>
                      <td>$<?php echo number_format($necesidades->precio_total,2,".",",");?></td>
                      
                  </tr>                    
              <?php $tot += $necesidades->precio_total;?>              
              <?php endforeach; ?>
                <tr>
                
                  <td colspan="5"></td>
                  <td colspan="1">SUBTOTAL:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     <?php
                        foreach ($get_total_act as $tot2 ) : 
                            echo number_format($tot2->total_act,2,".",",");
                        endforeach;
                      ?></span>
                  </td>            
              </tr>
                <tr>
                
                  <td colspan="5"></td>
                  <td colspan="1">IVA:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     <?php
                        foreach ($get_total_act as $tot2 ) : 
                            echo number_format($tot2->tot_iva,2,".",",");
                        endforeach;
                      ?></span>
                  </td>            
              </tr>
              <tr>

                  <td colspan="5"></td>
                  <td colspan="1">GRAN TOTAL:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     <?php 
                        foreach ($get_total_act as $tot ) : 
                            echo number_format($tot->tot_tot,2,".",",");
                        endforeach;
                      ?></span>
                  </td>            
              </tr>
            </table>
            <hr>
            <!-- *********************************************************************** -->
                  
            <?php /* APROBACION PRESUPUESTAL.- VISTA SOLO POR EL COORDINADOR GENERAL y APPCEDULA */
            $app = $_SESSION['username']; /** Cacha la sesion del usuario 
              switch ($app) {
                  case 'appcedula@app.com':      
                        include 'include/nav_ops_aut_4BP.php';
                    break;
                  case 'blancamartinez@app.com':      
                        include 'include/nav_ops_aut_4BP.php';
                    break;
                  case 'oscarmorales@app.com':      
                        include 'include/nav_ops_aut_4BP.php';
                    break;                  
                } **/
            ?>


            <table id="tabla_presupuesto" class="table table-bordered">
            <thead><h2>CONSOLIDADO</h2></thead>
              <!-- Button to trigger modal -->
              <button style="margin:7px 15px 17px 0;" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal_GASTO"><i class="icon-white icon-plus"></i><strong> Agregar Concepto </strong></button>
              <!-- Modal -->
                          <div id="myModal_GASTO" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <form role="form" class="form-horizontal">  
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Clasificación por Concepto del Gasto</h3>
                            </div>
                            <div class="modal-body">                             
                                <div class="radio">
                                  <label><input name="" id="" type="radio" value="F"> Factura</label>
                                  <label><input name="" id="" type="radio" value="R"> Requisición</label>
                                </div>                                
                                <div class="form-group">
                                  <label for="clasificacion">Clasificacion del Gasto</label>
                                  <input type="text" class="form-control" id="clasificacion">
                                </div>
                                <div class="form-group">
                                  <label for="clasificacion">Proveedor</label>
                                  <input type="text" class="form-control" id="clasificacion">
                                </div>
                                <div class="form-group">
                                  <label for="concepto">Descripcion</label>
                                  <textarea type="text" class="form-control" id="concepto"></textarea>                                  
                                </div>
                                <div class="form-group">
                                  <label for="cantidad">Cantidad</label>
                                  <input type="text" class="form-control" id="cantidad" value="">
                                </div>
                                <div class="form-group">
                                  <label for="preciounitario">Precio Unitario:</label>
                                  <input type="text" class="form-control" id="preciounitario" value="">
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success btn-block">ENVIAR A CONSOLIDADO</button>                              
                            </div>
                          </form>  

                          </div>
                          <!-- End Modal -->            
              <tr>                
                <th>Tipo</th>
                <th>Clasificacion</th>
                <th>Proveedor</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>Precio Total</th>                               
              </tr>
              <?php $tot = 0; foreach ($get_all_cons_act as $cons_item ) : ?>
                  <tr>
                      <td><?php echo $cons_item->tipo;?></td>                                           
                  </tr>                    
              <?php $tot += $cons_item->precio_total;?>              
              <?php endforeach; ?>
                <tr>
                  <td colspan="5"></td>
                  <td colspan="1">SUBTOTAL:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     <?php /*
                        foreach ($get_all_cons_act as $tot2 ) : 
                            echo number_format(0,2,".",",");
                        endforeach;*/
                      ?></span>
                  </td>            
              </tr>
                <tr>
                  <td colspan="5"></td>
                  <td colspan="1">IVA:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     </span>
                  </td>            
              </tr>
              <tr>
                  <td colspan="5"></td>
                  <td colspan="1">GRAN TOTAL:</td>
                  <td align="center" valign="middle"><span class="badge badge-inverse">$
                     </span>
                  </td>            
              </tr>
            </table>
            
            
                
           
                
            </div>
            
        </div><!— /span12 —>
        
    </div><!— /row —>    
    
</div><!— /container —>
    
    




</body>
</html>