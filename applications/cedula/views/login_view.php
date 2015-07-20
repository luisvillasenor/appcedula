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
    background-image: url('<?php echo base_url('footer-bg.jpg'); ?>') !important;
    background-size: cover;
    background-position: left top;
    width: 100%;
    height: 100%;
    visibility: inherit;
    opacity: 1;
  }
     .form-signin {
      max-width: 300px;
      padding: 19px 29px 29px;
      margin: 0 auto 20px;
      background-color: #fff;
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
    
    <div id="wrapper2" class="row-fluid">
        <div class="span6">
          <!--Body content-->
          <div class="well">
            <a href="http://www.festivaldecalaveras.com.mx/" target="_blank">
            <img src="<?php echo base_url(); ?>posada/CabezalPrincipal.jpg" class="img-rounded">
            </a>
          </div>


          <div class="">
            <?php echo form_open(base_url('admin/index'),'class="form-signin"'); ?>
                <h2 class="form-signin-heading">Acceso</h2>
                  <p>
                      <?php 
                          echo form_label('Dirección de Email: ',  'email_address' ) ; 
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
                        <option>Seleccione Edicion de Trabajo</option>
                        <?php foreach ($get_fc as $acts ) :?>
                          <option value="<?php echo $acts->id_fc;?>"><?php echo $acts->edicion; ?> (<?php echo $acts->anio;?>)</option>                          
                        <?php endforeach; ?>
                      </select>
                      
                  </p>
                  
                  <p>
                      <?php echo form_submit('submit',  'Iniciar','class="btn btn-medium btn-primary"' ); ?>
                      
                  </p>
            <?php echo form_close(); ?>            
          </div> 

          <div class="alert alert-success">
            <strong>Descarga!</strong> <a href="<?php echo base_url('GuiaRapidaActivarCedula.pdf'); ?>" target="_blank">Guía para Activar Cédulas del 2014 al 2015</a>
          </div>


            
        </div>        
    </div>
    
          
    
</div><!— /container-fluid —>
        
<footer>
    &copy 2014 - 2015 Sistema de Control de Cédulas Ver. 2.0.0
</footer>     

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
    
    
    <!-- 
<div id="myCarousel" class="carousel slide">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
      <li data-target="#myCarousel" data-slide-to="6"></li>
      <li data-target="#myCarousel" data-slide-to="7"></li>
      <li data-target="#myCarousel" data-slide-to="8"></li>
      <li data-target="#myCarousel" data-slide-to="9"></li>
      <li data-target="#myCarousel" data-slide-to="10"></li>
      <li data-target="#myCarousel" data-slide-to="11"></li>
  </ol>
  <!-- Carousel items 
  <div class="carousel-inner">
    <div class="active item"><img src="<?php echo base_url(); ?>/posada/1.jpg" width="500" height="350" class="img-rounded"></div>
    <div class="item"><img src="<?php echo base_url(); ?>/posada/2.jpg" width="500" height="350" class="img-rounded">  </div>
    <div class="item"><img src="<?php echo base_url(); ?>/posada/3.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/4.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/5.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/6.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/7.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/8.jpg" width="500" height="350" class="img-rounded">  </div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/9.jpg" width="500" height="350" class="img-rounded"></div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/10.jpg" width="500" height="350" class="img-rounded"></div>
      <div class="item"><img src="<?php echo base_url(); ?>/posada/11.jpg" width="500" height="350" class="img-rounded"></div>
  </div>
   Carousel nav 
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>

-->

</body>
</html>

