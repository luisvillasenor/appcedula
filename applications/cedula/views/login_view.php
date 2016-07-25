<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Control de Cedulas</title>
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php echo base_url(); ?>bootstrap/css/appcedula.css" rel="stylesheet">
  <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
  <style>
  body {
    background-color: transparent;
    background-repeat: no-repeat;
    background-image: url('<?php echo base_url('calaveras.jpg'); ?>') !important;
    background-size: cover;
    background-position: left top;
    width: 100%;
    height: 100%;
    visibility: inherit;
    
  }
     .form-signin {
      max-width: 300px;
      padding: 19px 29px 29px;
      margin: 0 auto 20px;
      background-color: #fff;
      opacity: 1.0;
      border: 1px solid #e5e5e5;
      -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
              border-radius: 5px;
      -webkit-box-shadow: 0 1px rgba(0,0,0,.05);
         -moz-box-shadow: 0 1px rgba(0,0,0,.05);
              box-shadow: 0 1px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading, .form-signin {
      margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
      font-size: 16px;
      height: auto;
      margin-bottom: 15px;
      padding: 7px 9px;
    }
     #wrapper2 {
      background-color: transparent;
      opacity: .8;
      margin-top: 20px;
      padding-top: 5px;
      padding-left: 10px;
      padding-right: 10px;
      
    }
    </style>
  <script type="text/javascript">        
      $('#myCarousel').carousel({  
        interval: 2000 // in milliseconds  
      });
  </script>   
    
</head>

<body>
  
<div class="container">
<!--Body content container-fluid-->
    
    <div id="wrapper2" class="row">
        <div class="span4">
          <!--Body content-->


          <div class="panel panel-success">
            <div class="panel-heading"></div>
            <div class="panel-body">

              <?php echo form_open(base_url('admin/index'),'class="form-signin"'); ?>
                <h2 class="form-signin-heading">Acceso</h2>
                  <p>
                      <?php 
                          echo form_label('Usuario: ',  'email_address' ) ; 
                          echo form_input('email_address', set_value('email_address'), 'id="email_address" class="input-block-level"');
                      ?>                      
                  </p>
                  <p>
                      <?php 
                          echo form_label('Password: ',  'password' ) ; 
                          echo form_password('password', '', 'id="password" class="input-block-level"');
                      ?>
                  </p>
                  <p>
                    <?php echo form_label('Edicion de Trabajo',  'edicion' ) ; ?>

                      <select class="input-block-level" name="edicion" id="edicion">
                        <?php foreach ($get_fc as $acts ) :?>
                          <option value="<?php echo $acts->id_fc;?>"><?php echo $acts->edicion; ?> (<?php echo $acts->anio;?>)</option>
                        <?php endforeach; ?>
                      </select>

                      
                  </p>
                  <br>
                  <p class="text-center">
                      <?php echo form_submit('submit',  'Iniciar Sesión','class="btn btn-lg btn-success btn-block"' ); ?>                      
                  </p>
                  <hr>
                  <div class="alert alert-success">
                    <strong>Descarga !</strong> <a href="<?php echo base_url('GuiaRapidaActivarCedula2016.pdf'); ?>" target="_blank">La Guía para Activar Cédulas</a>
                  </div>
                  <span><small>Versión 2.3.37</small></span>
            <?php echo form_close(); ?> 


            </div>            

          </div>
                        


            
        </div> 
             
    </div>
    
          
    
</div><!— /container-fluid —>
        
 

<script src="<?php echo base_url(); ?>bootstrap/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
    
    
</body>
</html>

