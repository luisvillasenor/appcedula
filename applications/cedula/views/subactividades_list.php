
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
      
        
        <div class="well well-small text-center">
          <h2>Subactividades del Festival de Calaveras <?php echo $anioTrabajo;?></h2>
        </div>
        <div>
        <!--Body content-->
            <?php
              switch ($grupo) {
                case 'administrador': ?>
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> </span> </a></li>
                        <li><a href="<?php echo base_url('subactividades/new_subact');?>" ><span><i class="icon-plus"></i> </span></a></li>                        
                        <li><a href="<?php echo base_url('actividades/calendario_act');?>"><span><i class="icon-calendar"></i> </span></a></li>
                      </ul>
                <?php break;
                case 'ortografia':?>
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="<?php echo base_url('subactividades/show');?>" ><span><i class="icon-list"></i> </span> </a></li>
                      </ul>
                <?php break;
                default:
                  echo '<div class="alert alert-block alert-error">';
                  echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                  echo '<h4 class="alert-heading">Ups ! Parece ser que Usted no es Miembo de este Sitio !</h4>';
                  echo '<p>';
                  echo 'Por favor solicite ayuda al administrador del sitio';
                  echo '</p>';
                  echo '<p>';
                  echo '<a class="btn btn-danger" href="'.base_url('admin/logout').'">Cerrar</a>';
                  echo '</p>';
                  echo '</div>';
                  break;
              } 

            ?>
            
        </div><!--Body content-->

        <!--
        <div class="offset8">
            
            <a class="btn btn-success" href="<?php echo base_url('subactividades/new_subact');?>">Agregar subactividad</a>
            
            <a>
              <?php $atributos = array('class' => 'navbar-form pull-left','name' => 'agregasubactform'); 
                  echo form_open(base_url('subactividades/show'), $atributos); ?>                    
                  <select class="span12" name="sede" id="sede" onchange="agregasubactform.submit()">
                    <option>Filtrar por sede</option>
                        <?php foreach ($show_sedes as $sede ) :?>                      
                          <option value="<?php echo $sede->sede;?>"><?php echo $sede->sede;?></option>
                        <?php endforeach; ?>
                    <option value="">Todos</option>
                  </select>                
              <?php echo form_close(); ?>
            </a>
            
        </div>
        -->


          <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
              <th>Fecha</th>
              <th>Inicia</th>
              <th>Termina</th>
              <th>Actividad/Taller</th>
              <th>Sede</th>
              <th>Ubicación</th>
              <th>Status Actual</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($show_subactividades as $subact) { ?>
                <tr>
              
                  <td><?php echo $subact->fecha_taller; ?></td>
                  <td><?php echo date("H:s",strtotime($subact->hora_ini));?> hrs</td>
                  <td><?php echo date("H:s",strtotime($subact->hora_fin));?> hrs</td>
                  <td>
                    <p ondblclick="myFunctionXsubactividad<?php echo $subact->id_subact; ?>()"><?php echo $subact->subactividad; ?><p>
                      <script>
                      function myFunctionXsubactividad<?php echo $subact->id_subact; ?>() {
                          $('#Editar<?php echo $subact->id_subact; ?>').modal('show')
                      }
                      </script>                    
                  </td>
                  <td><?php echo $subact->sede; ?></td>
                  <td><?php echo $subact->ubicacion; ?><br> (</small><?php echo $subact->status_subact; ?></small>)</td>
                  <td>
                    <?php
                    if ($subact->status_contenido == TRUE AND $subact->status_ortografia == TRUE) { ?>
                      <span class="label label-inverse">Programa General</span>
                    <?php } else {
                      # code...
                        ?>
                        <div id="miStatusContenido<?php echo $subact->id_subact; ?>">
                        <?php  
                            switch ($subact->status_contenido) {
                              case '2':      ?>
                                <span class="label label-danger">Contenido No Autorizado</span>
                              <?php break;      
                              case '1':      ?>
                                <span class="label label-success">Contenido Autorizado</span>
                              <?php break;
                              default:    ?>
                                <span class="label label-warning">Autorizacion Pendiente</span>  
                              <?php break; 
                            } 
                        ?>
                        </div>
                        <div id="miStatusOrtografia<?php echo $subact->id_subact; ?>">
                          <?php
                            switch ($subact->status_ortografia) {
                                case '1':      ?>
                                  <span class="label label-success">Ortografía Limpia</span>
                                <?php break;
                                case '0':      ?>
                                  <span class="label label-warning">Revision Ortográfica Pendiente</span>  
                                <?php break;
                              } 
                          ?>
                        </div>
                      <?php } ?>                    
                  </td>
                  <td>
                    <?php
                    $app = $_SESSION['username']; /** Cacho la sesion del usaurio **/

                    if ($subact->status_contenido == TRUE AND $subact->status_ortografia == TRUE) { ?>
                      <span class="label"><i class="icon-lock"></i><small> Bloqueado</small></span>
                      <?php
                          switch ($app) {
                            case 'appcedula@app.com':
                              # code...
                              break;
                            case 'rabingarcia@app.com':
                              # code...
                                                  ?>
                                                    <div>
                                                        <?php 
                                                          switch ($subact->status_contenido) { 
                                                            case '0': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                            case '1': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                          }
                                                        ?>                                                      
                                                      </div>
                                                      <div>
                                                      <?php 
                                                        switch ($subact->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                      <script>
                                                        function myFunctioncheckcontenido<?php echo $subact->id_subact; ?>() {
                                                            var valor = document.getElementById('status_contenido<?php echo $subact->id_subact; ?>').checked;
                                                            if (valor == false) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                              //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:0,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Autorización Pendiente</span>";
                                                              });
                                                            } else if (valor == true) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                              //alert("The input value has changed. The new value is: " + "SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:1,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Contrenido Autorizado</span>";
                                                              });
                                                            };
                                                        }

                                                        function myFunctioncheckortografia<?php echo $subact->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $subact->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                      </script>
                                                     
                                                
                                                    
                                                   
                                                <?php
                              break;
                            default:
                              # code...
                              break;
                          }
                      ?>
                    <?php } 
                            else {                                
                                  
                                  switch ($app) {
                                      case 'minerva@app.com':      
                                                ?>
                                                    <div>
                                                      <?php 
                                                        switch ($subact->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                    <script>
                                                      function myFunctioncheckortografia<?php echo $subact->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $subact->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                    </script>                    
                                                <?php 
                                        break;      
                                      case 'appcedula@app.com':      
                                        #       ?>
                                                    <div>
                                                        <?php 
                                                          switch ($subact->status_contenido) { 
                                                            case '0': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                            case '1': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                          }
                                                        ?>                                                      
                                                      </div>
                                                      <script>
                                                        function myFunctioncheckcontenido<?php echo $subact->id_subact; ?>() {
                                                            var valor = document.getElementById('status_contenido<?php echo $subact->id_subact; ?>').checked;
                                                            if (valor == false) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                              //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:0,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Autorización Pendiente</span>";
                                                              });
                                                            } else if (valor == true) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                              //alert("The input value has changed. The new value is: " + "SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:1,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Contenido Autorizado</span>";
                                                              });
                                                            };
                                                        }
                                                      </script>
                                                     
                                                
                                                    <div>
                                                      <?php 
                                                        switch ($subact->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                    <script>
                                                      function myFunctioncheckortografia<?php echo $subact->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $subact->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                    </script>
                                                <?php
                                        break;

                                      case 'rabingarcia@app.com':                             ?>

                                                      <div>
                                                        <?php 
                                                          switch ($subact->status_contenido) { 
                                                            case '0': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                            case '1': ?>
                                                              <label class="checkbox">
                                                                <input type="checkbox" id="status_contenido<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckcontenido<?php echo $subact->id_subact; ?>()"> <small>Contenido</small>
                                                              </label>                              
                                                          <?php break;
                                                          }
                                                        ?>                                                      
                                                      </div>
                                                      <script>
                                                        function myFunctioncheckcontenido<?php echo $subact->id_subact; ?>() {
                                                            var valor = document.getElementById('status_contenido<?php echo $subact->id_subact; ?>').checked;
                                                            if (valor == false) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                              //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:0,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Autorización Pendiente</span>";
                                                              });
                                                            } else if (valor == true) {
                                                              document.getElementById("status_contenido<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                              //alert("The input value has changed. The new value is: " + "SELECTED");
                                                              $.post("<?php echo base_url('subactividades/autoriza_contenido');?>",
                                                                  {
                                                                    status_contenido:1,
                                                                    id_subact:<?php echo $subact->id_subact; ?>,
                                                                    id_act:<?php echo $subact->id_act; ?>
                                                                  },
                                                                  function(data, status){
                                                                    document.getElementById("miStatusContenido<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Contenido Autorizado</span>";
                                                              });
                                                            };
                                                        }
                                                      </script>

                                                <!--
                                                <div class="dropdown">
                                                  <button class="btn btn-default btn-mini dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Opciones
                                                    <span class="caret"></span>
                                                  </button>
                                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><!-- Button to trigger modal 
                                                        <a data-toggle="modal" href="#Editar<?php echo $subact->id_subact; ?>"><i class="icon-edit"></i> <small>Editar</small></a>
                                                    </li>
                                                  </ul>
                                                </div>
                                              -->
                                              
                                                    <div>
                                                      <?php 
                                                        switch ($subact->status_ortografia) { 
                                                          case '0': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                          case '1': ?>
                                                            <label class="checkbox">
                                                              <input type="checkbox" id="ortografia<?php echo $subact->id_subact; ?>" checked onchange="myFunctioncheckortografia<?php echo $subact->id_subact; ?>()"> <small>Ortografía</small>
                                                            </label>                              
                                                        <?php break;
                                                        }
                                                      ?>                                                      
                                                    </div>
                                                    <script>
                                                      function myFunctioncheckortografia<?php echo $subact->id_subact; ?>() {
                                                          var valor = document.getElementById('ortografia<?php echo $subact->id_subact; ?>').checked;
                                                          if (valor == false) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",false);
                                                            //alert("The input value has changed. The new value is: " + "NO SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:0,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-warning'>Revision Ortográfica Pendiente</span>";
                                                            });
                                                          } else if (valor == true) {
                                                            document.getElementById("ortografia<?php echo $subact->id_subact; ?>").setAttribute("checked",true);
                                                            //alert("The input value has changed. The new value is: " + "SELECTED");
                                                            $.post("<?php echo base_url('subactividades/ortografia');?>",
                                                                {
                                                                  status_ortografia:1,
                                                                  id_subact:<?php echo $subact->id_subact; ?>,
                                                                  id_act:<?php echo $subact->id_act; ?>
                                                                },
                                                                function(data, status){
                                                                  document.getElementById("miStatusOrtografia<?php echo $subact->id_subact; ?>").innerHTML = "<span class='label label-success'>Ortografía Limpia</span>";
                                                            });
                                                          };
                                                      }
                                                    </script>

                                                <?php
                                        break; 
                                  }
                            } ?>

                  </td>
                </tr>              
                              <!-- Modal Editar -->
                              <div id="Editar<?php echo $subact->id_subact; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h3 id="myModalLabel">Actualiza Actividad/Taller</h3><small>ID: <?php echo $subact->id_subact; ?></small>
                                </div>
                                <?php echo form_open(base_url('subactividades/update'),'class=""'); ?>
                                    <div class="modal-body">
                                      <div class="">
                                        <textarea rows="10" cols="50" name="subactividad" id="subactividad"><?php echo $subact->subactividad; ?></textarea>
                                        <input type="hidden" name="objeto" id="objeto" value="subactividades">
                                        <input type="hidden" name="id_subact" id="id_subact" value="<?php echo $subact->id_subact; ?>"><br>
                                        <input type="hidden" name="id_act" id="id_act" value="<?php echo $subact->id_act; ?>"><br>                                        
                                        <input type="hidden" name="fecha_taller" id="fecha_taller" value="<?php echo $subact->fecha_taller; ?>"><br>
                                        <input type="hidden" name="sede" id="sede" value="<?php echo $subact->sede; ?>"><br>
                                        <input type="hidden" name="ubicacion" id="ubicacion" value="<?php echo $subact->ubicacion; ?>"><br>
                                        <input type="hidden" name="hora_ini" id="hora_ini" value="<?php echo $subact->hora_ini; ?>"><br>
                                        <input type="hidden" name="hora_fin" id="hora_fin" value="<?php echo $subact->hora_fin; ?>"><br>
                                        <input type="hidden" name="status_subact" id="status_subact" value="<?php echo $subact->status_subact; ?>">
                                      </div>                                  
                                    </div>
                                    <div class="modal-footer">
                                      <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
                                      <button type="submit" class="btn btn-success"><i class="icon-ok icon-white"></i> Actualizar</button>
                                    </div>
                                <?php echo form_close(); ?>
                              </div>
                              <!-- Modal Eliminar-->
                              <div id="Eliminar<?php echo $subact->id_subact; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h3 id="myModalLabel">Eliminar Actividad/Taller del Programa</h3>
                                </div>
                                <div class="modal-body">
                                  <div class="well">                                    
                                    <?php echo $subact->id_subact; ?><br>
                                    <?php echo $subact->id_act; ?><br>
                                    <?php echo $subact->subactividad; ?><br>
                                    <?php echo $subact->fecha_taller; ?><br>
                                    De las <?php echo $subact->hora_ini; ?> Hrs. a las <?php echo $subact->hora_fin; ?> Hrs.<br>
                                    <?php echo $subact->ubicacion; ?> / <?php echo $subact->sede; ?> (</small><?php echo $subact->status_subact; ?></small>)
                                  </div>
                                  
                                  <p>Se eliminara permanentemente el registro.</p>
                                  <p>¿Está seguro de eliminarlo permanentemente?</p>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Canelar</button>
                                  <a href="<?php echo base_url('subactividades/delete');?>/<?php echo $subact->id_subact; ?>/<?php echo $subact->id_act; ?>/subactividades" class="btn btn-danger"><i class="icon-trash icon-white"></i> Sí, estoy seguro</a>
                                </div>
                              </div>

            <?php } ?>
            </tbody>
          </table>

                        
          
        </div><!— /span8 —>
                        
        
    </div><!— /row-fluid —>

</div><!— /container-fluid —>


              
