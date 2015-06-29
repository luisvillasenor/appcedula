<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>

        <div class="span8">
        <!--Body content-->
        
        <!-- Menu tipo Combo Box para seleccionar una Cédula y ver el registro correspondiente -->
        <?php include 'include/menu_filtros_resumen.php';  ?>
            
            <!-- Encabezados de la tabla de cédulas-->
            <?php include 'include/header_resumen.php';  ?>        
              
                <?php foreach ($get_all_actividades as $actividades ) : ?>
                  <!-- Código dentro del FOREACH de todas las actividades -->
                  <tr>
                      <!-- MENU DE APROBACION PARA CADA REGISTRO-->
                          <?php include 'include/nav_ops_aut.php';  ?>
                      
                      <td><a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a></td>
                      <td><?php echo $actividades->actividad;?></td>
                      
                      <?php foreach ($get_categorias as $categos ) :
    
                        if($actividades->id_categoria == $categos->id_categoria) {?>
                      
                            <!--<td><?php //echo $categos->categoria;?></td>-->
                        
                        <?php }?>
                                          
                      <?php endforeach; ?>
                      
                      <!--<td><?php echo substr($actividades->descripcion,0,30);?><strong> ...</strong></td>  -->
                      
                      <!--<td><?php echo $actividades->quienpropone;?>(<?php echo $actividades->e_mail;?>)</td>   -->
                      <td>$<?php echo number_format($actividades->costo_secture*1.16,2,".",","); ?></td>
                      
                <?php include 'include/nav_status_act.php';  ?>
                                            
                  </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
          
          
        </div><!— /span8 —>

        <div class="well sidebar-nav span2"> 
        
            <div>          
              <span class="label label-inverse">
                  <h1><?php echo $num_regs; ?></h1><br>Total de Cédulas</span>
            </div><br>
            <div>
              <span class="label label-success">
                  <h2><?php echo number_format((($num_regs_a / $num_regs)*100),2,".",",");?></h2><br>(%)Aprobados</span>
            </div><br>        
            <div >       
              <span class="label label-warning">
                  <h2><?php echo number_format((($num_regs_p / $num_regs)*100),2,".",",");?></h2>(%)Pendientes<br></span>
            </div><br>
            <div >          
              <span class="label label-important">
                  <h2><?php echo number_format((($num_regs_Noa / $num_regs)*100),2,".",",");?></h2><br>(%)No Aprobado</span>
            </div>
                        
        </div>

        

    </div><!— /row —>

</div><!— /container —>
