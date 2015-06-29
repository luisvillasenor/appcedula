<?php
// PHP File Tree Demo
// For documentation and updates, visit http://abeautifulsite.net/notebook.php?article=21

// Main function file
include("'.base_url().'php_file_tree.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mis Cédulas</title>   
	<meta name="description" content="App Cédulas sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" />
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
    
        <!-- ----------------------------------------------------------------------------------------------------  -->
        <link href="styles/default/default.css" rel="stylesheet" type="text/css" media="screen" />
		
		<!-- Makes the file tree(s) expand/collapsae dynamically -->
		<script src="php_file_tree.js" type="text/javascript"></script>
        <!--  -->
        <script src="jquery.js" type="text/javascript"></script>
	    <script src="php_file_tree_jquery.js" type="text/javascript"></script>
        <!-- ----------------------------------------------------------------------------------------------------  -->
    
  

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( ".datepicker" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
          
        
      });
        
        
        
    });      
  </script>
</head>

<body>
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
                echo '<a class="btn btn-danger" href="'.site_url().'/admin/logout">Cerrar</a>';
                echo '</p>';
                echo '</div>';
                break;
            } 
?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>


        <div class="span8">
          <!--Body content-->          
          
        <div class="well"><h3>LISTADO DE CÉDULAS DE ACTIVIDAD</h3></div>           
            
          
        <hr />
		
		<h2>Browing...</h2>
		
		<?php
		
		// This links the user to http://example.com/?file=filename.ext
		//echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "http://example.com/?file=[link]/");

		// This links the user to http://example.com/?file=filename.ext and only shows image files
		//$allowed_extensions = array("gif", "jpg", "jpeg", "png");
		//echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "http://example.com/?file=[link]/", $allowed_extensions);
		
		// This displays a JavaScript alert stating which file the user clicked on
		echo php_file_tree("demo/", "javascript:alert('You clicked on [link]');");
		
		?>  
          
        </div><!— /span8 —>

        

    </div><!— /row —>

</div><!— /container —>



<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-button.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-modal.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-popover.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url(); ?>bootstrap/js/bootstrap-typeahead.js"></script>
    

</body>
</html>
