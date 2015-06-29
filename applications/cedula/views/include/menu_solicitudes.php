<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav">
      <li>
          <a href="<?php echo base_url();?>solicitud/solicitudes_view"><i class="icon-home"></i> Inicio</a>
        </li>
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown"><strong>Solicitudes</strong>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- dropdown menu links -->                                  
            <li><a data-toggle="modal" id="folio_agrupador" href="#example4">Agregar Nueva Solicitud &raquo;</a></li>
          </ul>     
        </li>            
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown"><strong>Catálogos</strong>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- dropdown menu links -->                                  
            <li><a data-toggle="modal" id="folio_agrupador" href="http://eservicios.aguascalientes.gob.mx/segi/servicios/Hoy_se_Compra/View/Compras/productos.asp" target="_blank">Productos Autorizados &raquo;</a></li>
            <li><a data-toggle="modal" id="folio_agrupador" href="http://eservicios.aguascalientes.gob.mx/segi/servicios/Hoy_se_Compra/View/Compras/proveedores.asp" target="_blank">Proveedores Autroizados &raquo;</a></li>
          </ul>     
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
            
            <li><a data-toggle="modal" href="<?php echo base_url();?>admin/logout"><i class="icon-off"></i> Salir del Sistema &raquo;</a></li>            
          </ul>
        </li>
      </ul>  
  </div>  
</div>