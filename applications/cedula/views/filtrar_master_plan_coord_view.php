<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>MASTER PLAN FESTIVAL DE CALAVERAS XX EDICIÓN 2014</h3></div>            
            
            <?php include 'include/menu_filtros_master_plan.php';  ?>
            
            <hr>
            
            <div class="">                
                <table class="well table table-bordered">                    
                    <thead></thead>                
                    <tr>
                        <th colspan="4" style="text-align:center">QUÉ</th>
                        <th colspan="4" style="text-align:center">CÓMO y CUÁNTO</th>
                        <th colspan="1" style="text-align:center">DÓNDE</th>
                        <th colspan="5" style="text-align:center">QUIÉN</th>
                        <th colspan="13" style="text-align:center">CUÁNDO (<small>Fechas, Horas</small>)</th>
                    </tr>
                    <tr>
                        <th>Coordinación</th>
                        <th>Categoría</th>                        
                        <th>Actividad, Descripción</th>
                        <th>Actividad, Observaciones</th>
                        <th colspan="" style="text-align:center">DESGLOSE DE NECESIDADES</th>
                        <th>COSTO DE ACTIVIDAD <small>(CON IVA)</small></th>
                        <th>TECHO PRESUPUESTAL</th>
                        <th>PARTIDA PRESUPUESTAL</th>
                        <th>Ubicación</th>
                        <th>Encargado de Actividad</th>
                        <th>Cédula entregada</th>
                        <th>Personal Secture de Apoyo</th>
                        <th>Dependencia de Apoyo</th>
                        <th>#SS</th>                        
                        <th>24 OCT</th>
                        <th>25 OCT</th>
                        <th>26 OCT</th>
                        <th>27 OCT</th>
                        <th>28 OCT</th>
                        <th>29 OCT</th>
                        <th>30 OCT</th>
                        <th>31 OCT</th>
                        <th>1 NOV</th>
                        <th>2 NOV</th>
                        <th>HORA INICIO</th>
                        <th>HORA FIN</th>
                    </tr>
                    <?php foreach ($get_all_coords as $coord ) : ?>
                                                    
                    <?php foreach ($get_all_cats as $cats ) : ?>
                                            
                        <?php if ($coord->id_coord == $cats->id_coord){ ?>
                                                                                
                                <?php foreach ($get_master_plan_coord as $act ) : ?>
                                <tr>                                                            
                                    <?php if($cats->id_categoria == $act->id_categoria AND $coord->id_coord == $act->id_coord){ ?>
                             
                                        <td><?php echo $coord->coordinacion;?></td>
                                        <td><?php echo $cats->categoria;?></td>
                                        <td><?php echo $act->actividad;?></td>
                                        <td><?php echo $act->descripcion;?></td>
                                        <td>
                                            <table>
                                                <tr>
                                                 <th><small>Descripción</small></th>
                                                 <th><small>Observaciones</small></th>
                                                 <th><small>Cantidad</small></th>
                                                 <th><small>Precio Unitario</small></th>
                                                 <th><small>Precio Total (CON IVA)</small></th>
                                               </tr>
                                        <?php foreach ($get_all as $necs ) : ?>                                                
                                            <?php if ($act->id_act == $necs->id_act){ ?>
                                                
                                                   <tr>
                                                     <td><small><?php echo $necs->descripcionec;?></small></td>
                                                       <td><small><?php echo $necs->observaciones;?></small></td>
                                                       <td><?php echo $necs->cantidad;?></td>
                                                       <td>$<?php echo number_format($necs->precio_unitario,2,".",","); ?></td>
                                                       <td>$<?php echo number_format($necs->precio_total*1.16,2,".",","); ?></td>
                                                   </tr>                                            
                                                
                                            <?php } ?>                                                    
                                        <?php endforeach; ?>
                                            </table>
                                        </td>
                                        <td>$<?php echo number_format($act->costo_secture*1.16,2,".",","); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $act->ubicacion;?></td>
                                        <td>(<?php echo $act->e_mail;?>)<br><?php echo $act->quienpropone;?></td>
                                        <td></td>
                                        <td></td>                                        
                                        <td></td>
                                        <td></td>
                                        <td><?php if ($act->d1 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d2 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>
                                        <td><?php if ($act->d3 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d4 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d5 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d6 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d7 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d8 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d9 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php if ($act->d10 != 0) { echo ('<i class="icon-ok"></i>');} ?></td>   
                                        <td><?php echo $act->hora_ini;?></td> 
                                        <td><?php echo $act->hora_fin;?></td> 
                                    
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
