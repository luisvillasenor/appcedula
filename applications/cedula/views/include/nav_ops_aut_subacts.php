




    <ul class="nav">
      <li><span>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'subactividades/autorizar', $atributos); ?>                    
    <input type="hidden" name="succes" id="succes" value="2">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $subact->id_subact;?>">
    <input type="hidden" name="actividad" id="actividad" value="<?php echo $actividades2->actividad;?>">
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $actividades2->e_mail;?>">
    <button type="submit" class="btn btn-success btn-small" data-toggle="tooltip" title="Aprobar"><i class="icon-ok"></i></button>
<?php echo form_close(); ?>
</span></li>
      <li><span>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'subactividades/autorizar', $atributos); ?>                    
    <input type="hidden" name="pend" id="pend" value="0">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades2->id_act;?>">
    <button type="submit" class="btn btn-warning btn-small" data-toggle="tooltip" title="Pendiente"><i class="icon-warning-sign"></i></button>
<?php echo form_close(); ?>
</span></li>
      <li><span>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'subactividades/autorizar', $atributos); ?>                    
    <input type="hidden" name="fail" id="fail" class="input-small" value="1">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades2->id_act;?>">
    <button type="submit" class="btn btn-danger btn-small" data-toggle="tooltip" title="No Aprobar"><i class="icon-remove"></i></button>
<?php echo form_close(); ?>
</span></li>
    </ul>    
