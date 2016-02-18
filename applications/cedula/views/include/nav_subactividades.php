<?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) 
{?>

    <div class="span2 sidebar-nav">
      <!--Body content-->
    </div><!--Body content-->

<?php }elseif ( $idfcTrabajo != $edicion ) { // 5 es la edición actual 2015 ?>
  
    <div class="span2 sidebar-nav">
    <!--Body content-->
    </div><!--Body content-->

<?php }else{ ?>

    <div class="well well-small span2 sidebar-nav">
      <!--Body content-->
      
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a><small>MENÚ EVENTOS</small></a></li><br>    
          <li><a href="<?php echo base_url('subactividades/new_subact');?>" ><span><i class="icon-plus"></i> <small>Agregar Evento</small></span></a></li>
          <li><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> <small>Listar Eventos</small></span> </a></li>      
          <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><i class="icon-calendar"></i> <small>Calendario</small></span></a></li>
        </ul>
    </div><!--Body content-->

<?php } ?>



