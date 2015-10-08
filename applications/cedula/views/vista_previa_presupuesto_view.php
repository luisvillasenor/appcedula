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
    th{
    background-color:#000;
    color:white;
    }
    #pesos{text-align: right}
    #cantidad{text-align: center}
    #pesos_total{text-align: right; background-color: black; color: white; font-size: 16px;}

    h3{text-align:center;}

  </style>

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha_doc" ).datepicker({ 
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
<?php include 'include/nav_perfil.php';?>

<div class="container-fluid">
    <div id="wrapper" class="row-fluid">        

        <div class="span12">
        <!--Body content-->
            <div class="text-center"><h2>PLANEADO vs EJECUTADO <br><small>CÉDULA [ <?php echo $id_act;?> ]</small></h2></div>
            <br>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
<br>
            


<?php /* APROBACION CONCEPTUAL.- VISTA SOLO PARA LOS ADMINISTRADORES */
$app = $_SESSION['username']; /** Cacho la sesion del usaurio **/
  switch ($app) {
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
            <thead><h2><small>DESGLOSE</small> PLANEADO <small>CÉDULA [ <?php echo $actividades->id_act;?> ]</small></h2></thead>
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
                        <?php if ($necesidades->status_necs == 0) { ?>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal_<?php echo $necesidades->id_nec;?>">Clasificar</button>
                            <!-- Modal -->
                            <div id="myModal_<?php echo $necesidades->id_nec;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                                        <?php 
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                          echo form_open('actividades/consolidar',$attributes);?>
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Clasificación de Necesidades</h3>
                              <small>Cédula ID: <?php echo $necesidades->id_act; ?></small>
                            </div>
                            <div class="modal-body">
                                <input name="id_act" id="id_act" type="hidden" value="<?php echo $necesidades->id_act; ?>">
                                <input name="id_nec" id="id_nec" type="hidden" value="<?php echo $necesidades->id_nec; ?>">
                                <div class="control-group">
                                  <div class="controls">
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="F" checked> Factura
                                    </label>
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="R"> Requisición
                                    </label>
                                  </div>
                                </div>                                
                                <div class="control-group">
                                  <label class="control-label" for="clasificacion">Clasificacion del Gasto</label>
                                  <div class="controls">
                                    <input type="text" name="clasificacion" id="clasificacion" value="">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="proveedor">Proveedor</label>
                                  <div class="controls">
                                    <input type="text" name="proveedor" id="proveedor" value="">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="concepto">Descripcion / Observaciones</label>
                                  <div class="controls">
                                    <textarea cols="5" name="concepto" id="concepto">
                                      <?php echo $necesidades->descripcionec;?>
                                      <?php echo $necesidades->observaciones;?>
                                    </textarea>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="cantidad">Cantidad <small>Numero entero</small></label>
                                  <div class="controls">
                                    <input type="text" name="cantidad" id="cantidad" value="<?php echo $necesidades->cantidad;?>" readonly>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="preciounitario">Precio Unitario:</label>
                                  <div class="controls">
                                    <input type="text" name="precio_unitario" id="precio_unitario" value="<?php echo $necesidades->precio_unitario;?>" readonly>
                                  </div>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success btn-block">ENVIAR A CLASIFICADOS</button>                              
                            </div>
                          </form>  

                          </div>
                          <!-- End Modal --> 
                        <?php } else { ?>
                        <?php echo "<i class='icon-ok'></i> Clasificado";} ?>                          
                        

                      </td>
                      <td><?php echo $necesidades->descripcionec;?></td>
                      <td><?php echo $necesidades->observaciones;?></td>
                      <td><?php echo $necesidades->encargado;?></td>
                      <td id="cantidad"><?php echo $necesidades->cantidad;?></td>
                      <td id="pesos">$<?php echo number_format($necesidades->precio_unitario,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format($necesidades->precio_total,2,".",",");?></td>
                      
                  </tr>                    
              <?php $tot += $necesidades->precio_total;?>              
              <?php endforeach; ?>
                <tr>
                
                  <td colspan="5"></td>
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
                
                  <td colspan="5"></td>
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

                  <td colspan="5"></td>
                  <td id="pesos" colspan="1">GRAN TOTAL:</td>
                  <td id="pesos_total">$
                     <?php 
                        $gran_total_planeado = '';
                        foreach ($get_total_act as $tot ) : 
                            echo number_format($tot->tot_tot,2,".",",");
                            $gran_total_planeado = $tot->tot_tot;
                        endforeach;
                      ?>
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
            <thead><h2><small>DESGLOSE</small> EJECUTADO <small>CÉDULA [ <?php echo $actividades->id_act;?> ]</small></h2></thead>
            <div>
              <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModalGastoEjecutado">Nuevo Gasto Ejecutado</button>
                            <!-- Modal -->
                            <div id="myModalGastoEjecutado" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                          <?php 
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                          echo form_open('actividades/agregar_con',$attributes);?>
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Nuevo Gasto Ejecutado</h3>
                              <small>Cédula ID: <?php echo $necesidades->id_act; ?></small>
                            </div>
                            <div class="modal-body">
                                <input name="id_act" id="id_act" type="hidden" value="<?php echo $necesidades->id_act; ?>">
                                <div class="control-group">
                                  <div class="controls">
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="F" checked> Factura
                                    </label>
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="N"> Nota
                                    </label>
                                    <label class="radio">
                                      <input name="tipo" id="tipo" type="radio" value="R"> Requisición
                                    </label>
                                  </div>
                                </div>                                
                                <div class="control-group">
                                  <label class="control-label" for="clasificacion">Clasificacion del Documento</label>
                                  <div class="controls">
                                    <input type="text" name="clasificacion" id="clasificacion" value="">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="proveedor">Proveedor</label>
                                  <div class="controls">
                                    <input type="text" name="proveedor" id="proveedor" value="" size="100px">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="concepto">Concepto [Breve Descripcion]</label>
                                    <textarea class="form-control" rows="3" name="concepto" id="concepto"></textarea>                                  
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="cantidad">Cantidad <small>Numero entero</small></label>
                                  <div class="controls">
                                    <input type="text" name="cantidad" id="cantidad" value="">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="preciounitario">Precio Unitario:</label>
                                  <div class="controls">
                                    <input type="text" name="precio_unitario" id="precio_unitario" value="">
                                  </div>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success btn-block">AGREGAR</button>                              
                            </div>
                          </form>  

                          </div>
                          <!-- End Modal -->
            </div>
              <tr>
                <th>No. [Interno]</th>
                <th>Tipo</th>
                <th>Documento</th>
                <th>Proveedor</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>Precio Total</th>                               
              </tr>
              <?php $tot = 0; foreach ($get_all_cons_act as $cons_item ) : ?>
                  <tr>
                    <td>
                      <!-- Button to trigger modal -->
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal_cons_<?php echo $cons_item->id_con;?>">Editar[<small><?php echo $cons_item->id_con;?></small>]</button>
                      <!-- Modal -->
                          <div id="myModal_cons_<?php echo $cons_item->id_con;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <?php 
                          $attributes = array('class' => 'form-horizontal', 'role' => 'form');
                          echo form_open('actividades/actualizar_cons',$attributes);?>
                          <input type="hidden" name="id_con" id="id_con" value="<?php echo $cons_item->id_con;?>">
                          <input type="hidden" name="id_nec" id="id_nec" value="<?php echo $cons_item->id_nec;?>">
                          <input type="hidden" name="id_act" id="id_act" value="<?php echo $cons_item->id_act;?>">
                          <input type="hidden" name="fecha" id="fecha" value="<?php echo $cons_item->fecha;?>">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3 id="myModalLabel">Clasificación del Gasto</h3>
                            </div>
                            <div class="modal-body">                             
                                <div class="control-group">
                                  <div class="controls">
                                    <?php if ($cons_item->tipo == 'F') { ?>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="F" checked> Factura
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="N"> Nota
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="R"> Requisición
                                      </label>                                      
                                    <?php } ?>
                                    <?php if ($cons_item->tipo == 'N') { ?>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="F"> Factura
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="N" checked> Nota
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="R"> Requisición
                                      </label>                                      
                                    <?php } ?>
                                    <?php if ($cons_item->tipo == 'R') { ?>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="F"> Factura
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="N"> Nota
                                      </label>
                                      <label class="radio">
                                        <input name="tipo" id="tipo" type="radio" value="R" checked> Requisición
                                      </label>                                      
                                    <?php } ?>                                    
                                  </div>
                                </div>                                 
                                <div class="control-group">
                                  <label class="control-label" for="clasificacion">Clasificacion del Documento</label>
                                  <div class="controls">
                                    <input type="text" name="clasificacion" id="clasificacion" value="<?php echo $cons_item->clasificacion;?>">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="proveedor">Proveedor</label>
                                  <div class="controls">
                                    <input type="text" name="proveedor" id="proveedor" value="<?php echo $cons_item->proveedor;?>">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="concepto">Concepto</label>
                                  <div class="controls">
                                    <input type="text" name="concepto" id="concepto" value="<?php echo $cons_item->concepto;?>">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="cantidad">Cantidad</label>
                                  <div class="controls">
                                    <input type="text" name="cantidad" id="cantidad" value="<?php echo $cons_item->cantidad;?>">
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label" for="precio_unitario">Precio Unitario</label>
                                  <div class="controls">
                                    <input type="text" name="precio_unitario" id="precio_unitario" value="<?php echo $cons_item->precio_unitario;?>">
                                  </div>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success btn-block">ACTUALIZAR</button>
                              <a href="<?php echo base_url();?>actividades/eliminar_cons/<?php echo $cons_item->id_con;?>/<?php echo $cons_item->id_act;?>" class="btn btn-danger btn-block">ELIMINAR</a>
                            </div>
                          </form>  

                          </div>
                          <!-- End Modal --> 
                    </td>
                      <td>
                        <?php switch ($cons_item->tipo) {
                                case 'R':
                                  echo "Requisición";
                                  break;
                                case 'N':
                                  echo "Nota";
                                  break;
                                case 'F':
                                  echo "Factura";
                                  break;
                              } ?>
                      </td>
                      <td><?php echo $cons_item->clasificacion;?></td>
                      <td><?php echo $cons_item->proveedor;?></td>
                      <td><?php echo $cons_item->concepto;?></td>
                      <td id="cantidad"><?php echo $cons_item->cantidad;?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->precio_unitario,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->precio_total,2,".",",");?></td>
                  </tr>                    
              <?php $tot += $cons_item->precio_total;?>              
              <?php endforeach; ?>
                <tr>
                  <td colspan="6"></td>
                  <td id="pesos" colspan="1">SUBTOTAL:</td>
                  <td id="pesos" valign="middle">$
                     <?php 
                        foreach ($get_total_act_cons as $tot2 ) : 
                            echo number_format($tot2->total_act,2,".",",");
                        endforeach;
                      ?>
                  </td>            
              </tr>
                <tr>
                  <td colspan="6"></td>
                  <td id="pesos" colspan="1">IVA:</td>
                  <td id="pesos" valign="middle">$
                    <?php
                        foreach ($get_total_act_cons as $tot2 ) : 
                            echo number_format($tot2->tot_iva,2,".",",");
                        endforeach;
                      ?>
                  </td>            
              </tr>
              <tr>
                  <td colspan="6"></td>
                  <td id="pesos" colspan="1">GRAN TOTAL:</td>
                  <td id="pesos_total" valign="middle">$
                    <?php 
                        $gran_total_ejecutado = '';
                        foreach ($get_total_act_cons as $tot ) : 
                            echo number_format($tot->tot_tot,2,".",",");
                            $gran_total_ejecutado = $tot->tot_tot;
                        endforeach;
                      ?>
                  </td>            
              </tr>
            </table>
            <hr>



            <table id="tabla_presupuesto" class="table table-bordered">
            <thead><h2><small>COMPARATIVO</small> PLANEADO <small>VS</small> EJECUTADO <small>CÉDULA [ <?php echo $actividades->id_act;?> ]</small></h2></thead>
              <tr>
                <th>PLANEADO</th>
                <th>EJECUTADO</th>
                <th>RESULTADO</th>
                <th>FORMULA</th>
                
              </tr>              
              <tr>                    
                  <td>
                    <span class="label label-default">
                        <h3>
                          <?php echo "$" . number_format($gran_total_planeado,2,".",","); ?>
                        </h3>
                    </span>                    
                  </td>
                      <td>
                        <?php
                                if ( ( $gran_total_planeado < $gran_total_ejecutado ) ) { ?>
                        
                                  <span class="label label-important">
                                    <h3>
                                      <?php echo "$" . number_format($gran_total_ejecutado,2,".",","); ?>
                                    </h3>
                                  </span>
                        
                          <?php } else { ?>
                          
                        
                                  <span class="label label-default">
                                    <h3>
                                      <?php echo "$" . number_format($gran_total_ejecutado,2,".",","); ?>
                                    </h3>
                                  </span>
                        
                          <?php } ?>               
                        </td>
                      <td>
                        <?php
                                if ( ( $gran_total_planeado - $gran_total_ejecutado ) >= 0 ) { ?>
                      
                                  <span class="label label-success">
                                    <h3>
                                      <?php echo "$" . number_format( ( $gran_total_planeado - $gran_total_ejecutado ) ,2,".",","); ?>
                                    </h3>
                                  </span>
                      
                          <?php } else { ?>
                          
                      
                                  <span class="label label-important">
                                    <h3>
                                      <?php echo "$" . number_format( ( $gran_total_planeado - $gran_total_ejecutado ) ,2,".",","); ?>
                                    </h3>
                                  </span>
                      
                          <?php } ?>
                        </td>
                      <td><code>[ Resultado = Planeado - Ejecutado ]</code></td>
                
              </tr>              
            </table>

         
            
                
           
                
            </div>
            
        </div><!— /span12 —>
        
    </div><!— /row —>    
    
</div><!— /container —>
    
    




</body>
</html>