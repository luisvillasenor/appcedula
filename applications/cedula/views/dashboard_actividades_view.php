<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
         
       <div class="span2 sidebar-nav">
        <div style="text-align:center; margin:0 auto;">
          
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/logofc.png" width="100%">
          
        </div>
        <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
          </div>
        <!--Body content-->
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                
                <li class="active"><a><i class="icon-home"></i> CONTROL DEL PRESUPUESTO Y GASTO</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas con Presupuesto Autorizado</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Desglose del Gasto por Tipo de Documento</a></li>
                
              </ul>
            </div>
      </div><!--Sidebar content-->

        <div class="span10">
        <!--Body content-->
        <?php include 'include/menu_filtros_pres.php';?> 
          
        
        <?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) { ?>
          <div id="subheader3"><h2><strong><?php printf($edicion); ?></strong></h2></div>
        <?php }else{ ?>


                    
              <div class="span4">
                <div class="alert alert-info">
                  <h4>PRESUPUESTO AUTORIZADO</h4>
                  <h1>$<?php echo number_format($suma_pres_aut,2,".",","); ?></h1>
                  Sumatoria del presupuesto neto autorizado de cada cédula
                </div>
              </div>

              <div class="span4">
                <div class="alert alert-info">
                  <h4>PRESUPUESTO SOLICITADO</h4>
                  <h1>$<?php echo number_format($suma_costo_secture*1.16,2,".",","); ?></h1>
                  Sumatoria del COSTO NETO SECTURE de cada cédula
                </div>
              </div>

              <?php if ($suma_pres_eje <= 0 ) { ?>

              <div class="span3">
                <div class="alert alert-danger">
                  <h4>RESULTADO</h4>
                  <h1>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h1>
                  Diferencia entre lo <small>AUTORIZADO</small> y los <small>SOLICITADO</small>
                </div>
              </div>
                
              <?php }else{ ?>

              <div class="span3">
                <div class="alert alert-success">
                  <h4>RESULTADO</h4>
                  <h1>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h1>
                  Diferencia entre lo <small>AUTORIZADO</small> y lo <small>SOLICITADO</small>
                </div>
              </div>

              <?php } ?>

          
         <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
          </div>
  
          
        <?php } ?>

                    
            <!-- Encabezados de la tabla de cédulas-->
            <?php include 'include/header_cedulas_presupuesto.php';  ?>        
             <br>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
<br>
                <?php foreach ($get_all_actividades as $actividades ) : ?>
                  <!-- Código dentro del FOREACH de todas las actividades -->
                  <tr>                      
                      <td><!-- MENU DE OPERACIONES PARA CAD REGISTRO-->                          
                          <?php include 'include/nav_ops_pres.php';?>                          
                      </td>
                      <td><?php echo $actividades->id_act;?></td>
                      <td><?php echo $actividades->actividad;?></td>
                      
                      <?php foreach ($get_categorias as $categos ) :
    
                        if($actividades->id_categoria == $categos->id_categoria) {?>
                      
                            <td><?php echo $categos->categoria;?></td>
                        
                        <?php } ?>
                                          
                      <?php endforeach; ?>
                      
                      
                      <td><?php echo $actividades->quienpropone;?>(<?php echo $actividades->e_mail;?>)</td>   
                      <td id="pesos">$<?php echo number_format($actividades->costo_secture*1.16,2,".",","); ?></td>
                                            
                      <?php include 'include/nav_status_act.php';  ?>                                            
                  </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
          
          
        </div><!— /span10 —>

        

    </div><!— /row —>

</div><!— /container —>
