<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span12">
        <!--Body content-->
            <div class=""><h3>MASTER CONTENIDOS FC EDICIÓN 201<?php echo $edicion;?></h3></div>            
            
            <?php include 'include/menu_filtros_master_contenidos.php';  ?>

            
            <hr>
            
            <div class="">                
                <table class="well table table-bordered">                    
                    <thead></thead>                
                    <tr>
                        <th colspan="2" style="text-align:center"></th>
                        <th colspan="" style="text-align:center"></th>
                        <!--<th colspan="" style="text-align:center"></th>
                        <th colspan="" style="text-align:center"></th>
                        <th colspan="10" style="text-align:center"></th>-->
                    </tr>
                    <tr>
                        
                        <th>CATEGORÍA</th>                        
                        <th>EVENTO</th>                        
                        <th colspan="9" style="text-align:center">PROGRAMA DETALLADO</th>                        
                        
                        
                        <?php /*
                          $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                          foreach ($fechas as $value) {?>
                            <th><?php echo date("d M",strtotime($value));?></th>
                        <?php }*/?>
                        
                    </tr>
                    <?php foreach ($get_all_coords as $coord ) : ?>
                                                    
                    <?php foreach ($get_all_cats as $cats ) : ?>
                                            
                        <?php if ($coord->id_coord == $cats->id_coord){ ?>
                                                                                
                                <?php foreach ($get_master_plan as $act ) : ?>
                                <tr>                                                            
                                    <?php if($cats->id_categoria == $act->id_categoria AND $coord->id_coord == $act->id_coord){ ?>
                             
                                        
                                        <td><small><?php echo $cats->categoria;?></small></td>
                                        <td><small><?php echo $act->actividad;?></small><br>

                                            <?php switch ($act->status_act) {
                                                  case '1':?>
                                                    <span name="flag" id="flag" class="label label-important"><small>No Aprobado</small></span>
                                            <?php break;
                                                  case '2':?>
                                                    <span name="flag" id="flag" class="label label-success"><small>Aprobado Conceptual</small></span>
                                            <?php break;
                                                case '3':?>
                                                    <span name="flag" id="flag" class="label label-info"><small>Integrado al Programa General</small></span>
                                            <?php break;
                                                case '4':?>        
                                                      <span name="flag" id="flag" class="label label-inverse"><small>Presupuesto AUTORIZADO</small></span>        
                                            <?php break;
                                                case '5':?>
                                                    <span name="flag" id="flag" class="label"><i class="icon-lock"></i><small> Bloqueada</small></span>
                                            <?php break;
                                                  default: ?>
                                                    <span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span>
                                            <?php break;
                                                  } ?>


                                        </td>
                                        
                                        <td>
                                            <table>
                                                <tr>
                                                 <th><small>Actividad/Taller</small></th>
                                                 <th><small>Costo</small></th>
                                                 <th><small>Fecha</small></th>
                                                 <th><small>Horario</small></th>
                                                 <th><small>Sede</small></th>
                                                 <th><small>Ubicacion</small></th>
                                                 <th><small>Status</small></th>
                                                 <th><small></small></th>
                                               </tr>
                                        <?php foreach ($get_all as $necs ) : ?>                                                
                                            <?php if ($act->id_act == $necs->id_act){ ?>
                                                
                                                   <tr>
                                                        <td>
                                                            <p ondblclick="myFunctionXsubactividadcontenido<?php echo $necs->id_subact; ?>()">
                                                                <span class="label label-default">
                                                                <small>
                                                                <?php echo $necs->subactividad; ?>
                                                                </small>
                                                                </span>
                                                            <p>
                                                              <script>
                                                              function myFunctionXsubactividadcontenido<?php echo $necs->id_subact; ?>() {
                                                                  $('#EditarContenido<?php echo $necs->id_subact; ?>').modal('show')
                                                              }
                                                              </script>
                                                            
                                                        </td>
                                                        <td><small><?php echo $necs->status_subact;?></small></td>
                                                        <td><small><?php echo $necs->fecha_taller;?></small></td>
                                                        <td><small>De <?php echo date("H:s",strtotime($necs->hora_ini));?> a <?php echo date("H:s",strtotime($necs->hora_fin));?></small></td>
                                                        <td><small><?php echo $necs->sede;?></small></td>
                                                        <td><small><?php echo $necs->ubicacion;?></td>
                                                        <td>
                                                            <?php
                                                            if ($necs->status_contenido == TRUE AND $necs->status_ortografia == TRUE) { ?>
                                                              <span class="label label-inverse">Programa General</span>
                                                            <?php } else { ?>
                                                                    <div id="miStatusContenido<?php echo $necs->id_subact; ?>">
                                                                    <?php  
                                                                        switch ($necs->status_contenido) {
                                                                          case '2':      ?>
                                                                            <span class="label label-danger">Contenido No Autorizado</span>
                                                                          <?php break;      
                                                                          case '1':      ?>
                                                                            <span class="label label-success">Contenido Autorizado</span>
                                                                          <?php break;
                                                                          default:    ?>
                                                                            <span class="label label-warning">Autorizacion Pendiente</span>  
                                                                          <?php break; 
                                                                        } 
                                                                    ?>
                                                                    </div>
                                                                    <div id="miStatusOrtografia<?php echo $necs->id_subact; ?>">
                                                                      <?php
                                                                        switch ($necs->status_ortografia) {
                                                                            case '1':      ?>
                                                                              <span class="label label-success">Ortografía Limpia</span>
                                                                            <?php break;
                                                                            case '0':      ?>
                                                                              <span class="label label-warning">Revision Ortográfica Pendiente</span>  
                                                                            <?php break;
                                                                          } 
                                                                      ?>
                                                                    </div>
                                                                  <?php } ?> 
                                                        </td>
                                                        <td>
                    <?php
                    $app = $_SESSION['username']; /** Cacho la sesion del usaurio **/

                    if ($necs->status_contenido == TRUE AND $necs->status_ortografia == TRUE) { ?>
                      <span class="label"><i class="icon-lock"></i><small> Bloqueado</small></span>
                      <?php
                          switch ($app) {
                            case 'rabingarcia@app.com':
                              # code...
                                                  ?>
                                                    <div>
                                                        <?php 
                                                          switch ($necs->status_contenido) { 
                                                            case '0': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $necs->id_subact; ?>" onchange="myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                            case '1': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $necs->id_subact; ?>" checked onchange="myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                          }
                                                        ?>                                                      
                                                      </div>
                                                      <div>
                                                      <?php 
                                                        switch ($necs->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $necs->id_subact; ?>" onchange="myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $necs->id_subact; ?>" checked onchange="myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                      <script>
                                                        function myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>() {
                                                            var valor = document.getElementById('status_contenido<?php echo $necs->id_subact; ?>').checked;
                                                            if (valor == false) {
                                                              document.getElementById("status_contenido<?php echo $necs->id_subact; ?>").setAttribute("checked",false);
                                                              //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:0,
                                                                    id_subact:<?php echo $necs->id_subact; ?>,
                                                                    id_act:<?php echo $necs->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-warning'>Autorización Pendiente</span>";
                                                              });
                                                            } else if (valor == true) {
                                                              document.getElementById("status_contenido<?php echo $necs->id_subact; ?>").setAttribute("checked",true);
                                                              //alert("The input value has changed. The new value is: " + "SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:1,
                                                                    id_subact:<?php echo $necs->id_subact; ?>,
                                                                    id_act:<?php echo $necs->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-success'>Contrenido Autorizado</span>";
                                                              });
                                                            };
                                                        }

                                                        function myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $necs->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $necs->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $necs->id_subact; ?>,
                                                                  id_act:<?php echo $necs->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $necs->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $necs->id_subact; ?>,
                                                                  id_act:<?php echo $necs->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                      </script>
                                                     
                                                
                                                    
                                                   
                                                <?php
                              break;
                            
                          } 
                  
                    }
                            else {                                
                                  
                                  switch ($app) {
                                      case 'rabingarcia@app.com':                             ?>

                                                      <div>
                                                        <?php 
                                                          switch ($necs->status_contenido) { 
                                                            case '0': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $necs->id_subact; ?>" onchange="myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                            case '1': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $necs->id_subact; ?>" checked onchange="myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                          }
                                                        ?>                                                      
                                                      </div>
                                                      <script>
                                                        function myFunctioncheckcontenidogeneral<?php echo $necs->id_subact; ?>() {
                                                            var valor = document.getElementById('status_contenido<?php echo $necs->id_subact; ?>').checked;
                                                            if (valor == false) {
                                                              document.getElementById("status_contenido<?php echo $necs->id_subact; ?>").setAttribute("checked",false);
                                                              //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:0,
                                                                    id_subact:<?php echo $necs->id_subact; ?>,
                                                                    id_act:<?php echo $necs->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-warning'>Autorización Pendiente</span>";
                                                              });
                                                            } else if (valor == true) {
                                                              document.getElementById("status_contenido<?php echo $necs->id_subact; ?>").setAttribute("checked",true);
                                                              //alert("The input value has changed. The new value is: " + "SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:1,
                                                                    id_subact:<?php echo $necs->id_subact; ?>,
                                                                    id_act:<?php echo $necs->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-success'>Contenido Autorizado</span>";
                                                              });
                                                            };
                                                        }
                                                      </script>
                                              
                                                    <div>
                                                      <?php 
                                                        switch ($necs->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $necs->id_subact; ?>" onchange="myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $necs->id_subact; ?>" checked onchange="myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                    <script>
                                                      function myFunctioncheckortografiageneral<?php echo $necs->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $necs->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $necs->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $necs->id_subact; ?>,
                                                                  id_act:<?php echo $necs->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $necs->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $necs->id_subact; ?>,
                                                                  id_act:<?php echo $necs->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $necs->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                    </script>

                                                <?php
                                        break; 
                                  }
                        } ?>

                  </td> 

                                                        <!-- Modal EditarContenido -->
                                                          <div id="EditarContenido<?php echo $necs->id_subact; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                              <h3 id="myModalLabel">Actualiza Actividad/Taller</h3><small>ID: <?php echo $necs->id_subact; ?></small>
                                                            </div>
                                                            <?php echo form_open(base_url('subactividades/update'),'class=""'); ?>
                                                                <div class="modal-body">
                                                                  <div class="well">
                                                                    <input type="hidden" name="objeto" id="objeto" value="mastercontenido">
                                                                    <input type="hidden" name="id_subact" id="id_subact" value="<?php echo $necs->id_subact; ?>">
                                                                    <input type="hidden" name="id_act" id="id_act" value="<?php echo $necs->id_act; ?>">
                                                                    <textarea rows="1" type="text" name="subactividad" id="subactividad"><?php echo $necs->subactividad; ?></textarea>
                                       
                                                                    <script>
                                                                      $(function() {
                                                                        $( "#fecha_taller_editcontenido_<?php echo $necs->id_subact; ?>" ).datepicker({
                                                                          dateFormat: "yy-mm-dd",
                                                                          defaultDate: "+1w",
                                                                          changeMonth: true,
                                                                          numberOfMonths: 2,
                                                                          onClose: function( selectedDate ) {
                                                                            $( "#to" ).datepicker( "option", "minDate", selectedDate );
                                                                          }
                                                                        });
                                                                        $( "#to" ).datepicker({
                                                                          dateFormat: "yy-mm-dd",
                                                                          defaultDate: "+1w",
                                                                          changeMonth: true,
                                                                          numberOfMonths: 2,
                                                                          onClose: function( selectedDate ) {
                                                                            $( "#from" ).datepicker( "option", "maxDate", selectedDate );
                                                                          }
                                                                        });
                                                                      });
                                                                      </script>
                                                                    <script>
                                                                      $(document).ready(function(){
                                                                        $(function() {
                                                                          $( "#fecha_taller_editcontenido_<?php echo $necs->id_subact; ?>" ).datepicker({ 
                                                                            dateFormat: 'yy-mm-dd', 
                                                                            showWeek: true, 
                                                                            firstDay:1
                                                                          });                                              
                                                                        });
                                                                      });      
                                                                    </script>

                                                                    <br><input type="text" name="fecha_taller" id="fecha_taller_editcontenido_<?php echo $necs->id_subact; ?>" value="<?php echo $necs->fecha_taller; ?>"><br>
                                          
                                                                    <select class="input-md" id="sede" name="sede">
                                                                        <option>Sede</option>
                                                                        <?php foreach ($show_sedes as $sede ) : ?>
                                                                          <?php if ( $necs->sede == $sede->sede ) { ?>
                                                                              <option value="<?php echo $sede->sede; ?>" selected><?php echo $sede->sede; ?></option>
                                                                          <?php } else { ?>
                                                                              <option value="<?php echo $sede->sede; ?>"><?php echo $sede->sede; ?></option>
                                                                          <?php } ?>
                                                                        <?php endforeach; ?>   
                                                                    </select>
                                          
                                          
                                                                    <select class="input-md" id="ubicacion" name="ubicacion">
                                                                        <option>Ubicacion</option>
                                                                        <?php foreach ($show_ubicaciones as $ubic ) : ?>
                                                                          <?php if ( $necs->ubicacion == $ubic->ubicacion ) { ?>
                                                                              <option value="<?php echo $ubic->ubicacion; ?>" selected><?php echo $ubic->ubicacion; ?></option>
                                                                          <?php } else { ?>
                                                                              <option value="<?php echo $ubic->ubicacion; ?>"><?php echo $ubic->ubicacion; ?></option>
                                                                          <?php } ?>                    
                                                                        <?php endforeach; ?>   
                                                                    </select> <br>

                                                                    <select class="input-small" id="hora_ini" name="hora_ini">
                                                                        <option>Inicia</option>
                                                                        <?php foreach ($get_horarios as $horaini ) : ?>
                                                                            <?php if ( $necs->hora_ini == $horaini->horario ) { ?>
                                                                                <option value="<?php echo $horaini->horario; ?>" selected><?php echo date("H:s",strtotime($horaini->horario)); ?></option>
                                                                            <?php } else { ?>
                                                                                <option value="<?php echo $horaini->horario; ?>"><?php echo date("H:s",strtotime($horaini->horario)); ?></option>
                                                                            <?php } ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <select class="input-small" id="hora_fin" name="hora_fin">
                                                                        <option>Termina</option>
                                                                        <?php foreach ($get_horarios as $horafin ) : ?>

                                                                            <?php if ( $necs->hora_fin == $horafin->horario ) { ?>
                                                                                <option value="<?php echo $horafin->horario; ?>" selected><?php echo date("H:s",strtotime($horafin->horario)); ?></option>
                                                                            <?php } else { ?>
                                                                                <option value="<?php echo $horafin->horario; ?>"><?php echo date("H:s",strtotime($horafin->horario)); ?></option>
                                                                            <?php } ?>
                                                                        <?php endforeach; ?>   
                                                                    </select>

                                                                    <br>
                                                                    <select class="input-sm" id="status_subact" name="status_subact">
                                                                        <option>Status</option>
                                                                        <?php 
                                                                        $status_subact = array('1' => 'Entrada Gratuita', '2' => 'Entrada Con Costo');
                                                                        foreach ($status_subact as $key => $value ) : ?>
                                                                          <?php if ( $necs->status_subact == $value ) { ?>
                                                                            <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                                                                          <?php } else { ?>
                                                                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                                                          <?php } ?>                                              
                                                                        <?php endforeach; ?>   
                                                                    </select>


                                                                    
                                                                  </div>                                  
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
                                                                  <button type="submit" class="btn btn-success"><i class="icon-ok icon-white"></i> Actualizar</button>
                                                                </div>
                                                            <?php echo form_close(); ?>
                                                          </div>

                                                   </tr>                                            
                                                
                                            <?php } ?>                                                    
                                        <?php endforeach; ?>
                                            </table>
                                        </td>
                                        <!--
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d1 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                    
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>   
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d2 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d3 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d4 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d5 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d6 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d7 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d8 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d9 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        <td>
                                            <?php foreach ($get_all as $necss ) : ?>                       
                                                <?php if ($act->d10 == $necss->fecha_taller AND $act->id_act == $necss->id_act) 
                                                { 
                                                    echo date("H:s",strtotime($necss->hora_ini));
                                                    echo " / " ;
                                                    echo $necss->subactividad;
                                                    echo "<br> (" ;
                                                    echo $necss->ubicacion;
                                                    echo ") <hr>" ;
                                                } ?>                                                
                                            <?php endforeach;   ?>
                                        </td>
                                        -->
                                    
                                    <?php } ?>
                                </tr>                        
                                <?php endforeach; ?>
                        
                        <?php } ?>
                    
                    <?php endforeach; ?>                        
                                                
                <?php endforeach; ?>
                    
                </table>
                <hr>

                
                    
                
                
                
                
            </div><!-- -->            
        </div><!-- /span12 -->        
    </div><!-- /wrapper -->    
</div><!-- /container -->