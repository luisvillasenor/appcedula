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
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage(	);
ob_start();
    // we can have any view part here like HTML, PHP etc
?>
	
        <!--Body content-->
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
                    <br>
                    
                                                    
                    
                                            
                        
                                                                                
                                <?php foreach ($get_master_plan as $act ) : ?>
                                <tr>                                                            
                                    
                             
                                        <hr>
                                        <td><small>
                                            <?php foreach ($get_all_cats as $cats ) : ?>
                                                <?php if($cats->id_categoria == $act->id_categoria){ ?>
                                                    <?php echo $cats->categoria;?>
                                                <?php } ?>
                                            <?php endforeach; ?>  
                                        </small></td>
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
                                        </td>
                                    	
                                    
                                </tr>                        
                                <?php endforeach; ?>
                        
                        
                    
                                          
                                                
                
                    
                </table>
                
            </div><!-- -->            
        
    
    
<?php

    $content = ob_get_contents();
ob_end_clean();
date_default_timezone_set("America/Mexico_City");
$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('programa_'.date("Ymdhis",now()).'.pdf', 'I');
?>