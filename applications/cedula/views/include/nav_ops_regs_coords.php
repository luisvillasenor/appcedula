<a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>                      
<?php 
if($actividades->costo_secture == 0){?>
<!-- <a class="btn btn-mini disabled" data-toggle="tooltip" title="Borrar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-trash"></i></a>Fin del IF -->
<?php }  ?>
</td><td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<a href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>

