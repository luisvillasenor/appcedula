
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
                      <option value="todo"> --- TODAS --- </option>
                      <?php foreach ($get_all_cats as $cats ) :?>                      
                        <option value="<?php echo $cats->id_categoria;?>"><?php echo $cats->categoria;?></option>
                      <?php endforeach; ?>
                    </select>

                    <?php 
                      switch ($marca) { 
                        case '0': ?>
                          <label class="checkbox">
                            <input type="checkbox" id="marcafiltro" onchange="myFunctioncheckcontenido()"> <small>Autorizado y Libre de Ortografía</small>
                            <input type="hidden" name="marca" id="marca" value="0">
                          </label>                              
                      <?php break;
                        case '1': ?>
                          <label class="checkbox">
                            <input type="checkbox" id="marcafiltro" checked onchange="myFunctioncheckcontenido()"> <small>Autorizado y Libre de Ortografía</small>
                            <input type="hidden" name="marca" id="marca" value="1">
                          </label>                              
                      <?php break;
                      }
                    ?> 
                    <script>
                    function myFunctioncheckcontenido() {
                        var valor = document.getElementById('marcafiltro').checked;
                        if (valor == false) {
                          //document.getElementById("marca").setAttribute("checked",false);
                          document.getElementById("marca").value = '0';
                          //alert("The input value has changed. The new value is: " + "NO SELECTED");                          
                        } else if (valor == true) {
                          //document.getElementById("marca").setAttribute("checked",true);
                          document.getElementById("marca").value = '1';
                          //alert("The input value has changed. The new value is: " + "SELECTED");                          
                        };
                    }
                    </script>

                <?php echo form_close(); ?>
              </li>          
            </div>            
        </div>
      </ul>      
  </div>  

</div>