<div class="navbar">
  <div class="navbar-inner">
      <ul class="nav">
        <div class="controls controls-row">
            <div class="">
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/filtrar_resp'), $atributos); ?>                    
                    <select class="span12" name="email" id="email" onchange="this.form.submit()">
                      <option>RESPONSABLES DE CEDULAS</option>
                      <?php foreach ($get_resp as $resp ) :?>                      
                        <option value="<?php echo $resp->e_mail;?>"><?php echo $resp->e_mail;?></option>                                      
                      <?php endforeach; ?>
                    </select>                
                <?php echo form_close(); ?>
              </li>
            </div>
            
        </div>
      </ul>      
  </div>  
</div>
