<div class="hero-unit span3">
  <!--Body content-->
  <div id="almacen" class="collapse in"> 
    <ul class="nav nav-list">
      <li class="nav-header">Responsables de Sección</li>
      <li>
      	<?php 
      		echo form_open('resp_seccion/buscar_rs'); 
      		echo form_input('resp_seccion');
      		echo form_submit('mysubmit', 'Buscar!');
      		echo form_close();
      	?>
      </li>      
      <li><a href="export_rs">Exportar</a></li>      
    </ul>
  </div>        
</div><!— /span4 —>