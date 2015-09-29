<?php 

$edicion = $_SESSION['fc'];
$username   = $_SESSION['username'];
if ( $edicion != '5') { ?>

      <?php if($actividades->status_act == 5) { ?>

      <?php } elseif( $actividades->e_mail ==  $username) {?>

              <!-- Button to trigger modal -->
              <button style="margin:7px 15px 17px 0;" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal_<?php echo $actividades->id_act; ?>"><i class="icon-white icon-share-alt"></i><strong> Activar </strong></button>
              <!-- Modal -->
              <div id="myModal_<?php echo $actividades->id_act; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Considere lo siguiente</h3>
                </div>
                <div class="modal-body">
                <p>Al Activar la cédula:</p>
                  <ul>
                    <li><p>Se creará una copia en la Edición 201<?php echo $edicion+1;?></p></li>
                    <li>La nueva cédula tendra un ID diferente, sin embargo el nombre y todo lo demás permanecerá igual</li>
                    <li>La nueva cédula tendrá como Status <span class="label label-danger">No Aprobado</span></li>
                    <li><p>Para ver y trabajar la nueva cédula, debe salir y volver a entrar al Sistema seleccionando
                   la Edición de Trabajo del 201<?php echo $edicion+1;?></p></li>
                   <li>La vieja cédula se guarda como histórico y verá un candadito en el campo "Status"</li>     
                  </ul>
                  <p>Cualquier ayuda que necesite maque la extensión 4336 o 4306.</p>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                  <a href="<?php echo base_url('actividades/copiar');?>/<?php echo $actividades->id_act; ?>" class="btn btn-success">Activar Cédula (<?php echo $actividades->id_act; ?>) para FC EDICION 201<?php echo $edicion+1;?></a>
                </div>
              </div>
              <!-- End Modal -->

      <?php } ?><!-- Fin del IF -->



      </td>
      <td>


      </td>


      <a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>


<?php }else{ ?>
       
      <td>
      <?php if ( $actividades->status_cedula == 0 ) { ?>
        <a class="btn btn-mini" href="<?php echo base_url('actividades/cerrar_presupuesto/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Al Cerrar la Cédula No. <?php echo $actividades->id_act;?> ya no se podran hacer cambios a la misma por parte del dueño. En caso de cerrar la cédula por error debe avisar a Informática a la ext. 4336"><i class="icon-lock"></i>Bloquear Cédula</a>     
      <?php }else{ ?>
        <a class="btn btn-mini disabled" data-toggle="tooltip" title="Cerrar Cédula"><i class="icon-lock"></i></a>
      <?php } ?>
      <a class="btn btn-success btn-block" href="<?php echo base_url('actividades/vista_previa_presupuesto/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Ver Detalle de la Cédula No. <?php echo $actividades->id_act;?>">Ver Desglose del Gasto Ejecutado</a>
    </td>
<?php } ?>