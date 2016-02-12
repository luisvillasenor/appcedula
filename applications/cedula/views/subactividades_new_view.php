<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <?php include 'include/nav_actividades.php';  ?>      
        <div class="row-fluid span8 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Agrega Nueva Subactividad/Taller</h2>
            </div>
            
            <div class="">
              <?php echo form_open(base_url('subactividades/add'),'class=""'); ?>
                  <input type="text" name="objeto" id="objeto" value="subactividades">
                  <input type="text" name="id_act" id="id_act">
                  <input class="input-xxlarge" id="subactividad" name="subactividad" type="text" placeholder="Nombre de la actividad ó taller"><br>
                  <input type="text" name="fecha_taller" id="fecha_taller" placeholder="Fecha">              
                  <select class="input-small" id="hora_ini" name="hora_ini">
                      <option>Inicia</option>
                      <?php foreach ($get_horarios as $hora ) : ?>
                        <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
                      <?php endforeach; ?>   
                  </select>
                  <select class="input-small" id="hora_fin" name="hora_fin">
                      <option>Termina</option>
                      <?php foreach ($get_horarios as $hora ) : ?>
                        <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
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
              
            </div>
          
        </div><!— /row span8 —>
    </div>
</div><!— /container —>