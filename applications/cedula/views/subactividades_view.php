<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
        <div class="span2 sidebar-nav">
        <!--Body content-->
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a><small>MENÚ</small></a></li>
                <li><a href="<?php echo base_url('sedes/index');?>" ><span><small>SEDES</small></span></a></li>
                <li><a href="<?php echo base_url('ubicaciones/index');?>" ><span><small>UBICACIONES</small></span> </a></li>      
                <li><a href="<?php echo base_url('subactividades/index');?>"><span><small>SUBACTIVIDADES</small></span></a></li>
                <div class="text-center">
                    <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/pleca1.png">
                </div>
            </ul>
        </div><!-Body content-->
        <div class="row-fluid span10 control-group warning">              
        <!--Body content-->
            <div class="hero-unit">
                <h1>Gestión de Subactividades ó Talleres</h1>
                <p>Las Subactividades ó Talleres son todos aquellas actividades que se llevan a cabo dentro de una ubicación/sede 
                  donde se lleva a cabo un evento o actividad ya sea en la Capital ó en algún
                  Municipio</p>
                <p><a href="<?php echo base_url('subactividades/show');?>" class="btn btn-primary btn-large">Subactividades ó Talleres en el Festival de Calaveras &raquo;</a></p>
            </div>
        </div><!— /span12 —>
    </div><!— /row-fluid —>
</div><!— /container-fluid —>