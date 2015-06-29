<td>
<?php $atributos = array('class' => 'form-inline'); 
    echo form_open(base_url('actividades/si_autorizar'), $atributos); ?>                    
    <input type="hidden" name="succes" id="succes" value="2">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
    <input type="hidden" name="actividad" id="actividad" value="<?php echo $actividades->actividad;?>">
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $actividades->e_mail;?>">    
    <button type="submit" class="btn btn-mini btn-success" data-toggle="tooltip" title="Aprobación Conceptual Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-ok"></i></button>
<?php echo form_close(); ?>
</td>
<td>    
<?php $atributos = array('class' => 'form-inline'); 
    echo form_open(base_url('actividades/pendiente'), $atributos); ?>                    
    <input type="hidden" name="pend" id="pend" value="0">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
    <button type="submit" class="btn btn-mini btn-warning" data-toggle="tooltip" title="Pendiente Aprobación Conceptual Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-warning-sign"></i></button>
<?php echo form_close(); ?>
</td>
<td>    
<?php $atributos = array('class' => 'form-inline'); 
    echo form_open(base_url('actividades/no_autorizar'), $atributos); ?>                    
    <input type="hidden" name="fail" id="fail" class="input-small" value="1">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades->id_act;?>">
    <button type="submit" class="btn btn-mini btn-danger" data-toggle="tooltip" title="No Aprobación Conceptual Cédula No. <?php echo $actividades->id_act;?>"><i class="icon-remove"></i></button>
<?php echo form_close(); ?>
</td>