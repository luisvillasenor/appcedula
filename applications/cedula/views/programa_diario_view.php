<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>PROGRAMA DIARIO FC EDICIÓN 201<?php echo $edicion;?></h3></div>
            <?php include 'include/menu_filtros_master_diario.php';  ?>
            <a href="<? echo base_url('merca/pdfdiario');?>/<?php echo $edicion;?>/<?php echo $fechaPrograma;?>/<?php echo $marca;?>" target="_blank">Descargar en PDF</a>
            <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Imprimir y PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Imprimir y PDF"/></a>
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
                                                    <h5><?php echo date("H:i",strtotime($concierto->hora_ini)); ?> hrs.</h5>
                                                </div>
                                                </div>
                                                <?php }
                                            }                                                
                                        ?>
                                        
                                        <?php 
                                        foreach ($get_all_cats as $catego) { 
                                        #Si la categoria es "Conciertos" No hacer nada.
                                        if ($catego->id_categoria != 14 
                                            AND $catego->id_categoria != 18
                                            AND $catego->id_categoria != 22
                                            AND $catego->id_categoria != 11
                                            AND $catego->id_categoria != 12
                                            AND $catego->id_categoria != 9
                                            AND $catego->id_categoria != 17
                                            AND $catego->id_categoria != 15
                                            AND $catego->id_categoria != 16
                                            AND $catego->id_categoria != 10

                                        ) { ?>
                                        
                                        
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
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))."</small></b>";?></span><br>

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
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d3 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d4 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d5 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d6 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d7 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d8 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d9 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d10 == $value)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

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
                            <div class=""><h1 class="alert-info"><?php echo date("d M",strtotime($fechaPrograma));?></h1></div>
                
                                    <div class="well">
                                        
                                        <?php
                                            foreach ($get_all_conciertos as $concierto) {                                            
                                                if ($fechaPrograma == $concierto->fecha_taller) {?>
                                                <div class="alert-danger">
                                                    <div class="well">
                                                    <h2><?php echo $concierto->subactividad; ?><small> [<?php echo $concierto->status_subact; ?>]</small></h2>
                                                    <h4><?php echo $concierto->sede; ?> (<?php echo $concierto->ubicacion; ?>)</h4>
                                                    <h5><?php echo date("H:i",strtotime($concierto->hora_ini)); ?> hrs.</h5>
                                                </div>
                                                </div>
                                                <?php }
                                                
                                            }                                                
                                        ?>
                                        
                                        <?php 
                                        foreach ($get_all_cats as $catego) { 
                                        #Si la categoria es "Conciertos" No hacer nada.
                                        if ($catego->id_categoria != 14
                                            AND $catego->id_categoria != 18
                                            AND $catego->id_categoria != 22
                                            AND $catego->id_categoria != 11
                                            AND $catego->id_categoria != 12
                                            AND $catego->id_categoria != 9
                                            AND $catego->id_categoria != 17
                                            AND $catego->id_categoria != 15
                                            AND $catego->id_categoria != 16
                                            AND $catego->id_categoria != 10

                                        ) { ?>                                        
                                            <div class="alert-success">
                                            <div class="well">
                                            <h4>
                                            <?php echo $catego->categoria; ?>
                                            </h4>
                                            <hr>
                                            <h5>
                                                <?php                                            
                                                foreach ($get_cal_act as $actividades) {

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d1 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d2 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d3 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d4 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d5 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d6 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d7 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d8 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d9 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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

                                                    if (($catego->id_categoria == $actividades->id_categoria) AND ($actividades->d10 == $fechaPrograma)) { ?>

                                                        <?php
                                                        if ( $fcTrabajo != $edicion ) { echo "ERROR , Revisar EDICION o AÑO DE TRABAJO"; ?>
                                                                
                                                        <?php  } else { ?>
                                                                    <span><?php echo "<b>".$actividades->actividad ."</b>"?></span><br>
                                                                    <span><?php echo "<b><small>".$actividades->sede."(".$actividades->ubicacion.")</small></b>";?></span><br>
                                                                    <span><?php echo "<b><small>".date("H:i",strtotime($actividades->hora_ini))." a ".date("H:i",strtotime($actividades->hora_fin))." hrs.</small></b>";?></span><br>

                                                                    <br>
                                                            <ul>
                                                                <?php foreach ($get_all_subactividades as $necs ) : 
                                                                    if ($actividades->id_act == $necs->id_act AND $fechaPrograma == $necs->fecha_taller){ ?>
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
                    } ?>
                          
                        
                    
                
                <hr>
            </div><!-- -->            
        </div><!-- /span12 -->        
    </div><!-- /wrapper -->    
</div><!-- /container -->