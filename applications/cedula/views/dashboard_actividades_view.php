<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
         
       <div class="span2 sidebar-nav">
        <div style="text-align:center; margin:0 auto;">
          <a href="<?php echo base_url('actividades/dashboard');?>">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/sectureags.png" width="50%">
          </a>
        </div>
        <hr>
        <!--Body content-->
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                
                <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> DASHBOARD</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>">Listado Clasificados</a></li>
                
              </ul>
            </div>
      </div><!--Sidebar content-->

        <div class="span10">
        <!--Body content-->
        <?php include 'include/menu_filtros_pres.php';?> 
           
        
        <?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) { ?>
          <div id="subheader3"><h2><strong><?php printf($edicion); ?></strong></h2></div>
        <?php }else{ ?>
                    
              <div class="span4">
                <div class="alert alert-info">
                  <h4>PRESUPUESTO AUTORIZADO</h4>
                  <h1>$<?php echo number_format($suma_pres_aut,2,".",","); ?></h1>
                  Sumatoria del presupuesto neto autorizado de cada cédula
                </div>
              </div>

              <div class="span4">
                <div class="alert alert-info">
                  <h4>PRESUPUESTO SOLICITADO</h4>
                  <h1>$<?php echo number_format($suma_costo_secture*1.16,2,".",","); ?></h1>
                  Sumatoria del COSTO NETO SECTURE de cada cédula
                </div>
              </div>

              <?php if ($suma_pres_eje <= 0 ) { ?>

              <div class="span3">
                <div class="alert alert-danger">
                  <h4>RESULTADO</h4>
                  <h1>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h1>
                  Diferencia entre lo <small>AUTORIZADO</small> y los <small>SOLICITADO</small>
                </div>
              </div>
                
              <?php }else{ ?>

              <div class="span3">
                <div class="alert alert-success">
                  <h4>RESULTADO</h4>
                  <h1>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h1>
                  Diferencia entre lo <small>AUTORIZADO</small> y lo <small>SOLICITADO</small>
                </div>
              </div>

              <?php } ?>

          
          <hr>
          
          
        <?php } ?>

                    
            <!-- Encabezados de la tabla de cédulas-->
            <?php include 'include/header_cedulas_presupuesto.php';  ?>        
              
                <?php foreach ($get_all_actividades as $actividades ) : ?>
                  <!-- Código dentro del FOREACH de todas las actividades -->
                  <tr>                      
                      <td><!-- MENU DE OPERACIONES PARA CAD REGISTRO-->                          
                          <?php include 'include/nav_ops_pres.php';?>                          
                      </td>
                      <td><?php echo $actividades->id_act;?></td>
                      <td><?php echo $actividades->actividad;?></td>
                      
                      <?php foreach ($get_categorias as $categos ) :
    
                        if($actividades->id_categoria == $categos->id_categoria) {?>
                      
                            <td><?php echo $categos->categoria;?></td>
                        
                        <?php } ?>
                                          
                      <?php endforeach; ?>
                      
                      
                      <td><?php echo $actividades->quienpropone;?>(<?php echo $actividades->e_mail;?>)</td>   
                      <td id="pesos">$<?php echo number_format($actividades->costo_secture*1.16,2,".",","); ?></td>
                                            
                      <?php include 'include/nav_status_act.php';  ?>                                            
                  </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
          
          
        </div><!— /span10 —>

        

    </div><!— /row —>

</div><!— /container —>
