<header>
<div class="navbar navbar-fixed-top navbar-inverse">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <li>
          <a href="<?php echo base_url('actividades/index');?>"><i class="icon-home icon-white"></i>
            <?php foreach ($get_fc as $fc) {
              if ($fc->id_fc === $edicion) {
                echo $fc->edicion ." (".$fc->anio.")";
              }
            } ?>
            
          </a>

            
        </li>
              <li>                
                <?php //*  FORMULARIO PARA BUSCAR  **//
                    $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/buscar_act'), $atributos); ?>
                    <input id="txt" name="txt" type="text" class="span4">
                    <button type="submit" class="btn"><small>Buscar Cédula</small></button>
                <?php echo form_close(); ?>
            </li>
          <li class="divider-vertical"></li>
          <li>                
        
          </li>
                  
      </ul>      
      <ul class="nav pull-right">
        
        <?php
        if ( $onlyusername == 'appcedula' ) { ?>
            <!-- Menu solo para appcedula -->
            <li><a data-toggle="modal" href="<?php echo base_url('actividades/master_plan');?>"><i class="icon-book"></i> MASTER PLAN &raquo;</a></li>
            <!--<li><a data-toggle="modal" href="<?php echo base_url();?>/actividades/resumen"><i class="icon-comment"></i> RESUMEN &raquo;</a></li>-->
        
            <li class="dropdown">  
              <a class="dropdown-toggle" data-toggle="dropdown">  
                <small><strong><?php echo $onlyusername; ?></strong> (<?php echo $_SESSION['grupo'];?>)</small>
                        
                        <span class="caret"></span>                
              </a>  
              <ul class="dropdown-menu"> 
                <!-- dropdown menu links -->                                              
                <li><a data-toggle="modal" href="<?php echo base_url('users/index');?>"><i class="icon-user"></i> Administrador de Responsables &raquo;</a></li>
                  <li><a data-toggle="modal" href="<?php echo base_url('coordinadores/index');?>"><i class="icon-bookmark"></i> Administrador de Coordinaciones &raquo;</a></li>
                  <li><a data-toggle="modal" href="<?php echo base_url('categorias/index');?>"><i class="icon-briefcase"></i> Administrador de Categorías &raquo;</a></li>
                  <li><a data-toggle="modal" href="<?php echo base_url('comentarios/index');?>"><i class="icon-comment"></i> Cronología de Comentarios &raquo;</a></li>
              </ul>
            </li>
            <!-- Menu solo para appcedula -->          
        <?php } ?>
        
          
        <li>
            <a data-toggle="modal" href="<?php echo base_url('admin/logout');?>"><i class="icon-off icon-white"></i><small>Salir</small></a>
        </li>
      </ul>
  </div>
  
  <div id="subheader">Esta como <STRONG>administrador</STRONG>, por favor sea cuidadoso.</div>

</div>
</header>