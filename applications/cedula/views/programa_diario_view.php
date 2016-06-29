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
                                        foreach ($get_all_cats as $catego) { ?>
                                            <div class="alert-success">
                                            <div class="well">
                                                <h4>
                                                <?php echo $catego->categoria; ?>
                                                </h4>
                                                <hr>
                                                <h5>
                                            <?php
                                            foreach ($activities as $act) {
                                                foreach ($get_all_subactividades as $subact) {

                                                    if ($act == $subact->id_act && $subact->fecha_taller == $value && $catego->id_categoria == $subact->id_categoria) {
                                                        
                                                        echo "<br>";
                                                        echo $subact->actividad;
                                                        echo "<br>";
                                                        echo $subact->hora_ini . " a " . $subact->hora_fin;
                                                        echo "<br>";
                                                        
                                                            foreach ($get_all_subactividades as $subact) {

                                                                if ($act == $subact->id_act && $subact->fecha_taller == $value && $catego->id_categoria == $subact->id_categoria) {
                                                                    
                                                                    echo "<ul>";
                                                                    echo "<li>";
                                                                    echo $subact->subactividad;
                                                                    echo "</li>";
                                                                    echo "</ul>";
                                                                } 
                                                            }
                                                        echo "<br>";
                                                        
                                                    
                                                    } 
                                                }
                                                
                                            } ?>

                                            

                                                </h5>
                                            </div>
                                            </div>
                                        <?php } ?>
                                        
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