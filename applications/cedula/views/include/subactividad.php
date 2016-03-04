<b><?php echo $necs->subactividad;?></b><br>
<small><?php echo $necs->status_subact;?></small></br>
<small><?php echo date("d M",strtotime($necs->fecha_taller));?></small></br>
<small><?php echo $necs->sede;?></small></br>
<small><?php echo $necs->ubicacion;?></small></br>
<small>De <?php echo date("H:s",strtotime($necs->hora_ini));?> a <?php echo date("H:s",strtotime($necs->hora_fin));?></small>
<div class="text-center">
	<img style="width:100%;height:5%;" class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca-redes.png">
</div>