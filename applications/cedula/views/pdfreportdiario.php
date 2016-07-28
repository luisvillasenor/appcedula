<?php
#View: application/views/pdfreport.php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = $titles;
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$obj_pdf->AddFont('Times','','/home/luisvillasenor/TTF/Lato-Lig.z');
$obj_pdf->AddPage(	);

// set default font subsetting mode
#$obj_pdf->setFontSubsetting(false);

$obj_pdf->SetFont('Times','', 14,'lato-lig');
#$obj_pdf->SetFont('helvetica', 'BI', 14);

ob_start();
    // we can have any view part here like HTML, PHP etc
?>
	
        <!--Body content-->
            <div class=""></div>
            <div class="">                
                
                    
                    <?php 
                    if ($fechaPrograma == "todo") {
                        foreach ($fechas_oficiales as $value) { ?>
                            <h1><?php echo date("d M",strtotime($value));?></h1>
                                    <div class="">
                                        <?php
                                            foreach ($get_all_conciertos as $concierto) {                                            
                                                if ($value == $concierto->fecha_taller) {?>                                                
                                                    <h2><?php echo $concierto->subactividad; ?><small> [<?php echo $concierto->status_subact; ?>]</small></h2>
                                                    <h4><?php echo $concierto->sede; ?> (<?php echo $concierto->ubicacion; ?>)</h4>
                                                    <h5><?php echo date("H:i",strtotime($concierto->hora_ini)); ?> hrs.</h5>                                                
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
        
    
    
<?php

$content = ob_get_contents();
ob_end_clean();
date_default_timezone_set("America/Mexico_City");
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('programa_diario_'.date("Ymdhis",now()).'.pdf', 'I');
?>