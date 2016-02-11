<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Cédula de Actividad</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" />
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
  <style type="text/css">
    #subheader {
      background-color: #CCC;
      margin: auto;
      height: 20px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }
    #wrapper {
      background-color: transparent;
      margin-top: 70px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;
      
    }
  </style>
    
    <style>
table, th, td
{
border-collapse:collapse;
border:1px solid black;
}
th, td
{
padding:15px;
}
        th
{
background-color:#FE9042;
color:white;
}
</style>

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha_taller" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( "#fecha_aut" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
      });
    });      
  </script>
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>
        
        
    
    <div class="row-fluid span9 control-group warning">              
    <!--Body content-->
        
        

        
<?php foreach ($get_one_act_edit as $act ) : ?>       
<div class="well">
      <?php echo form_open(base_url('actividades/actualizar_act'),'class="form-horizontal"'); ?>
        <fieldset>
          
          <table>
            <tr>
            <th >
                <h2>DÍAS DE ACCESO AL PUBLICO EN GENERAL</h2>
                <h4><?php echo $act->actividad;?></h4>
            </th>
            
                
                <input id="id_act" name="id_act" type="hidden" value="<?php echo $act->id_act;?>">
                <input id="actividad" name="actividad" type="hidden" value="<?php echo $act->actividad;?>">
                <input id="descripcion" name="descripcion" type="hidden" value="<?php echo $act->descripcion;?>">
                <input id="justificacion" name="justificacion" type="hidden" value="<?php echo $act->justificacion;?>">
                <input id="id_categoria" name="id_categoria" type="hidden" value="<?php echo $act->id_categoria;?>">
                <input id="quienpropone" name="quienpropone" type="hidden" value="<?php echo $act->quienpropone;?>">
                <!--
                <input id="empresa" name="empresa" type="hidden" value="<?php echo $act->empresa;?>">
                <input id="puesto" name="puesto" type="hidden" value="<?php echo $act->puesto;?>">
                <input id="domicilio" name="domicilio" type="hidden" value="<?php echo $act->domicilio;?>">
                <input id="telefono" name="telefono" type="hidden" value="<?php echo $act->telefono;?>">
              -->
                <input id="email" name="email" type="hidden" value="<?php echo $act->email;?>">
              <!--
                <input id="web" name="web" type="hidden" value="<?php echo $act->web;?>">
              -->
                <input id="fecha_act" name="fecha_act" type="hidden" value="<?php echo $act->fecha_act;?>">
                <input id="fecha_aut" name="fecha_aut" type="hidden" value="<?php echo $act->fecha_aut;?>">
                <input id="costo_secture" name="costo_secture" type="hidden" value="<?php echo $act->costo_secture;?>">
                <input id="costo_publico" name="costo_publico" type="hidden" value="<?php echo $act->costo_publico;?>">
                <input id="is_costo_secture" name="is_costo_secture" type="hidden" value="<?php echo $act->is_costo_secture;?>">
                <input id="is_costo_publico" name="is_costo_publico" type="hidden" value="<?php echo $act->is_costo_publico;?>">
                <input id="id_coord" name="id_coord" type="hidden" value="<?php echo $act->id_coord;?>">
                <input id="status_act" name="status_act" type="hidden" value="<?php echo $act->status_act;?>">
                <input id="id_fc" name="id_fc" type="hidden" value="<?php echo $act->id_fc;?>">
                <input id="id_resp" name="id_resp" type="hidden" value="<?php echo $act->id_resp;?>">
                <input id="fecha_alta" name="fecha_alta" type="hidden" value="<?php echo $act->fecha_alta;?>">

                
            
            </tr>                
            <tr>
            
            <td>      
                <div class="control-group">
                

                <?php
                $fechas =  $this->config->item('fechas_oficiales_201'.$edicion); // Ver las fechas en config.php
                
                ?>

                  <?php $retVal1 = (in_array($act->d1, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[0]));?></label>
                    <?php echo form_checkbox('d1', $fechas[0], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d2, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[1]));?></label>
                    <?php echo form_checkbox('d2', $fechas[1], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d3, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[2]));?></label>
                    <?php echo form_checkbox('d3', $fechas[2], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d4, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[3]));?></label>
                    <?php echo form_checkbox('d4', $fechas[3], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d5, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[4]));?></label>
                    <?php echo form_checkbox('d5', $fechas[4], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d6, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[5]));?></label>
                    <?php echo form_checkbox('d6', $fechas[5], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d7, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[6]));?></label>
                    <?php echo form_checkbox('d7', $fechas[6], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d8, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[7]));?></label>
                    <?php echo form_checkbox('d8', $fechas[7], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d9, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[8]));?></label>
                    <?php echo form_checkbox('d9', $fechas[8], $retVal1) ; 
                  ?>
                  <?php $retVal1 = (in_array($act->d10, $fechas)) ? true : false ; ?>
                    <label class="checkbox inline"><?php echo date("d M",strtotime($fechas[9]));?></label>
                    <?php echo form_checkbox('d10', $fechas[9], $retVal1) ; 
                  ?>


              </div>
                                
                <!--                
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Se ABRE a las </label>
                    <div class="controls">
                      <select class="span4" id="hora_ini" name="hora_ini">
                          <?php foreach ($get_horarios as $hora ) : 
                            if($act->hora_ini == $hora->horario){ ?>
                                <option value="<?php echo $hora->horario; ?>" selected><?php echo $hora->horario; ?></option>                                
                            <?php } else { ?>
                                <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
                            <?php } ?>
                          <?php endforeach; ?>   
                      </select>                
                    </div><p>
                    <label class="control-label" for="inputEmail">Se CIERRA a las </label>
                    <div class="controls">
                      <select class="span4" id="hora_fin" name="hora_fin">
                          <?php foreach ($get_horarios as $hora ) : 
                            if($act->hora_fin == $hora->horario){ ?>
                                <option value="<?php echo $hora->horario; ?>" selected><?php echo $hora->horario; ?></option>                                
                            <?php } else { ?>
                                <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
                            <?php } ?>
                          <?php endforeach; ?>   
                        </select>                
                    </div>
                </div>
                -->
                
            </td>
            </tr>
            
            <td>                
                <label>Sede / Ubicación <input class="input-large" id="sede" name="sede" type="text" value="<?php echo $act->sede;?>"> / <input class="input-large" id="ubicacion" name="ubicacion" type="text" value="<?php echo $act->ubicacion;?>"> <button type="submit" class="btn btn-primary">Actualizar Días de Acceso</button>  </label>
            </td>
           </table>
        </fieldset>
      <?php echo form_close(); ?>
 </div>   
<?php endforeach; ?>
  
    <div class="well">
      <div class="text-center">
        <?php echo form_open(base_url('subactividades/add'),'class=""'); ?>
              <input type="hidden" name="objeto" id="objeto" value="actividades">
              <input type="hidden" name="id_act" id="id_act" value="<?php echo $id_act;?>">
              <input class="input-xxlarge" id="subactividad" name="subactividad" type="text" placeholder="Nombre de la actividad ó taller"><br>
              <input type="text" name="fecha_taller" id="fecha_taller" placeholder="Fecha">
              
              <select class="input-small" id="hora_ini" name="hora_ini">
                  <option>Inicia</option>
                  <?php foreach ($get_horarios as $hora ) : ?>
                    <option value="<?php echo $hora->horario; ?>"><?php echo date("H:s",strtotime($hora->horario)); ?></option>
                  <?php endforeach; ?>   
              </select>
              <select class="input-small" id="hora_fin" name="hora_fin">
                  <option>Termina</option>
                  <?php foreach ($get_horarios as $hora ) : ?>
                    <option value="<?php echo $hora->horario; ?>"><?php echo date("H:s",strtotime($hora->horario)); ?></option>
                  <?php endforeach; ?>   
              </select>
              <select class="input-md" id="ubicacion" name="ubicacion">
                  <option>Ubicacion</option>
                  <?php foreach ($show_ubicaciones as $ubic ) : ?>
                    <option value="<?php echo $ubic->ubicacion; ?>"><?php echo $ubic->ubicacion; ?></option>
                  <?php endforeach; ?>   
              </select>
              <select class="input-md" id="sede" name="sede">
                  <option>Sede</option>
                  <?php foreach ($show_sedes as $sede ) : ?>
                    <option value="<?php echo $sede->sede; ?>"><?php echo $sede->sede; ?></option>
                  <?php endforeach; ?>   
              </select>
              <select class="input-small" id="status_subact" name="status_subact">
                  <option>Status</option>
                  <?php 
                  $status_subact = array('1' => 'Entrada Gratuita', '2' => 'Entrada Con Costo');
                  foreach ($status_subact as $key => $value ) : ?>
                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                  <?php endforeach; ?>   
              </select>
              <button type="submit" class="btn btn-success">Agregar Nueva Actividad/Taller al Programa Detallado</button>
        <?php echo form_close(); ?>

        <div class="well"><h3 class="text-center">Programa Detallado de Actividades/Talleres</h3>
          <table class="table table-condensed">
            <tr>
              <th>Fecha</th>
              <th>Inicia</th>
              <th>Termina</th>
              <th>Actividad/Taller</th>
              <th>Ubicacion</th>
              <th>Sede</th>
              <th></th>
            </tr>
            <?php foreach ($show_subactividades as $subact) { ?>
                <tr>
                  <td><?php echo $subact->fecha_taller; ?></td>
                  <td><?php echo date("H:s",strtotime($subact->hora_ini));?> hrs</td>
                  <td><?php echo date("H:s",strtotime($subact->hora_fin));?> hrs</td>
                  <td><?php echo $subact->subactividad; ?></td>
                  <td><?php echo $subact->ubicacion; ?><br> (</small><?php echo $subact->status_subact; ?></small>)</td>
                  <td><?php echo $subact->sede; ?><br> (</small><?php echo $subact->status_subact; ?></small>)</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Opciones
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><!-- Button to trigger modal -->
                            <a data-toggle="modal" href="#Editar<?php echo $subact->id_subact; ?>">Editar</a>
                        </li>
                        <li><!-- Button to trigger modal -->
                            <a data-toggle="modal" href="#Eliminar<?php echo $subact->id_subact; ?>">Eliminar</a>
                        </li>
                        <li><!-- Button to trigger modal -->
                            <a href="<?php echo base_url('subactividades/repetir');?>/<?php echo $subact->id_subact; ?>/actividades">Repetir</a>
                        </li>
                        
                      </ul>
                    </div>
                  </td>
                </tr>              
                              <!-- Modal Editar -->
                              <div id="Editar<?php echo $subact->id_subact; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h3 id="myModalLabel">Actualiza Actividad/Taller</h3>
                                </div>
                                <?php echo form_open(base_url('subactividades/update'),'class=""'); ?>
                                    <div class="modal-body">
                                      <div class="well">
                                        <input type="hidden" name="objeto" id="objeto" value="actividades">
                                        <input type="text" name="id_subact" id="id_subact" value="<?php echo $subact->id_subact; ?>">
                                        <input type="text" name="id_act" id="id_act" value="<?php echo $subact->id_act; ?>">
                                        <input type="text" name="subactividad" id="subactividad" value="<?php echo $subact->subactividad; ?>">
                                        <input type="text" name="fecha_taller" id="fecha_taller" value="<?php echo $subact->fecha_taller; ?>">
                                        <input type="text" name="sede" id="sede" value="<?php echo $subact->sede; ?>">
                                        <input type="text" name="ubicacion" id="ubicacion" value="<?php echo $subact->ubicacion; ?>">
                                        <input type="text" name="hora_ini" id="hora_ini" value="<?php echo $subact->hora_ini; ?>">
                                        <input type="text" name="hora_fin" id="hora_fin" value="<?php echo $subact->hora_fin; ?>">
                                        <input type="text" name="status_subact" id="status_subact" value="<?php echo $subact->status_subact; ?>">                                        
                                      </div>                                  
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                                      <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                <?php echo form_close(); ?>
                              </div>
                              <!-- Modal Eliminar-->
                              <div id="Eliminar<?php echo $subact->id_subact; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h3 id="myModalLabel">Eliminar Actividad/Taller del Programa</h3>
                                </div>
                                <div class="modal-body">
                                  <div class="well">                                    
                                    <?php echo $subact->subactividad; ?><br>
                                    <?php echo $subact->fecha_taller; ?><br>
                                    De las <?php echo $subact->hora_ini; ?> Hrs. a las <?php echo $subact->hora_fin; ?> Hrs.<br>
                                    <?php echo $subact->ubicacion; ?> / <?php echo $subact->sede; ?> (</small><?php echo $subact->status_subact; ?></small>)
                                  </div>
                                  
                                  <p>Se eliminara permanentemente el registro.</p>
                                  <p>¿Está seguro de eliminarlo permanentemente?</p>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn" data-dismiss="modal" aria-hidden="true">Canelar</button>
                                  <a href="<?php echo base_url('subactividades/delete');?>/<?php echo $subact->id_subact; ?>/<?php echo $subact->id_act; ?>/actividades" class="btn btn-danger">Sí, estoy seguro</a>
                                </div>
                              </div>
            <?php } ?>
            
          </table>            
        </div><!— /row span12 —>


      </div>
    </div><!— /row span12 —>
  
  </div>   
</div><!— /container —>


<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-button.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-modal.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-popover.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-typeahead.js"></script>
</body>
</html>