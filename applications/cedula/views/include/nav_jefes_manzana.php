<div class="hero-unit span3">
  <!--Body content-->
  <div id="almacen" class="collapse in"> 
    <ul class="nav nav-list">
      <li class="nav-header">Jefes de Manzana</li>
      <li>
      	<?php 
      		echo form_open('jefes_manzana/buscar_jm'); 
      		echo form_input('jefe_manzana');
      		echo form_submit('mysubmit', 'Buscar!');
      		echo form_close();
      	?>
      </li>      
      <li><a href="export_jm">Exportar</a></li>      
    </ul>
  </div>        
</div><!— /span4 —>