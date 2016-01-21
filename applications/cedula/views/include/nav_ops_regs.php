<?php 
// Edicion de trabajo de la Session y Usuario
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


      </td><td>


      <a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>


<?php }else{ ?>

      <?php if ( $actividades->status_cedula == 0 ) { ?>
        
        <a class="btn btn-mini" href="<?php echo base_url('actividades/editar_actividad/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i></a>
            </td>
    <td>
        <a class="btn btn-mini" href="<?php echo base_url('actividades/necesidades_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-list"></i></a>        
        <a class="btn btn-mini" href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a>                  
    </td>

    <td>        
        <a class="btn btn-mini" href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i></a>
      
      <?php }else{ ?>

        
        <a class="btn btn-mini disabled" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>" readonly><i class="icon-pencil"></i></a>
    </td>
    <td>
        <a class="btn btn-mini disabled" data-toggle="tooltip" title="Listar Necesidades de la Cédula No. <?php echo $actividades->id_act;?>" readonly><i class="icon-list"></i></a>
        <a class="btn btn-mini disabled" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>" readonly><i class="icon-comment"></i></a>                  
    </td>

            <td>
        <a class="btn btn-mini disabled" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>" readonly><i class="icon-calendar"></i></a>
        

      <?php } ?>


            <a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>
            </td>

      

<?php } ?>