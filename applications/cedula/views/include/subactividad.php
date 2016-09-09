
<?php 
#$anterior = "";
#$actual = $necs->subactividad;
#$anterior = ($actual != $anterior ) ? echo $actual : break ;
#$actual = $necs->hora_ini;
#$anterior = ($actual != $anterior ) ? echo $actual : break ;


?>




<b><?php echo $necs->subactividad;?></b> [
<small><?php echo $necs->status_subact;?></small>]</br>
<small><?php echo $necs->sede;?> </small><small> (<?php echo $necs->ubicacion;?>)</small><br>
<small>De <?php echo date("H:i",strtotime($necs->hora_ini));?> </small><small> A <?php echo date("H:i",strtotime($necs->hora_fin));?> hrs.</small>

