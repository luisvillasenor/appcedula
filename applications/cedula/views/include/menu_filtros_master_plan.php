
<div class="navbar">  
  <div class="navbar-inner">
      <a class="brand">Filtrar por: </a>
      <ul class="nav">  
        <div class="controls controls-row">
            <div class="span4">
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url().'actividades/filtrar_master_plan_coord', $atributos); ?>                    
                    <select name="id_coord" id="id_coord" onchange="this.form.submit()">
                      <option>Coordinaciones</option>
                      <?php foreach ($get_all_coords as $coords ) :?>                      
                        <option value="<?php echo $coords->id_coord;?>"><?php echo $coords->coordinacion;?></option>
                      <?php endforeach; ?>
                    </select>
                    
                <?php echo form_close(); ?>
              </li>
            </div>
            <div class="span4">          
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/filtrar_master_plan_categoria'), $atributos); ?>                    
                    <select name="id_categoria" id="id_categoria" onchange="this.form.submit()">
                      <option>Categorías</option>
                      <?php foreach ($get_all_cats as $cats ) :?>                      
                        <option value="<?php echo $cats->id_categoria;?>"><?php echo $cats->categoria;?></option>
                      <?php endforeach; ?>
                    </select>                    
                <?php echo form_close(); ?>
              </li>          
            </div>
            <div class="span4">          
              <li>
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url().'actividades/filtrar_master_plan_cedula', $atributos); ?>                    
                    <select name="id_act" id="id_act" onchange="this.form.submit()">
                      <option>Cédula</option>
                      <?php foreach ($get_master_plan as $master ) :?>                      
                        <option value="<?php echo $master->id_act;?>"><?php echo $master->actividad;?></option>
                      <?php endforeach; ?>
                    </select>
                <?php echo form_close(); ?>
              </li>          
            </div>
        </div>
      </ul>      
  </div>  

</div>