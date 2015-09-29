<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
         
       <div class="span2 sidebar-nav">
        <div style="text-align:center; margin:0 auto;">
          
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/logofc.png" width="100%">
          
        </div>
        <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
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
        <?php //include 'include/menu_filtros_pres.php';?> 
         <br>
<script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
<br>
           
       
                    
            <table class="table table-bordered">
            <thead>
              <h2 class="text-center">DESGLOSE DEL GASTO POR TIPO DE DOCUMENTO</h2>

               <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
          </div>
          
                  <ul class="nav nav-tabs">
                    
                    <li class="active"><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Requisiciones</a></li>
                    <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/F/ ">Facturas</a></li>
                    <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/N/ ">Notas</a></li>
                    <li class="dropdown">
                      <a class="dropdown-toggle"
                         data-toggle="dropdown"
                         href="#">
                          Clasificacion
                          <b class="caret"></b>
                        </a>
                      <ul class="dropdown-menu">
                        <!-- links -->

                        <?php foreach ($get_groupby_clasificacion as $value) {
                          echo "<li>";
                          echo "<a href='".base_url('actividades/dashboard_consolidados').'/ /'.$value->clasificacion."'>$value->clasificacion</a>";
                          echo "</li>";
                        } ?>
                      </ul>
                    </li>
                    <li>
                      <a href="<?php echo base_url('actividades/dashboard_consolidados');?>">Todo</a>
                    </li>
                  </ul>
            </thead>   
              <tr>                
                <th></th>
                <th>Cedula</th>
                <th>Tipo</th>
                <th>Clasificacion</th>
                <th>Proveedor</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>Precio Total</th>
                <th>IVA</th>
                <th>Precio Total con IVA</th>
                
              </tr>
              <?php 
              $precio_total = 0; 
              $iva = 0;
              $gran_total = 0 ;
              foreach ($get_all_cons_act as $cons_item ) : ?>
                  <tr>                    
                      <td><a href="<?php echo base_url('actividades/vista_previa_presupuesto').'/'.$cons_item->id_act;?>" type="button" class="btn btn-success"><?php echo $cons_item->id_con;?></a></td>
                      <td><?php echo $cons_item->id_act;?></td>
                      <td>
                              <?php switch ($cons_item->tipo) {
                                case 'R':
                                  echo "Requisición";
                                  break;
                                case 'F':
                                  echo "Factura";
                                  break;
                              } ?>
                      </td>
                      <td><?php echo $cons_item->clasificacion;?></td>
                      <td><?php echo $cons_item->proveedor;?></td>
                      <td><?php echo $cons_item->concepto;?></td>
                      <td><?php echo $cons_item->cantidad;?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->precio_unitario,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format(($cons_item->precio_unitario*$cons_item->cantidad),2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format(($cons_item->precio_unitario*$cons_item->cantidad)*0.16,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format(($cons_item->precio_unitario*$cons_item->cantidad)*1.16,2,".",",");?></td>
                      
                  </tr>                    

                  <?php
                  $precio_total += $cons_item->precio_total;
                  $iva = $precio_total * 0.16;
                  $gran_total = $precio_total * 1.16;
                  ?>
                 
              <?php endforeach; ?>
              <tr><td colspan="11"></td></tr>
              <tr>
                <th colspan="8"></th>
                <th>SUBTOTAL</th>
                <th>IVA</th>
                <th>TOTAL</th>
              </tr>
              <tr>
                <td colspan="8"></td>
                <td id="pesos">
                     <?php echo "$".number_format($precio_total,2,".",","); ?>
                  </td>
                <td id="pesos">
                     <?php echo "$".number_format($iva,2,".",","); ?>
                  </td>  
                <td id="pesos">
                     <?php echo "$".number_format($gran_total,2,".",","); ?>
                  </td>   
              </tr>

              
            </table>
                
              
        </div><!— /span10 —>

        

    </div><!— /row —>

</div><!— /container —>
