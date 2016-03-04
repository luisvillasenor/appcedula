
<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
      <?php include 'include/nav_subactividades.php';   ?>      
        
    
    <div class="row-fluid span10 control-group warning">              
    <!--Body content-->
      
        
        <div class="well well-small text-center">
          <h2>Subactividades del Festival de Calaveras <?php echo $anioTrabajo;?></h2>
        </div>
        <!--
        <div class="offset8">
            
            <a class="btn btn-success" href="<?php echo base_url('subactividades/new_subact');?>">Agregar subactividad</a>
            
            <a>
              <?php $atributos = array('class' => 'navbar-form pull-left','name' => 'agregasubactform'); 
                  echo form_open(base_url('subactividades/show'), $atributos); ?>                    
                  <select class="span12" name="sede" id="sede" onchange="agregasubactform.submit()">
                    <option>Filtrar por sede</option>
                        <?php foreach ($show_sedes as $sede ) :?>                      
                          <option value="<?php echo $sede->sede;?>"><?php echo $sede->sede;?></option>
                        <?php endforeach; ?>
                    <option value="">Todos</option>
                  </select>                
              <?php echo form_close(); ?>
            </a>
            
        </div>
        -->


          <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
              <th>Id_Sub</th>
              <th>Id_Act</th>
              <th>Fecha</th>
              <th>Inicia</th>
              <th>Termina</th>
              <th>Actividad/Taller</th>
              <th>Sede</th>
              <th>Ubicacion</th>              
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($show_subactividades as $subact) { ?>
                <tr>
                  <td><?php echo $subact->id_subact; ?></td>
                  <td><?php echo $subact->id_act; ?></td>
                  <td><?php echo $subact->fecha_taller; ?></td>
                  <td><?php echo date("H:s",strtotime($subact->hora_ini));?> hrs</td>
                  <td><?php echo date("H:s",strtotime($subact->hora_fin));?> hrs</td>
                  <td><?php echo $subact->subactividad; ?></td>
                  <td><?php echo $subact->sede; ?></td>
                  <td><?php echo $subact->ubicacion; ?><br> (</small><?php echo $subact->status_subact; ?></small>)</td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-default btn-mini dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Opciones
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><!-- Button to trigger modal -->
                            <a data-toggle="modal" href="#Editar<?php echo $subact->id_subact; ?>"><i class="icon-edit"></i> <small>Editar</small></a>
                        </li>
                        <li><!-- Button to trigger modal -->
                            <a data-toggle="modal" href="#Eliminar<?php echo $subact->id_subact; ?>"><i class="icon-remove"></i> <small>Eliminar</small></a>
                        </li>
                        <li><!-- Button to trigger modal -->
                            <a href="<?php echo base_url('subactividades/repetir');?>/<?php echo $subact->id_subact; ?>/subactividades"><i class="icon-repeat"></i> <small>Repetir</small></a>
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
                                        <input type="hidden" name="objeto" id="objeto" value="subactividades">
                                        id_subact.-<input type="text" name="id_subact" id="id_subact" value="<?php echo $subact->id_subact; ?>"><br>
                                        id_act.-<input type="text" name="id_act" id="id_act" value="<?php echo $subact->id_act; ?>"><br>
                                        subactividad.-<input type="text" name="subactividad" id="subactividad" value="<?php echo $subact->subactividad; ?>"><br>
                                        fecha_taller.-<input type="text" name="fecha_taller" id="fecha_taller" value="<?php echo $subact->fecha_taller; ?>"><br>
                                        sede.-<input type="text" name="sede" id="sede" value="<?php echo $subact->sede; ?>"><br>
                                        ubicacion.-<input type="text" name="ubicacion" id="ubicacion" value="<?php echo $subact->ubicacion; ?>"><br>
                                        hora_ini.-<input type="text" name="hora_ini" id="hora_ini" value="<?php echo $subact->hora_ini; ?>"><br>
                                        hora_fin.-<input type="text" name="hora_fin" id="hora_fin" value="<?php echo $subact->hora_fin; ?>"><br>
                                        status_subact.-<input type="text" name="status_subact" id="status_subact" value="<?php echo $subact->status_subact; ?>">
                                      </div>                                  
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
                                      <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Guardar cambios</button>
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
                                    <?php echo $subact->id_subact; ?><br>
                                    <?php echo $subact->id_act; ?><br>
                                    <?php echo $subact->subactividad; ?><br>
                                    <?php echo $subact->fecha_taller; ?><br>
                                    De las <?php echo $subact->hora_ini; ?> Hrs. a las <?php echo $subact->hora_fin; ?> Hrs.<br>
                                    <?php echo $subact->ubicacion; ?> / <?php echo $subact->sede; ?> (</small><?php echo $subact->status_subact; ?></small>)
                                  </div>
                                  
                                  <p>Se eliminara permanentemente el registro.</p>
                                  <p>¿Está seguro de eliminarlo permanentemente?</p>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Canelar</button>
                                  <a href="<?php echo base_url('subactividades/delete');?>/<?php echo $subact->id_subact; ?>/<?php echo $subact->id_act; ?>/subactividades" class="btn btn-danger"><i class="icon-trash icon-white"></i> Sí, estoy seguro</a>
                                </div>
                              </div>

            <?php } ?>
            </tbody>
          </table>

                        
          
        </div><!— /span8 —>
                        
        
    </div><!— /row-fluid —>

</div><!— /container-fluid —>


              
