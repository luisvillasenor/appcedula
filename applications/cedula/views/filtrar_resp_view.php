<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>

        <div class="span10">
        <!--Body content-->
            
        <?php
            switch ($_SESSION['grupo']) {
                        case 'coordinador':
                          include 'include/menu_filtros_coord.php';  
                          break;
                        case 'gestor':
                          include 'include/menu_filtros_gestor.php';  
                          break;
                        case 'administrador':
                          include 'include/menu_filtros_coord.php'; 
                          break;
                        default:
                          echo '<div class="alert alert-block alert-error">';
                          echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                          echo '<h4 class="alert-heading">Ups ! Parece ser que Usted no es Miembo de este Sitio !</h4>';
                          echo '<p>';
                          echo 'Por favor solicite ayuda al administrador del sitio';
                          echo '</p>';
                          echo '<p>';
                          echo '<a class="btn btn-danger" href="'.base_url('/admin/logout').'">Cerrar</a>';
                          echo '</p>';
                          echo '</div>';
                          break;
                      } 
          ?> 
           
        
        <?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) { ?>
          <div id="subheader3"><h2><strong><?php printf($edicion); ?></strong></h2></div>
        <?php }else{ ?>
          <div id="subheader2"><h3><strong>EDICIÓN DE TRABAJO 201<?php echo $edicion; ?></strong></h3></div>

              <br><br>

          <div class="container">
                    
              <div class="span3 text-center">
                <div class="alert alert-info">
                  <h5>PRESUPUESTO AUTORIZADO</h5>
                  <h3>$<?php echo number_format($suma_pres_aut,2,".",","); ?></h3>
                  <small>Total autorizado</small>
                </div>
              </div>

              <div class="span3 text-center">
                <div class="alert alert-info">
                  <h5>PRESUPUESTO SOLICITADO</h5>
                  <h3>$<?php echo number_format($suma_costo_secture*1.16,2,".",","); ?></h3>
                  <small>Total costo neto de SECTURE</small>
                </div>
              </div>

              <?php if ($suma_pres_eje <= 0 ) { ?>

              <div class="span3 text-center">
                <div class="alert alert-danger">
                  <h5>RESULTADO</h5>
                  <h3>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h3>
                  <small>AUTORIZADO menos SOLICITADO</small>
                </div>
              </div>
                
              <?php }else{ ?>

              <div class="span3 text-center">
                <div class="alert alert-success">
                  <h5>RESULTADO</h5>
                  <h3>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h3>
                  <small>AUTORIZADO menos SOLICITADO</small>
                </div>
              </div>

              <?php } ?>

              <div class="span3 text-center">
                <div class="alert alert-default">
                  <h5>FUERA DE PRESUPUESTO</h5>
                  <h3>$<?php echo number_format($suma_fuera_pres*1.16,2,".",","); ?></h3>
                  <small>No es de SECTURE</small>
                </div>
              </div>            
            
            
          </div>
          
          <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
          </div>
          
        <?php } ?>
            
            <!-- Encabezados de la tabla de cédulas-->
            <?php include 'include/header_cedulas.php';  ?>
            
            
                <?php foreach ($get_filtro_por_resp as $actividades ) : ?>
                  <!-- Código dentro del FOREACH de todas las actividades -->
                  <tr>
                      <!-- MENU DE OPERACIONES PARA CAD REGISTRO-->                          
                          <?php
                              switch ($_SESSION['grupo']) {
                                          case 'coordinador':
                                            include 'include/nav_ops_regs.php';  
                                            break;
                                          case 'gestor':
                                            include 'include/nav_ops_regs.php';  
                                            break;
                                          case 'administrador':
                                            /*if($actividades->e_mail != $_SESSION['username']) {
                                                include 'include/nav_ops_regs_coords.php';  
                                                break;
                                            }*/
                                            include 'include/nav_ops_regs.php'; 
                                            break;
                                          default:
                                            echo '<div class="alert alert-block alert-error">';
                                            echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                                            echo '<h4 class="alert-heading">Ups ! Parece ser que Usted no es Miembo de este Sitio !</h4>';
                                            echo '<p>';
                                            echo 'Por favor solicite ayuda al administrador del sitio';
                                            echo '</p>';
                                            echo '<p>';
                                            echo '<a class="btn btn-danger" href="'.base_url('/admin/logout').'">Cerrar</a>';
                                            echo '</p>';
                                            echo '</div>';
                                            break;
                                        } 
                            ?>                          
                      
                      <td><?php echo $actividades->id_act;?></td>
                      <td><?php echo $actividades->actividad;?></td>
                      
                      <?php foreach ($get_categorias as $categos ) :
    
                        if($actividades->id_categoria == $categos->id_categoria) {?>
                      
                            <td><?php echo $categos->categoria;?></td>
                        
                        <?php }?>
                                          
                      <?php endforeach; ?>
                      
                      
                      <td><?php echo $actividades->quienpropone;?>(<?php echo $actividades->e_mail;?>)</td>   
                      <td>$<?php echo number_format($actividades->costo_secture*1.16,2,".",","); ?></td>                     
                      <?php include 'include/nav_status_act.php';  ?>                     
                  </tr>
                <?php endforeach; ?>
              </tbody>
              </table>
          
          
        </div><!— /span10 —>

        

    </div><!— /row —>

</div><!— /container —>
