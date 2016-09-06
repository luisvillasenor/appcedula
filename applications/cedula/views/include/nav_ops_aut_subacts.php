<ul class="nav">
      <li><span>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'subactividades/autoriza_contenido', $atributos); ?>                    
    <input type="hidden" name="status_contenido" id="status_contenido" value="1">
    <input type="hidden" name="id_subact" id="id_subact" value="<?php echo $subact->id_subact;?>">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $subact->id_act;?>">
    <button type="submit" class="btn btn-success btn-small" data-toggle="tooltip" title="Aprobar"><i class="icon-ok"></i></button>
<?php echo form_close(); ?>
</span></li>
      <li><span>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'subactividades/autoriza_contenido', $atributos); ?>                    
    <input type="hidden" name="status_contenido" id="status_contenido" value="0">
    <input type="hidden" name="id_subact" id="id_subact" value="<?php echo $subact->id_subact;?>">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $subact->id_act;?>">
    <button type="submit" class="btn btn-warning btn-small" data-toggle="tooltip" title="Pendiente"><i class="icon-warning-sign"></i></button>
<?php echo form_close(); ?>
</span></li>
</ul>