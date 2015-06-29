<div>
<?php
  switch ($_SESSION['grupo']) {
              case 'coordinador':
                include 'menu_coord.php';  
                break;
              case 'gestor':
                include 'menu_gestor.php';  
                break;
              case 'administrador':
                include 'menu_admin.php'; 
                break;
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
</div>
