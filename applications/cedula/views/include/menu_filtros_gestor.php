<?php if ( isset($edicion) == TRUE && ( ! is_numeric($edicion)) ) { ?>

<?php }else{ ?>
<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <div class="controls controls-row">
        <div class="span4">
          <li>                
            <div class="btn-group">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                Ordenar y Filtrar Cédulas:
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- dropdown menu links -->
                <li class="dropdown-header">Ordenar:</li>
                <li>
                    <a href="<?php echo base_url('actividades/ordenar_id_asc');?>" data-toggle="tooltip" title="Orden Ascendente"><span> ID: Asc - Desc </span><i class="icon-chevron-up"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_id_desc');?>" data-toggle="tooltip" title="Orden Descendente"><span> ID: Desc - Asc </span><i class="icon-chevron-down"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_act_asc');?>" data-toggle="tooltip" title="Orden Ascendente"><span> Cédula: A - Z </span><i class="icon-chevron-up"></i></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/ordenar_act_desc');?>" data-toggle="tooltip" title="Ordena Descendente"><span> Cédula: Z - A </span><i class="icon-chevron-down"></i></a>
                </li>
                <li class="dropdown-header">Filtro por Status:</li>
                <!-- dropdown menu links --> 
                <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/0');?>" data-toggle="tooltip" title="Orden Ascendente"><span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/1');?>" data-toggle="tooltip" title="Orden Ascendente"><span name="flag" id="flag" class="label label-important"><small>No Aprobado</small></span></a>
                </li>
                  <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/2');?>" data-toggle="tooltip" title="Orden Ascendente"><span name="flag" id="flag" class="label label-success"><small>Aprobado Conceptual</small></span></a>
                </li>
                <li>
                    <a href="<?php echo base_url('actividades/filtrar_status/4');?>" data-toggle="tooltip" title="Orden Ascendente"><span name="flag" id="flag" class="label label-inverse"><small>Presupuesto Autorizado</small></span></a>
                </li>

              </ul>

            </div>
          </li>
        </div>
        </div>
      </ul>      
  </div>  
</div>

<?php } ?>

