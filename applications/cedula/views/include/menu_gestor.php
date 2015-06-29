<header>
<div class="navbar navbar-fixed-top navbar-inverse">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <li>
          <a href="<?php echo base_url('actividades/index');?>"><i class="icon-home icon-white navbar-icon-home"></i>
            <?php foreach ($get_fc as $fc) {
              if ($fc->id_fc === $edicion) {
                echo $fc->edicion ." (".$fc->anio.")";
              }
            } ?>
          </a>
        </li>
              <li>                
                <?php $atributos = array('class' => 'navbar-form pull-left'); 
                    echo form_open(base_url('actividades/buscar_act'), $atributos); ?>
                    <input id="txt" name="txt" type="text" class="span4">
                    <button type="submit" class="btn">Buscar Cédula</button>
                <?php echo form_close(); ?>
            </li>          
      </ul>      
      <ul class="nav pull-right">  
        <li class="dropdown">  
          <a class="dropdown-toggle" data-toggle="dropdown">  
            Bienvenido <strong><?php echo $onlyusername; ?></strong>   (<?php echo $_SESSION['grupo'];?>)                             
                    <i class="icon-user"></i>
                    <span class="caret"></span>                
          </a>  
          <ul class="dropdown-menu"> 
            <!-- dropdown menu links -->                                              
            <li><a data-toggle="modal" href="<?php echo base_url('admin/logout');?>"><i class="icon-off"></i> Salir del Sistema &raquo;</a></li>            
          </ul>
        </li>
      </ul>
  </div>  
  <div id="subheader"><strong></strong></div>  
</div>
</header>