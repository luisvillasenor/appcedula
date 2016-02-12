<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <?php include 'include/nav_actividades.php';  ?>      
        <div class="row-fluid span8 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Agrega Nueva Sede</h2>
            </div>
            
            <div class="">
              <?php echo form_open('sedes/add'); ?>
                  <table class="table table-bordered">            
                    <td>
                      <label>Escriba aquí la Sede, P.ej.- Plaza de Las Tres Centurias</label>
                        <input class="input-xxlarge" name="sede" id="sede" type="text" placeholder="">
                    </td>        
                    <td>                
                        <label>Municipio donde se ubica la Sede</label>
                        <select class="inline" id="id_mun" name="id_mun">
                        <option></option>
                          <?php foreach ($show_municipios as $mun ) : ?>
                            <option value="<?php echo $mun->id_mun;?>"><?php echo $mun->municipio;?></option>                  
                          <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                      <label>Salvar datos Sede</label>
                      <button type="submit" class="btn btn-success">Guardar</button>
                    </td>
                   </table>
                   <a href="<?php echo base_url('sedes/show');?>" class="btn btn-success">Regresar &raquo;</a>
                   
              <?php echo form_close(); ?>
              
            </div>
          
        </div><!— /row span8 —>
    </div>
</div><!— /container —>