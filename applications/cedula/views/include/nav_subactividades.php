<?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) {?>

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
      <?php
        switch ($grupo) {
          case 'administrador': ?>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('subactividades/new_subact');?>" ><span><i class="icon-plus"></i> </span></a></li>
                  <li><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> </span> </a></li>      
                  <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><i class="icon-calendar"></i> </span></a></li>
                </ul>
          <?php break;
          case 'ortografia':?>
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> </span> </a></li>
                </ul>
          <?php break;
          default:
            echo '<div class="alert alert-block alert-error">';
            echo '<button type="button" class="close" data-dismiss="alert">x</button>';
            echo '<h4 class="alert-heading">Ups ! Parece ser que Usted no es Miembo de este Sitio !</h4>';
            echo '<p>';
            echo 'Por favor solicite ayuda al administrador del sitio';
            echo '</p>';
            echo '<p>';
            echo '<a class="btn btn-danger" href="'.base_url('admin/logout').'">Cerrar</a>';
            echo '</p>';
            echo '</div>';
            break;
        } 

      ?>
      
    </div><!--Body content-->

<?php } ?>