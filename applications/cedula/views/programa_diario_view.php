<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>PROGRAMA DIARIO FC EDICIÓN 201<?php echo $edicion;?></h3></div>
            <?php include 'include/menu_filtros_master_diario.php';  ?>
            <hr>
            <div class="">                
                
                    
                    <?php 
                    if ($fechaPrograma == "todo") {
                        foreach ($fechas_oficiales as $value) { ?>
                            <div class=""><h1 class="alert-info"><?php echo date("d M",strtotime($value));?></h1></div>
                
                                    <div class="well">
                                        
                                        <?php
                                            foreach ($get_all_conciertos as $concierto) {                                            
                                                if ($value == $concierto->fecha_taller) {?>
                                                <div class="alert-danger">
                                                    <div class="well">
                                                    <h2><?php echo $concierto->subactividad; ?><small> [<?php echo $concierto->status_subact; ?>]</small></h2>
                                                    <h4><?php echo $concierto->sede; ?> (<?php echo $concierto->ubicacion; ?>)</h4>
                                                    <h5><?php echo $concierto->hora_ini; ?> </h5>
                                                </div>
                                                </div>
                                                <?php }
                                            }                                                
                                        ?>
                                        
                                        <?php 
                                        foreach ($get_all_cats as $catego) { 
                                        #Si la categoria es "Conciertos" No hacer nada.
                                        if ($catego->id_categoria != 14) { ?>
                                        
                                        
                                            <div class="alert-success">
                                            <div class="well">
                                            <h4>
                                            <?php echo $catego->categoria; ?>
                                            </h4>
                                            <hr>
                                            <h5>
                                                <?php                                            
                                                foreach ($get_cal_act as $actividades) {

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d1 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->hora_ini." a ".$actividades->hora_fin."</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $value == $necs->fecha_taller){ ?>
                                                                    <li>
                                                                        <?php include 'include/subactividad.php';  ?>
                                                                    </li>        
                                                                    <?php } ?>                                                    
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="text-left">
                                                                <img style="width:20%;height:3%;" class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
                                                            </div>

                                                        <?php  } ?>
                                                        
                                                    <?php }  

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d2 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->hora_ini." a ".$actividades->hora_fin."</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $value == $necs->fecha_taller){ ?>
                                                                    <li>
                                                                        <?php include 'include/subactividad.php';  ?>
                                                                    </li>        
                                                                    <?php } ?>                                                    
                                                                <?php endforeach; ?>
                                                            </ul>

                                                            <div class="text-left">
                                                                <img style="width:20%;height:3%;" class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
                                                            </div>
                                                        <?php  } ?>
                                                        
                                                    <?php } 

                                                } ?>
                                            </h5>
                                            </div>
                                            </div>
                                        <?php 
                                        }
                                        } ?>
                                        
                                    </div>                                                                    
                
                        <?php }

                    } else { 

                        if ( in_array($fechaPrograma, $fechas_oficiales) ) { ?>
                            <tr>
                                <td><h1><?php echo date("d M",strtotime($fechaPrograma));?></h1><br>
                                    <h2>
                                        Concierto: 
                                            <?php
                                                foreach ($get_all_conciertos as $concierto) {
                                            
                                                        if ($fechaPrograma == $concierto->fecha_taller) {
                                                            echo " ";
                                                            echo $concierto->subactividad;
                                                            echo " ";
                                                            echo $concierto->sede;
                                                            echo " ";
                                                            echo $concierto->ubicacion;
                                                            echo " ";
                                                            echo $concierto->status_subact;
                                                            echo " ";
                                                            echo $concierto->hora_ini;
                                                            echo "<br>";
                                                        }
                                                }
                                                
                                            ?>
                                    </h2><br>
                                        <h2>Categoría: </h2><br>
                                        <h2>Sede / Ubicación: </h2><br>
                                        <h3>
                                        <?php 
                                        foreach ($get_all_subactividades as $value2) {
                                            if ($fechaPrograma == $value2->fecha_taller) {
                                                echo $value2->hora_ini;
                                                echo " ";
                                                echo $value2->subactividad;
                                                echo " ";
                                                echo $value2->status_subact;
                                                echo "<br>";
                                            } 
                                        } ?>
                                        </h3>
                                </td>                                
                            </tr>
                        <?php }
                    } ?>
                          
                        
                    
                
                <hr>
            </div><!-- -->            
        </div><!-- /span12 -->        
    </div><!-- /wrapper -->    
</div><!-- /container -->