<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <div class="span2 sidebar-nav">
        <!--Body content-->
            <?php include 'include/nav_gestiones.php';  ?>
        </div><!-Body content-->
        <div class="row-fluid span10 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Agrega Nueva ubicacion</h2>
            </div>
            
            <div class="">
              <?php echo form_open('ubicaciones/add'); ?>
                  <table class="table table-bordered">            
                    <td>
                      <label>Escriba aquí la ubicacion, P.ej.- Explanada del Lago</label>
                        <input class="input-xlarge" name="ubicacion" id="ubicacion" type="text" placeholder="">
                    </td>
                    <td>                
                        <label>Seleccione Sede</label>
                        <select class="inline" id="id_sede" name="id_sede">
                          <?php foreach ($show_sedes as $sede ) : ?>
                            <option value="<?php echo $sede->id_sede;?>"><?php echo $sede->sede;?></option>                  
                          <?php endforeach; ?>
                        </select>
                    </td>
                    <td>                
                        <label>Seleccione Municipio</label>
                        <select class="inline" id="id_mun" name="id_mun">
                          <?php foreach ($show_municipios as $mun ) : ?>
                            <option value="<?php echo $mun->id_mun;?>"><?php echo $mun->municipio;?></option>                  
                          <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                      <label>Salvar datos ubicacion</label>
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </td>
                   </table>
                   <a href="<?php echo base_url('ubicaciones/show');?>" class="btn btn-success">Regresar &raquo;</a>
                   
              <?php echo form_close(); ?>
              
            </div>
          
        </div><!— /row span8 —>
    </div>
</div><!— /container —>