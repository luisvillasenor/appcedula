<?php 
// Edicion de trabajo de la Session y Usuario
$edicion = $_SESSION['fc'];
$username   = $_SESSION['username'];

if ( $fcTrabajo != $edicion && $actividades->status_act != 5 ) { ?>
    <!-- Si NO accesas al Año de Trabajo Actual y la cédula SI esta bloqueada -->
      <td>
              <!-- Button to trigger modal -->
              <button style="margin:7px 15px 17px 0;" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal_<?php echo $actividades->id_act; ?>"><i class="icon-white icon-share-alt"></i><strong> Activar </strong></button>
              <a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>
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
                    <li>La nueva cédula tendrá como Status <span class="label label-warning">Pendiente</span></li>
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
      </td>
        
      
<?php }else{ ?>

      <?php if ( ($fcTrabajo == $edicion) && $actividades->status_act != 5 ) { ?>
      <!-- Si accesas al Año de Trabajo Actual y la cédula NO esta bloqueada -->
      <td>
            <div class="btn-group btn-mini">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                Menu Opciones
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- dropdown menu links -->
                <li>
                  <a href="<?php echo base_url('actividades/editar_actividad/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Editar Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-pencil"></i> Editar</a>
                </li>
                <li>
                  <a href="<?php echo base_url('actividades/necesidades_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Presupuesto de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-shopping-cart"></i> Presupuesto</a>
                </li>
                <li>
                  <a href="<?php echo base_url('actividades/editar_fechas_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Calendario de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-calendar"></i> Calendario</a>
                </li>
                <li>
                  <a href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i> Vista Previa</a>
                </li>
              </ul>
            </div>
          
                  
          <!-- <a class="btn btn-mini" href="<?php echo base_url('actividades/comentarios_act/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Comentarios de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-comment"></i></a> -->
          
          
      </td>  
      <?php }else{ ?>
          <!-- Si accesas al Año de Trabajo Actual y la cédula SI esta bloqueada -->
      <td>
        <a class="btn btn-mini" href="<?php echo base_url('actividades/vista_previa/'.$actividades->id_act.'');?>" data-toggle="tooltip" title="Vista Previa de la Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-eye-open"></i></a>
      </td>

      <?php } ?>

        

<?php } ?>