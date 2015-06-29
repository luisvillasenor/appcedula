<div class="hero-unit span3">
  <!--Body content-->
  <div id="almacen" class="collapse in"> 
    <ul class="nav nav-list">
      <li class="nav-header">Coordinadores</li>
      <li>
      	<?php 
      		echo form_open('coordinadores/buscar_co'); 
      		echo form_input('coordinador');
      		echo form_submit('mysubmit', 'Buscar!');
      		echo form_close();
      	?>
      </li>      
    </ul>
  </div>        
</div><!— /span4 —>