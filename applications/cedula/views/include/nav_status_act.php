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
        <td><span name="flag" id="flag" class="label label-inverse"><small>Presupuesto Autorizado</small></span></td>
<?php break;
    case '5':?>
        <td><span name="flag" id="flag" class="label"><i class="icon-lock"></i></span></td>
<?php break;
      default: ?>
        <td><span name="flag" id="flag" class="label label-warning"><small>Pendiente</small></span></td>
<?php break;
      } ?>

