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
    <ul class="nav nav-list well affix">
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
    <ul class="nav nav-list well affix">
      <li class="active"><a><small>MENÚ</small></a></li><br>    
      <li><a href="<?php echo base_url('actividades/agregar_act');?>" ><span><small>Nueva Cédula</small></span></a></li>
      <li><a href="<?php echo base_url('actividades/index');?>" ><span><small>Mis Cédulas</small></span> </a></li>      
      <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><small>Mi Calendario</small></span></a></li>
      <hr>
      <li class="active"><a><small>AYUDA Ext.4336</small></a></li>
      <li><a href="<?php echo base_url('actividades/tutorial');?>" ><span><small>Tutorial</small></span></a></li>
      <li><a href="<?php echo base_url('actividades/padron_proveedores');?>"><span><small>Padrón Único de Proveedores</small></span></a></li>    
    </ul>
</div><!--Body content-->

<?php } ?>



