<div class="hero-unit span3">
  <!--Body content-->
  <div id="almacen" class="collapse in"> 
    <ul class="nav nav-list">
      <li class="nav-header">Responsables de Zona</li>
      <li>
      	<?php 
      		echo form_open('resp_zona/buscar_rz'); 
      		echo form_input('resp_zona');
      		echo form_submit('mysubmit', 'Buscar!');
      		echo form_close();
      	?>
      </li>      
      <li><a href="export_rz">Exportar</a></li>      
    </ul>
  </div>        
</div><!— /span4 —>