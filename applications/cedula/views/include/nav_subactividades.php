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

    <div class="well-small span1 sidebar-nav text-center">
      <!--Body content-->
      <ul class="nav nav-pills nav-stacked">
        <li><a href="<?php echo base_url('subactividades/new_subact');?>" ><span><i class="icon-plus"></i> </span></a></li>
        <li><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> </span> </a></li>      
        <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><i class="icon-calendar"></i> </span></a></li>
      </ul>
    </div><!--Body content-->

<?php } ?>



