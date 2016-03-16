<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>MASTER CONTENIDOS FC EDICIÓN 201<?php echo $edicion;?></h3></div>            
            
            <?php include 'include/menu_filtros_master_contenidos.php';  ?>

            
            <hr>
            
            <div class="">                
                <table class="well table table-bordered">                    
                    <thead></thead>                
                    <tr>
                        <th colspan="2" style="text-align:center"></th>
                        <th colspan="" style="text-align:center"></th>
                        <th colspan="1" style="text-align:center"></th>
                        <th colspan="" style="text-align:center"></th>
                        <th colspan="10" style="text-align:center"></th>
                    </tr>
                    <tr>
                        
                        <th>Categoría</th>                        
                        <th>Actividad, Descripción</th>                        
                        <th colspan="" style="text-align:center">PROGRAMA DETALLADO</th>                        
                        
                        
                        <?php
                          $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                          foreach ($fechas as $value) {?>
                            <th><?php echo date("d M",strtotime($value));?></th>
                        <?php }?>
                        
                    </tr>
                    <?php foreach ($get_all_coords as $coord ) : ?>
                                                    
                    <?php foreach ($get_all_cats as $cats ) : ?>
                                            
                        <?php if ($coord->id_coord == $cats->id_coord){ ?>
                                                                                
                                <?php foreach ($get_master_plan as $act ) : ?>
                                <tr>                                                            
                                    <?php if($cats->id_categoria == $act->id_categoria AND $coord->id_coord == $act->id_coord){ ?>
                             
                                        
                                        <td><?php echo $cats->categoria;?></td>
                                        <td>
                                            <?php echo $act->actividad;?><br>
                                            <?php switch ($act->status_act) {
      case '1':?>
        <span name="flag" id="flag" class="label label-important"><small>No Aprobado</small></span>
<?php break;
      case '2':?>
        <span name="flag" id="flag" class="label label-success"><small>Aprobado Conceptual</small></span>
<?php break;
    case '3':?>
        <span name="flag" id="flag" class="label label-info"><small>Integrado al Programa General</small></span>
<?php break;
    case '4':?>
        
          <?php if ( $act->pres_eje < 0 ) { ?>
          <span name="flag" id="flag" class="label label-inverse"><small>Presupuesto AUTORIZADO</small><br>
            <?php if ($act->pres_aut == 0) { ?>
              <span class="label label-warning">$ <?php echo number_format($act->pres_aut,2,".",",");?></span>
            <?php } else {?>
              <span>$ <?php echo number_format($act->pres_aut,2,".",",");?></span>
            <?php } ?>            
          </span><br>
          <span id="flag" class="label label-important"><small>[AUTORIZADO vs PLANEADO]</small><br>$ <?php echo number_format($act->pres_eje,2,".",",");?></span>
          <span id="flag" class="label label-inverse"><small>Presupuesto EJERCIDO</small><br>$ <?php echo number_format($act->pres_gas,2,".",",");?></span>
          
              <?php
                if ( $act->pres_aut-$act->pres_gas < 0 ) { ?>
                  <span id="flag" class="label label-important">SALDO: $ <?php echo number_format($act->pres_aut-$act->pres_gas,2,".",",");?></span>
              <?php } else { ?>
                  <span id="flag" class="label label-success">SALDO: $ <?php echo number_format($act->pres_aut-$act->pres_gas,2,".",",");?></span>
              <?php } ?>

          
          <?php }else{ ?>
          <span name="flag" id="flag" class="label label-inverse"><small>Presupuesto AUTORIZADO</small><br>
            <?php if ($act->pres_aut == 0) { ?>
              <span class="label label-warning">$ <?php echo number_format($act->pres_aut,2,".",",");?></span>
            <?php } else {?>
              <span>$ <?php echo number_format($act->pres_aut,2,".",",");?></span>
            <?php } ?>            
          </span><br>
          <span id="flag" class="label label-inverse"><small>Presupuesto EJERCIDO</small><br>$ <?php echo number_format($act->pres_gas,2,".",",");?></span>

          
              <?php
                if ( $act->pres_aut-$act->pres_gas < 0 ) { ?>
                  <span id="flag" class="label label-important">SALDO: $ <?php echo number_format($act->pres_aut-$act->pres_gas,2,".",",");?></span>
              <?php } else { ?>
                  <span id="flag" class="label label-success">SALDO: $ <?php echo number_format($act->pres_aut-$act->pres_gas,2,".",",");?></span>
              <?php } ?>

          
          
          <?php } ?>
        
<?php break;
    case '5':?>
        <span name="flag" id="flag" class="label"><i class="icon-lock"></i><small> Bloqueada</small></span>
<?php break;
      default: ?>
        <span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span>
<?php break;
      } ?>


                                        </td>
                                        
                                        <td>
                                            <table>
                                                <tr>
                                                 <th><small>Actividad/Taller</small></th>
                                                 <th><small>Fecha</small></th>
                                                 <th><small>Ubicacion</small></th>
                                                 <th><small>Inicia</small></th>
                                                 <th><small>Termina</small></th>
                                               </tr>
                                        <?php foreach ($get_all as $necs ) : ?>                                                
                                            <?php if ($act->id_act == $necs->id_act){ ?>
                                                
                                                   <tr>
                                                     <td><small><?php echo $necs->subactividad;?></small><br>
                                                        <small><?php echo $necs->status_subact;?></small></td>
                                                       <td><small><?php echo $necs->fecha_taller;?></small></td>
                                                       <td><?php echo $necs->ubicacion;?></td>
                                                       <td><?php echo date("H:s",strtotime($necs->hora_ini));?></td>
                                                       <td><?php echo $necs->hora_fin;?></td>
                                                   </tr>                                            
                                                
                                            <?php } ?>                                                    
                                        <?php endforeach; ?>
                                            </table>
                                        </td>
                        
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d1 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                    
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>   
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d2 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d3 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d4 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d5 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d6 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d7 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d8 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d9 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d10 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        
                                    
                                    <?php } ?>
                                </tr>                        
                                <?php endforeach; ?>
                        
                        <?php } ?>
                    
                    <?php endforeach; ?>                        
                                                
                <?php endforeach; ?>
                    
                </table>
                <hr>

                
                    
                
                
                
                
            </div><!-- -->            
        </div><!-- /span12 -->        
    </div><!-- /wrapper -->    
</div><!-- /container -->