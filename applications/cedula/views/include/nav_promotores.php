<div class="hero-unit span3">
  <!--Body content-->
  <div id="almacen" class="collapse in"> 
    <ul class="nav nav-list">
      <li class="nav-header">Promotores</li>
      <li>
      	<?php 
      		echo form_open('promotores/buscar_pr'); 
      		echo form_input('promotor');
      		echo form_submit('mysubmit', 'Buscar!');
      		echo form_close();
      	?>
      </li>      
      <li><a href="export_promovidos">Exportar</a></li>      
    </ul>
  </div>    
</div><!— /span4 —>