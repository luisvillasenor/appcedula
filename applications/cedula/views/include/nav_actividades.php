<?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) { ?>

<div class="span2 sidebar-nav">
  <!--Body content-->
    <ul class="nav nav-list well affix">
      <li class="active"><a><small>AYUDA Ext.4336</small></a></li>
    </ul>
</div><!--Body content-->

<?php }elseif ($edicion != 5) { // 5 es la edición actual 2015 ?>
  
  <div class="span2 sidebar-nav">
  <!--Body content-->
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a><small>MENÚ</small></a></li><br>    
      <li><a href="<?php echo base_url('actividades/index');?>" ><span><small>Mis Cédulas</small></span> </a></li>      
      <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><small>Mi Calendario</small></span></a></li>
      <hr>
      <li class="active"><a><small>AYUDA Ext.4336</small></a></li>
      <li><a href="<?php echo base_url('actividades/tutorial');?>" ><span><small>Tutorial</small></span></a></li>
    </ul>
</div><!--Body content-->
<?php }else{ ?>

<div class="span2 sidebar-nav">
  <!--Body content-->
  <div style="text-align:center; margin:0 auto;">
          
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/logofc.png" width="100%">
          
        </div>
         

         <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
          </div>


    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a><small>MENÚ</small></a></li><br>    
      <li><a href="<?php echo base_url('actividades/agregar_act');?>" ><span><small>Nueva Cédula</small></span></a></li>
      <li><a href="<?php echo base_url('actividades/index');?>" ><span><small>Mis Cédulas</small></span> </a></li>      
      <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><small>Mi Calendario</small></span></a></li>
      
       <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
          </div>


      <li class="active"><a><small>AYUDA Ext.4336</small></a></li>
      <li><a href="<?php echo base_url('actividades/tutorial');?>" ><span><small>Tutorial</small></span></a></li>
      <li><a href="<?php echo base_url('actividades/padron_proveedores');?>"><span><small>Proveedores</small></span></a></li>

       <div class="text-center">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
          </div>

      <?php /* APROBACION PRESUPUESTAL.- VISTA SOLO POR EL COORDINADOR GENERAL y APPCEDULA */
            $app = $_SESSION['username']; /** Cacha la sesion del usuario **/
              switch ($app) {
                  case 'appcedula@app.com':?>
                        <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> CONTROL PRESUPUESTO Y GASTO</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                        <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Listado Clasificados</a></li>
                  <?php  break;
                  case 'blancamartinez@app.com':?>
                        <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> CONTROL PRESUPUESTO Y GASTO</a></li>
      
                  <?php break;
      
                } 
            ?>

    </ul>
</div><!--Body content-->

 


<?php } ?>



