
<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
      <?php include 'include/nav_actividades.php';   ?>      
        
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
      
        
        <div class="well text-center">
        <h2>Ubicaciones en el Festival de Calaveras</h2>

        </div>
        <div class="offset8">
            
            <a class="btn btn-success" href="<?php echo base_url('ubicaciones/new_ubic');?>">Agregar Ubicacion</a>
            <a>
              <?php $atributos = array('class' => 'navbar-form pull-left'); 
                  echo form_open(base_url('ubicaciones/show'), $atributos); ?>                    
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
                <th>ubicaciones encontradas: <span class="label label-inverse"><?php echo $numero_registros;?></span></th>                
              </tr>  
            </thead>
            <tbody>
              <?php foreach ($show_ubicaciones as $ubic ) : ?>
                  <tr>
                      <td>
                      <span><a href="<?php echo base_url('ubicaciones/edit_ubic');?>/<?php echo $ubic->id_ubic;?>" data-toggle="tooltip" title="Editar"><i class="icon-pencil"></i></a></span>
                      </td>
                      <td><?php echo $ubic->ubicacion;?>
                        <small>(
                        <?php 
                          foreach ($show_sedes as $sede) {
                            if ( $sede->id_mun == $ubic->id_sede ) {
                              echo $sede->sede;
                              break;
                            }
                          }                          
                        ?>
                        )</small>
                        <small>(
                        <?php 
                          foreach ($show_municipios as $mun) {
                            if ( $mun->id_mun == $ubic->id_mun ) {
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


              
