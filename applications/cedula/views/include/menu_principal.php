<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav pull-left">  
        <li>
          <a href="<?php echo base_url();?>solicitud/solicitudes_view"><i class="icon-home"></i> Inicio</a>
        </li>
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown"><strong>Solicitud</strong>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- dropdown menu links -->                                  
            <li><a data-toggle="modal" id="folio_agrupador" href="#example3">Agregar Nuevo &raquo;</a></li>
          </ul>     
        </li>          

        <li>
          <?php
            echo form_open('solicitud/detalle_bienesoservicios_solicitud_view');
            
            echo form_input('solicitudes_id', set_value('solicitudes_id'), 'class="search-query" name="solicitudes_id" id="solicitudes_id"');
          ?>
            
            <button type="submit" class="btn">Buscar &raquo;</button>
          <?php echo form_close(); ?>  
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