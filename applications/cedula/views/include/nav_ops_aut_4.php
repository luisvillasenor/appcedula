<table class="table table-bordered">
                <?php foreach ($get_one_act_edit as $actividades ) : ?>
                <thead>RUBRO PRESUPUESTAL.- XX FESTIVAL DE CALAVERAS 2014 (PARTIDA ########-<?php echo $actividades->id_act;?>)</thead>
              <tr>                
                <th>Presupuesto Año Anterior</th>
                <th>Presupuesto Solicitado</th>
                <th>Presupuesto Autorizado</th>
                <th>Presupuesto Ejercido</th>
                <th colspan="2"></th>
              </tr>
              <tr>                  
                  <?php $atributos = array('class' => 'navbar-form pull-left','onsubmit' => 'return validacion()'); 
                  echo form_open(base_url().'actividades/actualizar_pres', $atributos); ?>                  
                  <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
                  <input type="hidden" name="pres_soli" id="pres_soli" value="<?php echo $actividades->pres_soli;?>">
                  <td><!-- PRESUPUESTO AÑO ANTERIOR -->
                      <input type="text" name="pres_ant" id="pres_ant2" value="<?php echo $actividades->pres_ant;?>"></td>
                  <td><!-- COSTO TOTAL = SOLICITADO -->
                      $<?php 
                        foreach ($get_total_act as $tot ) : 
                            echo number_format($tot->tot_tot,2,".",",");
                        endforeach;
                      ?>
                  </td>                  
                  <td><!-- PRESUPUESTO AUTORIZADO -->
                      <input type="text" name="pres_aut" id="pres_aut2" value="<?php echo $actividades->pres_aut;?>"></td>
                  <td><!-- PRESUPUESTO EJERCIDO -->
                      <input type="text" name="pres_eje" id="pres_eje2" value="<?php echo $actividades->pres_eje;?>"></td>
                  <td>
                    <button class="btn" type="submit">Guardar</button>
                    <?php echo form_close(); ?>
                      <!-- <a href="#myModal" role="button" class="btn" data-toggle="modal">Movimientos</a>  -->
                  </td>
                  <td><?php $atributos = array('class' => 'form-inline'); 
    echo form_open(base_url().'actividades/si_presupuestado', $atributos); ?>                    
    <input type="hidden" name="presupuestado" id="presupuestado" class="input-small" value="4">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
    <input type="hidden" name="actividad" id="actividad" value="<?php echo $actividades->actividad;?>">
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $actividades->e_mail;?>">
    <button type="submit" class="btn btn-inverse " data-toggle="tooltip" title="Notificar Autorización Presupuestal al Responsable de la Cédula No. <?php echo $actividades->id_act; ?>"><i class="icon-envelope icon-white"></i> Notificar</button>
<?php echo form_close(); ?></td>
              </tr>
                <?php endforeach; ?>
            </table>

<!-- Modal Ver Movomientos -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Movimientos Efectuados al Presupuesto</h3>
          </div>
          <div class="modal-body">
              
              <script>
                  $(document).ready(function(){                      
                      var PresAnt = 100;
                      var PresMod = PresAnt;
                      var PresMod2 = PresAnt;
                      
                      $("#plus").click(function(){
                          var dato1 = $("#datoPlus").val();
                          PresMod += Number(dato1);
                          alert(PresMod);
                      });
                      
                      $("#minus").click(function(){
                          var dato2 = $("#datoMinus").val();
                          PresMod2 += Number(dato2);
                          alert(PresMod2);
                      });
                      
                    });
              
              </script>
            
            <table>
                <tr>
                    <td>
                        <form id="plusForm" class="form-inline">
                            <label>Monto</label>
                            <input type="text" id="datoPlus" class="input-small" placeholder="Monto ">
                            <label>Tipo</label>
                            <input type="radio" id="datoPlus" class="input-small" placeholder="Monto ">
                            
                        </form>
                    </td>
                </tr>
                  
            </table>
            
            
              
            <table class="table table-bordered">
              <caption>Cédula.- <?php echo $actividades->actividad;?></caption>
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Registrado por</th>
                  <th>Tipo de Movimiento</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <!-- INICIO --> <?php foreach ($get_all_movs as $movs ) : ?>
                <!-- REGISTROS DE MOVIMIENTOS DE LA CÉDULA CORRESPONDIENTE -->
                <tr>
                  <td><?php echo $movs->fecha_alta;?></td>
                  <td><?php echo $movs->quien;?></td>
                  <td><?php echo $movs->tipo;?></td>
                  <td><?php echo $movs->monto;?></td>
                </tr>
                
                <!-- REGISTROS DE MOVIMIENTOS DE LA CÉDULA CORRESPONDIENTE -->
                <!-- FIN --> <?php endforeach; ?>
              </tbody>
            </table>    
          </div>
          <div class="modal-footer">
            <small>Estos datos sólo son de ejemplo</small>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
            <a href="<?php echo base_url();?>actividades/vista_previa/<?php echo $actividades->id_act;?>" class="btn btn-primary">Salvar Movimiento</a>
          </div>
        </div>