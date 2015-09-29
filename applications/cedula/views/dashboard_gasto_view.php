<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <?php // include 'include/nav_presupuesto.php';  ?>
      <div class="span2 sidebar-nav">
        <div style="text-align:center; margin:0 auto;">
          
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/logofc.png" width="100%">
          
        </div>
        <hr>
        <!--Body content-->
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                <?php /* APROBACION PRESUPUESTAL.- VISTA SOLO POR EL COORDINADOR GENERAL y APPCEDULA */
            $app = $_SESSION['username']; /** Cacha la sesion del usuario **/
              switch ($app) {
                  case 'appcedula@app.com':?>
                        <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> DASHBOARD</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Listado Clasificados</a></li>
                  <?php  break;
                  case 'blancamartinez@app.com':?>
                        <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> DASHBOARD</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Listado Clasificados</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_gastos');?>">Listado Gastos</a></li>
                  <?php break;
                  case 'oscarmorales@app.com':?>
                        <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> DASHBOARD</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Listado Clasificados</a></li>
                  <?php break;                  
                } 
            ?>
              </ul>
            </div>
      </div><!--Sidebar content-->
      <div class="span10">
      <!--Body content-->
      <?php include 'include/menu_filtros_pres.php';  ?>


<div class="span4">
            <div class="alert alert-info">
              <h4>PRESUPUESTO AUTORIZADO</h4>
              <h3>$<?php echo number_format($suma_pres_aut,2,".",","); ?></h3>
              
            </div>
          </div>

          <div class="span4">
            <div class="alert alert-info">
              <h4>PRESUPUESTO SOLICITADO</h4>
              <h3>$<?php echo number_format($suma_costo_secture*1.16,2,".",","); ?></h3>
              
            </div>
          </div>

          <?php if ($suma_pres_eje <= 0 ) { ?>

          <div class="span3">
            <div class="alert alert-danger">
              <h4>RESULTADO</h4>
              <h3>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h3>
              
            </div>
          </div>
            
          <?php }else{ ?>

          <div class="span3">
            <div class="alert alert-success">
              <h4>RESULTADO</h4>
              <h3>$<?php echo number_format($suma_pres_eje,2,".",","); ?></h3>
              
            </div>
          </div>

          <?php } ?>
          <div class="row"></div>
          


      <hr>
      

          <table class="table table-bordered table-responsive">
                <?php /*foreach ($get_all_actividades as $actividades ) : */?>
                <thead>RUBRO PRESUPUESTO INDIVIDUAL ( CÉDULA #-<?php /*echo $actividades->id_act;*/?>)</thead>
              <tr>                
                <th>CEDULA</th>
                <th>DUEÑO</th>
                
                <th>Solicitado</th>
                <th>Autorizado</th>
                <th>Diferencia</th>
                <th colspan="2"></th>
              </tr>
              <tr>                  
                  <?php $atributos = array('class' => 'navbar-form pull-left', 'name'=>'FormActualizaPres','id'=>'FormActualizaPres','onsubmit' => 'return validacion()'); 
                  echo form_open(base_url().'actividades/dashboard_presupuestos', $atributos); ?>
                  <!-- AUTO ENVIO DEL FORMULARIO DESPUES DE 5 SEGUNDOS  
                  <script type="text/javascript">
                    var wait=setTimeout("document.FormActualizaPres.submit();",5000);
                  </script>
                  <script type="text/javascript">
                    $('#FormActualizaPres').submit(function(e){
                        e.preventDefault();
                    });
                  </script>
                  -->
                  
                  
                  <td>123456</td>
                  <td>Dueño de la cedula</td>

                  <input type="hidden" name="id_act" id="id_act" value="<?php /*echo $actividades->id_act;*/?>">                  
                  <input type="hidden" name="pres_soli" id="pres_soli" value="<?php /*echo $actividades->pres_soli;*/?>">
                 <!-- <td> PRESUPUESTO AÑO ANTERIOR 
                      <input type="text" name="pres_ant" id="pres_ant2" value="<?php /*echo $actividades->pres_ant;*/?>">
                      <span class="help-block">Introduzca la cantidad sin signos de '$' ó comas <br><small>Por ej. 10000.00 son $10,000.00</small></span>

                  </td>-->
                  <td><!-- COSTO TOTAL = SOLICITADO -->
                    <p style="padding: 10px; font-size:30px;" class="text-center">
                    $<?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                    </p>                    
                  </td>                  
                  <td><!-- PRESUPUESTO AUTORIZADO -->
                    <p style="padding: 10px; font-size:30px;" class="text-center">
                      $
                      
                  </td>
                  <td><!-- PRESUPUESTO EJERCIDO SE AUTOCALCULA-->
                    <?php /*if ( $actividades->pres_eje < 0 ) { */?>
                      
                    <?php /*}else{ */?>
                      
                    <?php /*}*/?>
<p style="padding: 10px; font-size:30px;" class="text-center">
                      $
                      
                  </td>
                  
                  <td>
                    <button class="btn btn-large btn-success btn-block" type="submit">Actualizar Calculo</button>
                    <?php echo form_close(); ?>
                    <br>


                    <!-- Menu solo para appcedula -
                  <?php
                        $atributos = array('class' => 'form-inline'); 
                        echo form_open(base_url().'actividades/dashboard_presupuestos', $atributos); ?>                    
                        <input type="hidden" name="presupuestado" id="presupuestado" class="input-small" value="4">
                        <input type="hidden" name="id_act" id="id_act" value="<?php /*echo $actividades->id_act;*/?>">
                        <input type="hidden" name="actividad" id="actividad" value="<?php /*echo $actividades->actividad;*/?>">
                        <input type="hidden" name="usuario" id="usuario" value="<?php /*echo $actividades->e_mail;*/?>">
                        <button type="submit" class="btn btn-inverse btn-md" data-toggle="tooltip" title="Notificar Autorización Presupuestal a Administrativo"><i class="icon-envelope icon-white"></i> Notificar Autorización <br>Presupuestal a Administrativo</button>
                    <?php echo form_close(); ?>            
          <!-- Menu solo para appcedula -->      



                  </td>
          
              </tr>
                <?php /*endforeach; */?>
            </table>

      </div><!— /span10 —>
    </div><!— /row —>
</div><!— /container —>
