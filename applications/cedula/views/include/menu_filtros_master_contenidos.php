
<div class="navbar">  
  <div class="navbar-inner">
      <a class="brand">Filtrar por: </a>
      <ul class="nav">  
        <div class="controls controls-row">
            <div class="span4">          
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/master_contenidos'), $atributos); ?>                    
                    <select name="id_categoria" id="id_categoria" onchange="this.form.submit()">
                      <option>Categorías</option>
                      <?php foreach ($get_all_cats as $cats ) :?>                      
                        <option value="<?php echo $cats->id_categoria;?>"><?php echo $cats->categoria;?></option>
                      <?php endforeach; ?>
                    </select>                    
                <?php echo form_close(); ?>
              </li>          
            </div>            
        </div>
      </ul>      
  </div>  

</div>