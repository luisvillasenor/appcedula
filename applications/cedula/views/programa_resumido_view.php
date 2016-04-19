<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>PROGRAMA RESUMIDO FC EDICIÓN 201<?php echo $edicion;?></h3></div>            
            
            <?php include 'include/menu_filtros_master_contenidos.php';  ?>
            <a href="<? echo base_url('merca/pdf');?>/<?php echo $edicion;?>/<?php echo $id_categoria;?>/<?php echo $marca;?>" target="_blank">Descargar en PDF</a>

            
            <hr>
            
            <div class="">                
                <table class="well table table-bordered">                    
                    <tr>
                        <th>CATEGORÍA</th>                        
                        <th>PROGRAMA RESUMIDO</th>                        
                        
                        
                        <?php /*
                          $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                          foreach ($fechas as $value) {?>
                            <th><?php echo date("d M",strtotime($value));?></th>
                        <?php }*/?>
                        
                    </tr>
                    <?php foreach ($get_all_coords as $coord ) : ?>
                                                    
                    <?php foreach ($get_all_cats as $cats ) : ?>
                                            
                        <?php if ($coord->id_coord == $cats->id_coord){ ?>
                                                                                
                                <?php foreach ($get_master_plan as $act ) : ?>
                                <tr>                                                            
                                    <?php if($cats->id_categoria == $act->id_categoria AND $coord->id_coord == $act->id_coord){ ?>
                             
                                        
                                        <td><small><?php echo $cats->categoria;?></small></td>
                                        <td>
                                            <table>
                                              <b><?php echo $act->actividad;?></b><br>
                                              <i><?php echo strtoupper($act->ubicacion) ;?> / <?php echo strtoupper($act->sede) ;?></i><br>
                                                
                                        <?php foreach ($get_all as $necs ) : ?>
                                            <?php if ($act->id_act == $necs->id_act){ ?>

                                              <ul>
                                                <li>
                                                <?php echo $necs->subactividad;?> [<small><?php echo strtolower($necs->status_subact); ?></small>]<br>
                                                <small><?php echo $necs->ubicacion;?></small> / <small><?php echo $necs->sede;?></small><br>
                                                <small><?php echo $necs->fecha_taller;?></small>, 
                                                <small>De <?php echo date("H:s",strtotime($necs->hora_ini));?> a <?php echo date("H:s",strtotime($necs->hora_fin));?></small><br>
                                                </li>
                                                <small><?php # $mifecha = date_parse($necs->fecha_taller) ; print_r($mifecha['day']); ?></small>
                                              </ul>

                                            <?php } ?>                                                    
                                        <?php endforeach; ?>
                                            </table>
                                            <hr>
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