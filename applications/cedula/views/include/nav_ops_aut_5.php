<table class="table table-bordered">
    <?php foreach ($get_one_act_edit as $actividades ) : ?>
        <span class="label label-info">
            <h2>BALANCE FINANCIERO <small>(Cédula - <?php echo $actividades->id_act;?>)</small></h2>
        </span>
        <tr>                
          <th>Presupuesto año anterior</th>
          <th>Presupuesto SOLICITADO</th>
          <th>Presupuesto AUTORIZADO</th>
          <th>Presupuesto RESULTADO</th>
        </tr>
        <tr>        
            <td><span class="add-on">$</span><?php echo number_format($actividades->pres_ant,2,".",",");?></td>
            <td>
                <span class="add-on">$</span><?php 
                  foreach ($get_total_act as $tot ) : 
                      echo number_format($tot->tot_tot,2,".",",");
                  endforeach;
                ?>
            </td>
            <td><span class="add-on">$</span><?php echo number_format($actividades->pres_aut,2,".",",");?></td>
            <td><span class="add-on">$</span><?php echo number_format($actividades->pres_eje,2,".",",");?></td>
        </tr>
    <?php endforeach; ?>
</table>