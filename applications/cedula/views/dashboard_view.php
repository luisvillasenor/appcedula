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
                <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>">Listado de Consolidados</a></li>
              </ul>
            </div>
      </div><!--Sidebar content-->

      <div class="span10">
      <!--Body content-->
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
          <div class="row"></div>
          <div style="text-align:center; margin:0 auto;">
            <!--<a href="#">
              <img src="<?php echo base_url();?>bootstrap/img/Dashboard1.png" width="100%">
            </a>-->
          </div>
          <div class="row"></div>
          <div style="text-align:center; margin:0 auto;">
            <!--<a href="#">
              <img src="<?php echo base_url();?>bootstrap/img/Dashboard1.png" width="100%">
            </a>-->
          </div>

      </div><!— /span10 —>
    </div><!— /row —>
</div><!— /container —>
