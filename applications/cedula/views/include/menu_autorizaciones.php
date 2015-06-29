<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav">
      <li>
          <a href="<?php echo base_url();?>solicitud/detalle_bienesoservicios_pendientes_view"><i class="icon-home"></i> Refrescar Lista &raquo;</a>
        </li>            
      </ul>
      <ul class="nav pull-right">  
        <li class="dropdown">  
          <a class="dropdown-toggle" data-toggle="dropdown">  
            Bienvenido <strong><?php echo $onlyusername; ?></strong>                                
                    <i class="icon-user"></i>
                    <span class="caret"></span>                
          </a>  
          <ul class="dropdown-menu"> 
            <!-- dropdown menu links -->                                  
            <li>
          <a href="<?php echo base_url();?>solicitud/detalle_bienesoservicios_pendientes_view"><i class="icon-home"></i> Refrescar Lista &raquo;</a>
        </li>
            <li><a data-toggle="modal" href="<?php echo base_url();?>admin/logout"><i class="icon-off"></i> Salir del Sistema &raquo;</a></li>            
          </ul>
        </li>
      </ul>  
  </div>  
</div>