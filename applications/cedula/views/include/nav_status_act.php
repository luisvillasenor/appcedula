<?php switch ($actividades->status_act) {
      case '1':?>
        <td><span name="flag" id="flag" class="label label-important"><small>No Aprobado</small></span></td>
<?php break;
      case '2':?>
        <td><span name="flag" id="flag" class="label label-success"><small>Aprobado Conceptual</small></span></td>
<?php break;
    case '3':?>
        <td><span name="flag" id="flag" class="label label-info"><small>Integrado al Programa General</small></span></td>
<?php break;
    case '4':?>
        <td>
          <?php if ( $actividades->pres_eje < 0 ) { ?>
          <span name="flag" id="flag" class="label label-inverse"><small>Presupuesto AUTORIZADO</small><br>
            <?php if ($actividades->pres_aut == 0) { ?>
              <span class="label label-warning">$ <?php echo number_format($actividades->pres_aut,2,".",",");?></span>
            <?php } else {?>
              <span>$ <?php echo number_format($actividades->pres_aut,2,".",",");?></span>
            <?php } ?>            
          </span><br>
          <span id="flag" class="label label-important"><small>[AUTORIZADO vs PLANEADO]</small><br>$ <?php echo number_format($actividades->pres_eje,2,".",",");?></span>
          <span id="flag" class="label label-inverse"><small>Presupuesto EJERCIDO</small><br>$ <?php echo number_format($actividades->pres_gas,2,".",",");?></span>
          
              <?php
                if ( $actividades->pres_aut-$actividades->pres_gas < 0 ) { ?>
                  <span id="flag" class="label label-important">SALDO: $ <?php echo number_format($actividades->pres_aut-$actividades->pres_gas,2,".",",");?></span>
              <?php } else { ?>
                  <span id="flag" class="label label-success">SALDO: $ <?php echo number_format($actividades->pres_aut-$actividades->pres_gas,2,".",",");?></span>
              <?php } ?>

          
          <?php }else{ ?>
          <span name="flag" id="flag" class="label label-inverse"><small>Presupuesto AUTORIZADO</small><br>
            <?php if ($actividades->pres_aut == 0) { ?>
              <span class="label label-warning">$ <?php echo number_format($actividades->pres_aut,2,".",",");?></span>
            <?php } else {?>
              <span>$ <?php echo number_format($actividades->pres_aut,2,".",",");?></span>
            <?php } ?>            
          </span><br>
          <span id="flag" class="label label-inverse"><small>Presupuesto EJERCIDO</small><br>$ <?php echo number_format($actividades->pres_gas,2,".",",");?></span>

          
              <?php
                if ( $actividades->pres_aut-$actividades->pres_gas < 0 ) { ?>
                  <span id="flag" class="label label-important">SALDO: $ <?php echo number_format($actividades->pres_aut-$actividades->pres_gas,2,".",",");?></span>
              <?php } else { ?>
                  <span id="flag" class="label label-success">SALDO: $ <?php echo number_format($actividades->pres_aut-$actividades->pres_gas,2,".",",");?></span>
              <?php } ?>

          
          
          <?php } ?>
        </td>
<?php break;
    case '5':?>
        <td><span name="flag" id="flag" class="label"><i class="icon-lock"></i><small> Bloqueada</small></span></td>
<?php break;
    case '6':?>
        <td><span name="flag" id="flag" class="label label-default"><small>Fuera de Presupuesto</small></span></td>
<?php break;
      default: ?>
        <td><span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span></td>
<?php break;
      } ?>

