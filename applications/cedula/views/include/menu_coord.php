<header>
<div class="navbar navbar-fixed-top navbar-inverse">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <li>
          <a href="<?php echo base_url('actividades/index');?>"><i class="icon-home icon-white navbar-icon-home"></i> AppCedula</a>
        </li>
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/buscar_act'), $atributos); ?>
                    <input id="txt" name="txt" type="text" class="span4">
                    <button type="submit" class="btn"><small>Buscar Cédula</small></button>
                <?php echo form_close(); ?>
            </li> 
          
      </ul>      
      <ul class="nav pull-right">  
        <li class="dropdown">  
          <a class="dropdown-toggle" data-toggle="dropdown">  
            <small><strong><?php echo $onlyusername; ?></strong>   (<?php echo $_SESSION['grupo'];?>)</small>
                    <i class="icon-user"></i>
                    <span class="caret"></span>                
          </a>  
          <ul class="dropdown-menu"> 
            <!-- dropdown menu links -->                                              
            <li><a data-toggle="modal" href="<?php echo base_url('admin/logout');?>"><i class="icon-off"></i><small>Salir del Sistema &raquo;</small></a></li>            
          </ul>
        </li>
      </ul>
  </div>  
    
  <div id="subheader"><strong><?php echo $miCoordinacion; ?></strong></div>  
    
</div>

</header>