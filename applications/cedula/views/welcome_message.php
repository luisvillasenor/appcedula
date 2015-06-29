
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido</title>

	<meta name="description" content="Sistema sobre Bootstrap 2.0">
    <meta name="author" content="Luis G. Villaseñor">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!—[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]—>
    
    <link href="http://10.1.17.10/ci21test/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    

    <link href="http://10.1.17.10/ci21test/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

   
   
</head>

<body>

<script src="http://10.1.17.10/ci21test/bootstrap/js/bootstrap.min.js"></script>
<script src="http://10.1.17.10/ci21test/bootstrap/js/bootstrap-dropdown.js"></script>
<?php
  switch ($_SESSION['grupo']) {
              case 'capturista':
                include 'include/menu_capturistas.php';  
                break;
              case 'gestor':
                include 'include/menu_gestor.php';  
                break;
              case 'administrador':
                include 'include/menu_admin.php'; 
                break;
              default:
                echo '<div class="alert alert-block alert-error">';
                echo '<button type="button" class="close" data-dismiss="alert">x</button>';
                echo '<h4 class="alert-heading">Ups ! Parece ser que Usted no es Miembo de este Sitio !</h4>';
                echo '<p>';
                echo 'Por favor solicite ayuda al administrador del sitio';
                echo '</p>';
                echo '<p>';
                echo '<a class="btn btn-danger" href="'.base_url().'admin/logout">Cerrar</a>';
                echo '</p>';
                echo '</div>';
                break;
            } ?>
<div class="container-fluid">

	<div class="hero-unit">
		<p>El presente Sistema permite generar una solicitud de compra para la Dirección Administrativa.</p>
	</div>

	
</div> <!— /container —>


</body>
</html>