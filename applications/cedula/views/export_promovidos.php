<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=base-de-datos-promovidos.xls");
?>
<html>
<head>
	  <table border="1">
		<th>NOMBRE</th><th>SECCION</th><th>VOTO</th><th>PROMOVIDOS</th><th>REALES</th><th>CALIFICACION</th>
        		
		<?php foreach($export_promovidos as $item_mon):?>		
		<tr align="center">
            <td><?php echo $item_mon->promotor; ?></td>
			<td><?php echo $item_mon->seccion; ?></td>
			<td><?php echo $item_mon->voto; ?></td>
			<td><?php echo $item_mon->promovidos; ?></td>
			<td><?php echo $item_mon->reales; ?></td>	
			<td><?php echo $item_mon->calificacion; ?></td>	
	  </tr>		
		<?php endforeach;?>
	</table>
</body>
</html>