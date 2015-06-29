
<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <div class="controls controls-row">
        <div class="span6">          
          <li>                
            <?php $atributos = array('class' => 'navbar-form pull-left'); 
                echo form_open(base_url('actividades/filtrar_resumen_cedula'), $atributos); ?>                    
                <select name="id_act" id="id_act" onchange="this.form.submit()">
                  <option>Cédulas</option>
                  <?php foreach ($get_all_actividades as $acts ) :?>                      
                    <option value="<?php echo $acts->id_act;?>"><?php echo $acts->actividad;?></option>                                      
                  <?php endforeach; ?>
                </select>
                
            <?php echo form_close(); ?>
          </li>          
        </div>
        
        
        </div>
        
        
      </ul>      
  </div>  
  
</div>
