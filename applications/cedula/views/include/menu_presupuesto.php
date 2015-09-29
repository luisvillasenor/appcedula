<header>
<div class="navbar navbar-fixed-top navbar-default">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <li>
          <a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home navbar-icon-home"></i>
            <?php foreach ($get_fc as $fc) {
              if ($fc->id_fc === $edicion) {
                echo $fc->edicion ." (".$fc->anio.")";
              }
            } ?>
          </a>
        </li>
        <li>                
            
        </li>          
      </ul>      
      <ul class="nav pull-right">  
        <li><a><i class="icon-user"></i> <strong><?php echo $onlyusername; ?></strong></a></li>
        <li><a class="active" href="<?php echo base_url('admin/logout');?>"><i class="icon-off"></i> Salir</a></li>
      </ul>
  </div>  
  <div id="subheader">Esta como <STRONG>administrador de presupuesto</STRONG>, por favor sea cuidadoso.</div>
</div>
</header>