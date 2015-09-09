<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <div class="controls controls-row">
        <div class="span3">
          <li>                
            <?php $atributos = array('class' => 'navbar-form pull-left'); 
                echo form_open(base_url('actividades/filtrar_resp'), $atributos); ?>                    
                <select class="span12" name="email" id="email" onchange="this.form.submit()">
                  <option>Responsables</option>
                  <?php foreach ($get_resp as $resp ) :?>                      
                    <option value="<?php echo $resp->e_mail;?>"><?php echo $resp->e_mail;?></option>                                      
                  <?php endforeach; ?>
                </select>                
            <?php echo form_close(); ?>
          </li>
        </div>
        <div class="span3">          
          <li>                
            <?php $atributos = array('class' => 'navbar-form pull-left'); 
                echo form_open(base_url('actividades/filtrar_cedula'), $atributos); ?>                    
                <select class="span12" name="id_act" id="id_act" onchange="this.form.submit()">
                  <option>Cédulas</option>
                  <?php foreach ($get_all_actividades as $acts ) :?>                      
                    <option value="<?php echo $acts->id_act;?>"><?php echo $acts->actividad;?></option>
                  <?php endforeach; ?>
                </select>                
            <?php echo form_close(); ?>
          </li>          
        </div>
        <div class="span3">          
          <li>                
            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                Ordenar y Filtrar Cédulas:
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- dropdown menu links -->
                <li class="dropdown-header">Ordenar:</li>
                <li>
                    <a href="<?php echo base_url('actividades/ordenar_id_asc');?>" data-toggle="tooltip" title="Orden Ascendente"><span> ID: Asc - Desc </span><i class="icon-chevron-up"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_id_desc');?>" data-toggle="tooltip" title="Orden Descendente"><span> ID: Desc - Asc </span><i class="icon-chevron-down"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_act_asc');?>" data-toggle="tooltip" title="Orden Ascendente"><span> Cédula: A - Z </span><i class="icon-chevron-up"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_act_desc');?>" data-toggle="tooltip" title="Ordena Descendente"><span> Cédula: Z - A </span><i class="icon-chevron-down"></i></a>
                </li>
                <li class="dropdown-header">Filtro por Status:</li>
                <!-- dropdown menu links --> 
                <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/0');?>" data-toggle="tooltip" title=""><span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/1');?>" data-toggle="tooltip" title=""><span name="flag" id="flag" class="label label-important"><small>No Aprobado</small></span></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/2');?>" data-toggle="tooltip" title=""><span name="flag" id="flag" class="label label-success"><small>Aprobado Conceptual</small></span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/4');?>" data-toggle="tooltip" title=""><span name="flag" id="flag" class="label label-inverse"><small>Presupuesto Autorizado</small></span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/6');?>" data-toggle="tooltip" title=""><span name="flag" id="flag" class="label label-default"><small>Fuera de Presupuesto</small></span></a>
                </li>

              </ul>

            </div>
          </li>
        </div>
        <?php /* GETOR DE PRESUPUESTO.- VISTA SOLO PARA LOS ADMINISTRATIVO */
        $app = $_SESSION['username']; /** Cacho la sesion del usaurio **/
          switch ($app) {
              case 'appcedula@app.com':     ?>
                <div class="span3">          
                  <li>                
                    <?php $atributos = array('class' => 'navbar-form pull-left'); 
                        echo form_open(base_url().'actividades/filtrar_coords', $atributos); ?>                    
                        <select name="id_coord" id="id_coord" onchange="this.form.submit()">
                          <option>Coordinaciones</option>
                          <?php foreach ($get_all_coords as $coords ) :?>                      
                            <option value="<?php echo $coords->id_coord;?>"><?php echo $coords->coordinacion;?></option>
                          <?php endforeach; ?>
                        </select>
                        
                    <?php echo form_close(); ?>
                  </li>
                  </div>
                <?php break;
              default:                                            
                break; 
            } 
        ?>
                
        </div>
      </ul>      
  </div>  
</div>
