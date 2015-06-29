<div class="navbar">  
  <div class="navbar-inner">     
      <ul class="nav pull-left">  
        <li>
          <a href="<?php echo base_url();?>captura/index"><i class="icon-home"></i>
            <?php foreach ($get_fc as $fc) {
              if ($fc->id_fc === $edicion) {
                echo $fc->edicion ." (".$fc->anio.")";
              }
            } ?>
          </a>
        </li>
        <li class="dropdown">          
          <a class="dropdown-toggle" data-toggle="dropdown" ><strong>Captura</strong>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <!-- dropdown menu links -->                                  
            <li><a data-toggle="modal" href="#nvo_ciud">Nuevo Ciudadano &raquo;</a></li>
            <li><a data-toggle="modal" href="#nva_soli">Nueva Solicitud &raquo;</a></li>
          </ul>     
        </li>
      </ul> 

      <ul class="nav pull-right">  
        <li class="dropdown">  
          <a class="dropdown-toggle" data-toggle="dropdown">  
            Bienvenido <strong><?php echo $onlyusername; ?></strong>                                
                    <i class="icon-user"></i>
                    <span class="caret"></span>                
          </a>  
          <ul class="dropdown-menu"> 
            <!-- dropdown menu links -->                                  
            
            <li><a data-toggle="modal" href="<?php echo base_url();?>admin/logout"><i class="icon-off"></i> Salir del Sistema &raquo;</a></li>            
          </ul>
        </li>
      </ul>

  </div>  
</div>


<!— /Ventana Modal AGREGAR CIUDADANO —>
<div id="nvo_ciud" class="modal hide fade in" style="display: none; ">  
  <div class="modal-header">  
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>  
    <h3>Agregar Nuevo Ciudadano</h3>  
  </div>  
  <div class="modal-body">  
    <?php echo form_open(base_url().'ciudadano/agregar'); ?>
    <p>
    <div class="row-fluid">
        <div class="span6">
          <div class="alert">                
              <h2><small>Datos Generales</small></h2>
          </div>
          <div class="alert alert-success">

              <?php
                echo form_label('Nombre(s): ',  'nombre' ) ; 
                echo form_input('nombre', set_value('nombre'), 'id="nombre"');
              ?>
              <?php
                echo form_label('Apellido Paterno: ',  'apellido_p' ) ; 
                echo form_input('apellido_p', set_value('apellido_p'), 'id="apellido_p"');
              ?>
              <?php
                echo form_label('Apellido Materno: ',  'apellido_m' ) ; 
                echo form_input('apellido_m', set_value('apellido_m'), 'id="apellido_m"');
              ?>
              <?php echo form_label('Sexo: ',  'sexo' ) ;?>
              Hombre: <?php
                echo form_radio('sexo', 'hombre', 'id="sexo"');
              ?>
              Mujer: <?php
                echo form_radio('sexo', 'mujer', 'id="sexo"');
              ?><p>
              <?php
                echo form_label('Edad: ',  'edad' ) ; 
                echo form_input('edad', set_value('edad'), 'id="edad"');
              ?>
              <?php
                $edocivil = array('soltero','casado');
                echo form_label('Estado Civil: ',  'edocivil' ) ; 
                echo form_dropdown('edocivil', $edocivil);
              ?>
              <?php
                echo form_label('Hijos Mayores 18: ',  'num_hijos' ) ; 
                echo form_input('num_hijos', set_value('num_hijos'), 'id="num_hijos"');
              ?>
          </div>
        </div>
        <div class="span6">
          <div class="alert">                
              <h2><small>Datos de Contacto</small></h2>
          </div>
          <div class="alert alert-success">
              <?php
                echo form_label('Tel. Of.: ',  'tel_of' ) ; 
                echo form_input('tel_of', set_value('tel_of'), 'id="tel_of"');
              ?>
              <?php
                echo form_label('Tel. Casa: ',  'tel_casa' ) ; 
                echo form_input('tel_casa', set_value('tel_casa'), 'id="tel_casa"');
              ?>
              <?php
                echo form_label('Tel. Cel.: ',  'tel_cel' ) ; 
                echo form_input('tel_cel', set_value('tel_cel'), 'id="tel_cel"');
              ?>
              <?php
                echo form_label('E-Mail: ',  'email' ) ; 
                echo form_input('email', set_value('email'), 'id="email"');
              ?>
              <?php
                $horario = array('24' => '24:00' , '23'=> '23:00','22'=> '22:00','21'=> '21:00','20'=> '20:00','19'=> '19:00','18'=> '18:00','17'=> '17:00','16'=> '16:00','15'=> '15:00','14'=> '14:00','13'=> '13:00','12'=> '12:00','11'=> '11:00','10'=> '10:00','09'=> '09:00','08'=> '08:00','07'=> '07:00','06'=> '06:00','05'=> '05:00','04'=> '04:00','03'=> '03:00','02'=> '02:00','01'=> '01:00','00'=> '00:00');
                echo form_label('Horario para localizarlo: ',  'hora' ) ; 
                echo form_dropdown('hora', $horario);
              ?>
              
              <?php
                echo form_label('Calle: ',  'domicilio' ) ; 
                echo form_input('domicilio', set_value('domicilio'), 'id="domicilio"');                
              ?>
              <?php echo form_label('Col ó Fracc: ',  'ref_id' ) ; ?>
                <select name="ref_id" id="ref_id">
                <?php foreach ($get_all_referencias as $key): ?>
                    <option value="<?php echo $key->ref_id; ?>"><?php echo $key->asenta; ?></option>
                <?php endforeach ?>
                </select>
              
              <?php echo form_label('Sección: ',  'sec_id' ) ; ?>
                <select name="sec_id" id="sec_id">
                <?php foreach ($get_all_secciones as $key_sec): ?>
                    <option value="<?php echo $key_sec->sec_id; ?>"><?php echo $key_sec->seccion; ?></option>
                <?php endforeach ?>
                </select>
              
              

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
<!— /Ventana Modal AGREGAR CIUDADANO —>

<!— /Ventana Modal AGREGAR SOLICITUD —>
<div id="nva_soli" class="modal hide fade in" style="display: none; ">  
  <div class="modal-header">  
    <a class="close" data-dismiss="modal">X</a>  
    <h3>Agregar Nueva Solicitud</h3>  
  </div>  
  <div class="modal-body">  
    <?php echo form_open(base_url().'/solicitud/agregar'); ?>
      <input type="hidden" name="status_id" id="status_id" value="0">
      <div class="row-fluid">
        <div class="span6">
          <div class="alert">                
              <h2><small>Datos Generales</small></h2>
          </div>
          <div class="alert alert-success">
          <input type="text" name="fecha" id="fecha">
          <?php
            $prioridad = array('ugente','alta','media','normal');
            echo form_label('Prioridad: ',  'prioridad_id' ) ; 
            echo form_dropdown('prioridad_id', $prioridad);
          ?>
          <?php
            $tipo_id = array('Gestión de Agua','Gestión de Predial','Gestión de Luz','Gestión de Gas LP','Gestión de Medicamentos y Consultas','Gestión de Servicios Públicos Generales','Gestión de Seguridad Pública y Tránsito','Gestión de Asesoría Jurídica');
            echo form_label('Tipo de Gestión: ',  'tipo_id' ) ; 
            echo form_dropdown('tipo_id', $tipo_id);
          ?>
          <?php
            $origen = array('Formato','Oficina','Telefono','Facebook','E-Mail');
            echo form_label('Origen: ',  'origen' ) ; 
            echo form_dropdown('origen', $origen);
          ?>
          <?php echo form_label('Ciudadano: ',  'ciud_id' ) ; ?>
            <select name="ciud_id" id="ciud_id">
            <?php foreach ($get_all_ciudadanos as $key_ciudadano): ?>
              <option value="<?php echo $key_ciudadano->ciud_id; ?>"><?php echo $key_ciudadano->nombre; ?> <?php echo $key_ciudadano->apellido_p; ?> <?php echo $key_ciudadano->apellido_m; ?></option>
            <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="span6">
          <div class="alert">                
              <h2><small>Registro de la Solicitud</small></h2>
          </div>
          <div class="alert alert-success">
          <?php /*
            $dep_id = array('NULL','SECTURE','IEA','ISSSSPEA','MUNICIPIO');
            echo form_label('Dependencia de Gobierno: ',  'dep_id' ) ; 
            echo form_dropdown('dep_id', $dep_id);*/
          ?>
          <?php 
              echo form_label('Necesidad: ',  'necesidad' ) ; 
              echo form_textarea('necesidad', set_value('necesidad'), 'id="necesidad" rows="10"');
            ?>
          </div>
        </div>
      </div>
  </div>  
  <div class="modal-footer">
      <button type="submit" class="btn btn-inverse">Agregar &raquo;</button>  
      <a href="#" class="btn" data-dismiss="modal">Cancelar &raquo;</a>  
  </div>
    <?php echo form_close(); ?>                  
</div>
<!— /Ventana Modal AGREGAR SOLICITUD —>



