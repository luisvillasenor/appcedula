<!-- /Ventana Modal AGREGAR CIUDADANO -->
<div id="nvo_ciud" class="modal hide fade in" style="display: none; ">  
  <div class="modal-header">  
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
    <h3>Agregar Nuevo Ciudadano</h3>  
  </div>  
  <div class="modal-body">  
    <?php echo form_open(base_url().'/ciudadano/agregar'); ?>
    <p>
    <div class="row-fluid">
        <div class="span6">
          <div class="alert">                
              <h2><small>Datos Generales</small></h2>
          </div>

        </div>
    </div>      
  </div>  
  <div class="modal-footer">
      <button type="submit" class="btn btn-inverse">Agregar &raquo;</button>  
      <a href="<?php echo base_url().'/capturar/';?>" class="btn" data-dismiss="modal">Cancelar &raquo;</a>  
  </div>
    <?php echo form_close(); ?>                  
</div>
<!-- /Ventana Modal AGREGAR CIUDADANO -->