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
        
    
        <div class="row-fluid span10 control-group warning">              
        <!--Body content span8-->
            <div class="well text-center">
            <h2>Sedes del Festival de Calaveras <?php echo $anioTrabajo;?></h2>

            </div>
            <div class="offset8">
                
                <a class="btn btn-success" href="<?php echo base_url('sedes/new_sede');?>">Agregar Sede</a>
                <a>
                  <?php $atributos = array('class' => 'navbar-form pull-left'); 
                      echo form_open(base_url('sedes/show'), $atributos); ?>                    
                      <select class="span12" name="id_mun" id="id_mun" onchange="this.form.submit()">
                        <option>Filtrar por Municipio</option>
                        <?php foreach ($show_municipios as $mun ) :?>                      
                          <option value="<?php echo $mun->id_mun;?>"><?php echo $mun->municipio;?></option>
                        <?php endforeach; ?>
                        <option value="">Todos</option>
                      </select>                
                  <?php echo form_close(); ?>
                </a>
            </div>


              <table class="table table-bordered">              
                <thead>
                  <tr>
                    <th></th>
                    <th>Sedes encontradas: <span class="label label-inverse"><?php echo $numero_registros;?></span></th>                
                  </tr>  
                </thead>
                <tbody>
                  <?php foreach ($show_sedes as $sede ) : ?>
                      <tr>
                          <td>
                          <span><a href="<?php echo base_url('sedes/edit_sede');?>/<?php echo $sede->id_sede;?>" data-toggle="tooltip" title="Editar"><i class="icon-pencil"></i></a></span>
                          </td>
                          <td><?php echo $sede->sede;?>
                            <small>(
                            <?php 
                              foreach ($show_municipios as $mun) {
                                if ( $mun->id_mun == $sede->id_mun ) {
                                  echo $mun->municipio;
                                  break;
                                }
                              }                          
                            ?>
                            )</small>
                          </td>
                          
                      </tr>              
                  <?php endforeach; ?>            

                </tbody>
              </table>
        </div><!— /span8 —>
        
        
        
    </div><!— /row-fluid —>

</div><!— /container-fluid —>


              
