<?php if ( ($edicion = $_SESSION['fc']) != 5 ) { ?>

    <!-- Button to trigger modal -->
<a href="#myModal" class="btn btn-mini" data-toggle="modal" title="Activar Cédula No. <?php echo $actividades->id_act;?> a EDICION 201<?php echo $edicion+1;?>"><i class="icon-share-alt"></i></a>
     
    <!-- Modal -->
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
      </div>
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
      </div>
    </div>




<a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php 
if($actividades->costo_secture == 0){?>
<!-- <a class="btn btn-mini disabled" data-toggle="tooltip" title="Borrar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-trash"></i></a>Fin del IF -->
<?php }  ?>
<?php /* GETOR DE PRESUPUESTO.- VISTA SOLO PARA LOS ADMINISTRATIVO */
if ($actividades->status_act == 4) {
  $app = $_SESSION['username']; /** Cacho la sesion del usaurio **/
    switch ($app) {
      case 'oscarmorales@app.com':  ?>
    <a class="btn btn-mini disabled" href="<?php echo base_url('actividades/compras_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Compras Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-shopping-cart"></i></a>
        <?php break;      
      case 'appcedula@app.com':     ?>
        <a class="btn btn-mini disabled" href="<?php echo base_url('actividades/compras_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Compras Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-shopping-cart"></i></a>
        <?php break;
      default:                                            
        break; 
    } 
}
?>
</td>
<td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<a class="btn btn-mini disabled" href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>


<?php }else{ ?>

<a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
<?php 
if($actividades->costo_secture == 0){?>
<!-- <a class="btn btn-mini disabled" data-toggle="tooltip" title="Borrar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-trash"></i></a>Fin del IF -->
<?php }  ?>
<?php /* GETOR DE PRESUPUESTO.- VISTA SOLO PARA LOS ADMINISTRATIVO */
if ($actividades->status_act == 4) {
  $app = $_SESSION['username']; /** Cacho la sesion del usaurio **/
    switch ($app) {
      case 'oscarmorales@app.com':  ?>
    <a href="<?php echo base_url('actividades/compras_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Compras Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-shopping-cart"></i></a>
        <?php break;      
      case 'appcedula@app.com':     ?>
        <a href="<?php echo base_url('actividades/compras_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Compras Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-shopping-cart"></i></a>
        <?php break;
      default:                                            
        break; 
    } 
}
?>
</td>
<td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>
<a href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  </td><td>
<a class="btn btn-mini disabled" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
<a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>

<?php } ?>