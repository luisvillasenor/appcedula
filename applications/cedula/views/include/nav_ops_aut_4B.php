<table class="table table-bordered table-responsive">
                <?php foreach ($get_one_act_edit as $actividades ) : ?>
                <thead>RUBRO PRESUPUESTO INDIVIDUAL ( CÉDULA #-<?php echo $actividades->id_act;?>)</thead>
              <tr>                
                <th>Año Anterior</th>
                <th>Solicitado Año Actual</th>
                <th>Autorizado Año Actual</th>
                <th>Diferencia Año Actual</th>
                <th colspan="2"></th>
              </tr>
              <tr>                  
                  <?php $atributos = array('class' => 'navbar-form pull-left','onsubmit' => 'return validacion()'); 
                  echo form_open(base_url().'actividades/actualizar_pres', $atributos); ?>

                  <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">                  
                  <input type="hidden" name="pres_soli" id="pres_soli" value="<?php echo $actividades->pres_soli;?>">
                  <td><!-- PRESUPUESTO AÑO ANTERIOR -->
                      <input type="text" name="pres_ant" id="pres_ant2" value="<?php echo $actividades->pres_ant;?>">
                      <span class="help-block">Captura numeros SIN coma <br><small>Por ej. 10000.00 son $10,000.00</small></span>
                  </td>
                  <td><!-- COSTO TOTAL = SOLICITADO -->
                    <p style="padding: 10px; font-size:30px;" class="text-center">
                    $<?php
                      echo number_format($actividades->costo_secture*1.16,2,".",",");
                    ?> 
                    </p>                    
                  </td>                  
                  <td><!-- PRESUPUESTO AUTORIZADO -->
                      <input type="text" name="pres_aut" id="pres_aut2" value="<?php echo $actividades->pres_aut;?>">
                      <span class="help-block">Captura numeros SIN coma <br><small>Por ej. 10000.00 son $10,000.00</small></span>
                  </td>
                  <td><!-- PRESUPUESTO EJERCIDO SE AUTOCALCULA-->
                    <?php if ( $actividades->pres_eje < 0 ) { ?>
                      <input style="background-color: red;color: white; padding: 10px; font-size:25px;" class="text-center" type="text" name="pres_eje" id="pres_eje2" value="<?php echo number_format($actividades->pres_eje,2,".",",");?>" readonly>
                      <span class="help-block">Diferencia entre Autorizado menos Solicitado<br><small>Se calcula automático al guardar.</small></span>
                    <?php }else{ ?>
                      <input style="border: solid black; font-size:20px;" class="text-center" type="text" name="pres_eje" id="pres_eje2" value="<?php echo number_format($actividades->pres_eje,2,".",",");?>" readonly>
                      <span class="help-block">Diferencia entre Autorizado menos Solicitado<br><small>Se calcula automático al guardar.</small></span>
                    <?php }?>
                      
                  </td>
                  <td>
                    <button class="btn btn-large btn-success btn-block" type="submit">Actualizar Calculo</button>
                    <?php echo form_close(); ?>
                  </td>
                  <td>

                    <?php
                    if ( $onlyusername !== 'appcedula' ) { ?>
                        <!-- Menu solo para appcedula -->
                                <?php
                                      $atributos = array('class' => 'form-inline'); 
                                      echo form_open(base_url().'actividades/si_presupuestado', $atributos); ?>                    
                                      <input type="hidden" name="presupuestado" id="presupuestado" class="input-small" value="4">
                                      <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
                                      <input type="hidden" name="actividad" id="actividad" value="<?php echo $actividades->actividad;?>">
                                      <input type="hidden" name="usuario" id="usuario" value="<?php echo $actividades->e_mail;?>">
                                      <button type="submit" class="btn btn-inverse btn-lg" data-toggle="tooltip" title="Notificar Autorización Presupuestal a Administrativo"><i class="icon-envelope icon-white"></i> Notificar Autorización <br>Presupuestal a Administrativo</button>
                                  <?php echo form_close(); ?>            
                        <!-- Menu solo para appcedula -->          
                    <?php } ?>
                  </td>
              </tr>
                <?php endforeach; ?>
            </table>

