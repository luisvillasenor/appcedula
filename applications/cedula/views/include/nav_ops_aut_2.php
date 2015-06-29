
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<div calss="span4">
    
<a class="brand">Aprobaciónes<small> (sólo para usuarios autorizados)</small>

<table>
<tr>
<td>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'actividades/si_autorizar', $atributos); ?>                    
    <input type="hidden" name="succes" id="succes" value="2">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades2->id_act;?>">
    <input type="hidden" name="actividad" id="actividad" value="<?php echo $actividades2->actividad;?>">
    <input type="hidden" name="usuario" id="usuario" value="<?php echo $actividades2->e_mail;?>">
    <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Aprobación Conceptual Cédula No. <?php echo $actividades2->id_act;?>"><i class="icon-ok"></i></button>
<?php echo form_close(); ?>
</td>
<td>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'actividades/pendiente', $atributos); ?>                    
    <input type="hidden" name="pend" id="pend" value="0">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades2->id_act;?>">
    <button type="submit" class="btn btn-warning" data-toggle="tooltip" title="Pendiente Aprobación Conceptual Cédula No. <?php echo $actividades2->id_act;?>"><i class="icon-warning-sign"></i></button>
<?php echo form_close(); ?>
</td>
<td>
<?php $atributos = array('class' => 'navbar-form pull-left'); 
    echo form_open(base_url().'actividades/no_autorizar', $atributos); ?>                    
    <input type="hidden" name="fail" id="fail" class="input-small" value="1">
    <input type="hidden" name="id_act" id="id_act" value="<?php echo $actividades2->id_act;?>">
    <button type="submit" class="btn btn-danger" data-toggle="tooltip" title="No Aprobación Conceptual Cédula No. <?php echo $actividades2->id_act;?>"><i class="icon-remove"></i></button>
<?php echo form_close(); ?>
</td>

</tr>
</table>
    
</a>

</div><!-- span4 -->
    

</div><!-- container -->
</div><!-- navbar-inner -->
</div><!-- navbar -->