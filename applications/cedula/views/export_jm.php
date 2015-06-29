<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=base-de-datos-jm.xls");
?>
<html>
<head>
	  <table border="1">
		<th>NOMBRE</th><th>SECCION</th><th>VOTO</th><th>ESTRUCTURA</th><th>VOTARON</th><th>CALIFICACION</th>
        		
		<?php foreach($export_promotores as $item_mon):?>		
		<tr align="center">
            <td><?php echo $item_mon->jefe_manzana; ?></td>
			<td><?php echo $item_mon->seccion; ?></td>
			<td><?php echo $item_mon->voto; ?></td>
			<td><?php echo $item_mon->estructura; ?></td>
			<td><?php echo $item_mon->votaron; ?></td>	
			<td><?php echo $item_mon->calificacion; ?></td>	
	  </tr>		
		<?php endforeach;?>
	</table>
</body>
</html>