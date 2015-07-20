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
          <div id="subheader2"><h2><strong>EDICIÓN DE TRABAJO 201<?php echo $edicion; ?></strong></h2></div>
        <?php } ?>
            
            <!-- Encabezados de la tabla de cédulas-->
            <?php include 'include/header_cedulas.php';  ?>
            
                <?php foreach ($get_all_status as $actividades ) : ?> 
                  <!-- Código dentro del FOREACH de todas las actividades -->
                  <tr>
                      <td><!-- MENU DE OPERACIONES PARA CAD REGISTRO-->                          
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
                      </td>
                      <td><?php echo $actividades->id_act;?></td>
                      <td><?php echo $actividades->actividad;?></td>
                      
                      <?php foreach ($get_categorias as $categos ) :
    
                        if($actividades->id_categoria == $categos->id_categoria) {?>
                      
                        <td><?php echo $categos->categoria;?></td>
                        
                        <?php } ?>
                      
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

