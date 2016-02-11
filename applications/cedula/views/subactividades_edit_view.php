<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <?php include 'include/nav_actividades.php';  ?>      
        <div class="row-fluid span8 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Actualizar subactividad</h2>
            </div>
            
            <div class="">
              <?php echo form_open('subactividades/update'); ?>
                  <input name="objeto" id="objeto" type="text" value="subactividades">
                  <input name="id_subact" id="id_subact" type="text" value="<?php echo $id_subact;?>">
                  <input name="subactividad" id="subactividad" type="text" value="<?php echo $subactividad;?>">
                  <input name="id_act" id="id_act" type="text" value="<?php echo $id_act;?>">
                  <input name="fecha_taller" id="fecha_taller" type="text" value="<?php echo $fecha_taller;?>">
                  <input name="sede" id="sede" type="text" value="<?php echo $sede;?>">
                  <input name="ubicacion" id="ubicacion" type="text" value="<?php echo $ubicacion;?>">
                  <input name="hora_ini" id="hora_ini" type="text" value="<?php echo $hora_ini;?>">
                  <input name="hora_fin" id="hora_fin" type="text" value="<?php echo $hora_fin;?>">
                  <input name="status_subact" id="status_subact" type="text" value="<?php echo $status_subact;?>">
                  <button type="submit" class="btn btn-success">Actualizar</button>
                  <a href="<?php echo base_url('subactividades/show');?>" class="btn btn-success">Regresar &raquo;</a>                   
              <?php echo form_close(); ?>              
            </div>
          
        </div><!— /row span8 —>
    </div>
</div><!— /container —>