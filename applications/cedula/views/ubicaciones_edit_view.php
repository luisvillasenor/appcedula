<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <div class="span2 sidebar-nav">
        <!--Body content-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('sedes/index');?>" ><span><small>SEDES</small></span></a></li>
                <li><a href="<?php echo base_url('ubicaciones/index');?>" ><span><small>UBICACIONES</small></span> </a></li>      
                <li><a href="<?php echo base_url('subactividades/index');?>"><span><small>SUBACTIVIDADES</small></span></a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
        </div><!-Body content-->
        <div class="row-fluid span10 control-group info">              
        <!--Body content-->
            <div class="well text-center">
              <h2>Actualizar ubicacion</h2>
            </div>
            
            <div class="">
              <?php echo form_open('ubicaciones/update'); ?>
                  <input name="id_ubic" id="id_ubic" type="hidden" value="<?php echo $id_ubic;?>">
                  <table class="table table-bordered">            
                    <td>
                      <label>ubicacion</label>
                        <input class="input-xxlarge" name="ubicacion" id="ubicacion" type="text" value="<?php echo $ubicacion;?>">
                    </td>
                    <td>                
                        <label>Sede donde pertenece la ubicacion</label>
                        <select class="inline" id="id_sede" name="id_sede">
                          <?php foreach ($show_sedes as $sede ) : ?>
                            <?php if ( $sede->id_sede == $id_sede ) { ?>
                              <option value="<?php echo $sede->id_sede;?>" selected><?php echo $sede->sede;?></option>                              
                            <?php } else { ?>
                              <option value="<?php echo $sede->id_sede;?>"><?php echo $sede->sede;?></option>
                          <?php } endforeach; ?>
                        </select>
                    </td>
                    <td>                
                        <label>Municipio donde se ubica la ubicacion</label>
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
                      <label>Salvar datos ubicacion</label>
                      <button type="submit" class="btn btn-success">Actualizar</button>
                    </td>            
                   </table>
                   <a href="<?php echo base_url('ubicaciones/show');?>" class="btn btn-success">Regresar &raquo;</a>
                   
              <?php echo form_close(); ?>
              
            </div>
          
        </div><!— /row span8 —>
    </div>
</div><!— /container —>