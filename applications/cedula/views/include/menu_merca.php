<header>
<div class="navbar navbar-fixed-top navbar-inverse">  
  <div class="navbar-inner">     
      <ul class="nav">  
        <li>
          <a>
            <?php foreach ($get_fc as $fc) {
              if ($fc->id_fc === $edicion) {
                echo "FESTIVAL DE CALAVERAS - ". $fc->edicion ." (".$fc->anio.")";
              }
            } ?>
            
          </a>
        </li>
          <li class="divider-vertical"></li>
          <li>
          </li>
      </ul>      
      <ul class="nav pull-right">

        <!-- Menu solo para Rabin -->
        <!--<li><a data-toggle="modal" href="<?php echo base_url('actividades/master_contenidos');?>"><i class="icon-book"></i> MASTER CONTENIDOS &raquo;</a></li>-->
        <li class="dropdown">  
          <a class="dropdown-toggle" data-toggle="dropdown">  
            <small><strong><?php echo $onlyusername; ?></strong> (<?php echo $_SESSION['grupo'];?>)</small>
                          
          </a>  
          
        </li>
        <!-- Menu solo para Rabin -->                  

        <li>
            <a data-toggle="modal" href="<?php echo base_url('admin/logout');?>"><i class="icon-off icon-white"></i><small>Salir</small></a>
        </li>
      </ul>
  </div>
</div>
</header>