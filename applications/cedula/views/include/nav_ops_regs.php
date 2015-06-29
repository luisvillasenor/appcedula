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
<a href="<?php echo base_url('actividades/necesidades_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<?php } ?><!-- Fin del IF -->
<a href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<?php if($actividades->status_act == 5) { ?>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } else {?>
<a href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<?php } ?><!-- Fin del IF -->
<a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>