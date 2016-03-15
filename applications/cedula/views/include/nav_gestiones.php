<?php /* Nav de Gestiones de Sedes, ubicaciones y Subactividades */
$app = $_SESSION['username']; /** Cacha la sesion del usuario **/
  switch ($app) {
      case 'rabingarcia@app.com':?>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('sedes/index');?>" ><span><small>SEDES</small></span></a></li>
                <li><a href="<?php echo base_url('ubicaciones/index');?>" ><span><small>UBICACIONES</small></span> </a></li>
                <li><a href="<?php echo base_url('subactividades/index');?>"><span><small>SUBACTIVIDADES</small></span></a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
      <?php  break;
      case 'minerva@app.com':?>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('subactividades/index');?>"><span><small>SUBACTIVIDADES</small></span></a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
      <?php break;
      case 'alerodriguez@app.com':?>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('sedes/index');?>" ><span><small>SEDES</small></span></a></li>
                <li><a href="<?php echo base_url('ubicaciones/index');?>" ><span><small>UBICACIONES</small></span> </a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
      <?php break;
      case 'appcedula@app.com':?>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('sedes/index');?>" ><span><small>SEDES</small></span></a></li>
                <li><a href="<?php echo base_url('ubicaciones/index');?>" ><span><small>UBICACIONES</small></span> </a></li>
                <li><a href="<?php echo base_url('subactividades/index');?>"><span><small>SUBACTIVIDADES</small></span></a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
      <?php break;

    } 
?>