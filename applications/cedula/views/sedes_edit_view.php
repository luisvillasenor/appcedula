<div class="container-fluid">
    <div id="wrapper" class="row-fluid">

        <div class="span2 sidebar-nav">
        <!--Body content-->
            <?php include 'include/nav_gestiones.php';  ?>
        </div><!-Body content-->

        <div class="row-fluid span10 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Actualizar Sede</h2>
            </div>
            
            <div class="">
              <?php echo form_open('sedes/update'); ?>
                  <input name="id_sede" id="id_sede" type="hidden" value="<?php echo $id_sede;?>">
                  <table class="table table-bordered">            
                    <td>
                      <label>Sede</label>
                        <input class="input-xxlarge" name="sede" id="sede" type="text" value="<?php echo $sede;?>">
                    </td>        
                    <td>                
                        <label>Municipio donde se ubica la Sede</label>
                        <select class="inline" id="id_mun" name="id_mun">
                          <?php foreach ($show_municipios as $mun ) : ?>
                            <?php if ( $mun->id_mun == $id_mun ) { ?>
                              <option value="<?php echo $mun->id_mun;?>" selected><?php echo $mun->municipio;?></option>                              
                            <?php } else { ?>
                              <option value="<?php echo $mun->id_mun;?>"><?php echo $mun->municipio;?></option>
                          <?php } endforeach; ?>
                        </select>
                    </td>
                    <td>
                      <label>Salvar datos Sede</label>
                      <button type="submit" class="btn btn-success">Actualizar</button>
                    </td>            
                   </table>
                   <a href="<?php echo base_url('sedes/show');?>" class="btn btn-success">Regresar &raquo;</a>
                   
              <?php echo form_close(); ?>
              
            </div>
        </div><!— /row span8 —>

        
    </div>
</div><!— /container —>