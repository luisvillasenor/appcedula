<?php if ( ($edicion = $_SESSION['fc']) != 5 && $actividades->status_act != 5) { ?>

<!-- Button to trigger modal -->
<a href="#myModal" class="btn btn-mini" data-toggle="modal" title="Activar Cédula No. <?php echo $actividades->id_act;?> a EDICION 201<?php echo $edicion+1;?>"><i class="icon-share-alt"></i></a>
     
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <?php echo $actividades->id_act; ?>
    <br>
    <?php echo $actividades->id_fc; ?>
    <br>
    <?php echo $edicion; ?>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <a href="<?php echo base_url('actividades/copiar');?>/<?php echo $actividades->id_act; ?>" class="btn btn-primary">Save changes</a>
  </div>
</div>
<!-- End Modal -->

<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php } else {?>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/editar_actividad/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php } ?><!-- Fin del IF -->
  <?php if($actividades->costo_secture == 0) { ?>
    <!--<a href="<?php echo base_url();?>/actividades/is_borrar_act/<?php echo $actividades->id_act;?>" data-toggle="tooltip" title="Borrar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-trash"></i></a>Fin del IF -->
  <?php } ?> 
  </td><td>

<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<?php } else {?>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/necesidades_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<?php } ?><!-- Fin del IF -->
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } else {?>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } ?><!-- Fin del IF -->
<a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>


<?php }else{ ?>

<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php } else {?>
<a href="<?php echo base_url('actividades/editar_actividad/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php } ?><!-- Fin del IF -->
  <?php if($actividades->costo_secture == 0) { ?>
    <!--<a href="<?php echo base_url();?>/actividades/is_borrar_act/<?php echo $actividades->id_act;?>" data-toggle="tooltip" title="Borrar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-trash"></i></a>Fin del IF -->
  <?php } ?> 
  </td><td>

<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<?php } else {?>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/necesidades_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<?php } ?><!-- Fin del IF -->
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } else {?>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } ?><!-- Fin del IF -->
<a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>


<?php } ?>