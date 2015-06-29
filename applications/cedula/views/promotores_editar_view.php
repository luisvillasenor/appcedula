<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Promotor View</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" />
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-1.9.1.js"></script>
  <script src="<?php echo base_url(); ?>jquery-ui/js/jquery-ui-1.10.2.custom.min.js"></script>
  <style type="text/css">
    #subheader {
      background-color: #CCC;
      margin: auto;
      height: 20px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }
    #wrapper {
      background-color: transparent;
      margin-top: 70px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;
      
    }
  </style>

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
                echo '<a class="btn btn-danger" href="'.base_url().'/admin/logout">Cerrar</a>';
                echo '</p>';
                echo '</div>';
                break;
            } 
?>
<div class="container-fluid">
  <div id="wrapper" class="row-fluid">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url();?>/promotores/index"><i class="icon-home"></i></a> <span class="divider">/</span></li>
      <li><a href="<?php echo base_url();?>/promotores/index">Promotores</a> <span class="divider">/</span></li>
      <li class="active">Actualizar Promotor</li>
    </ul>
  </div><!— /row —>
  <?php foreach ($get_pr as $key => $value) { ?>
  
  <div class="row-fluid span12">
    <!--Body content-->          
    <?php echo form_open('promotores/actualizar_pr'); ?>
      <fieldset>
        <legend>Actualizar Promotor ID: <?php echo $value->id_promotor; ?></legend>
          <input type="hidden" name="id_promotor" value="<?php echo $value->id_promotor;?>">
        <label>Folio Lista Nominal</label>
          <input type="text" name="folio" value="<?php echo $value->folio;?>">
        <label>Nombre del Promotor</label>
          <input type="text" name="promotor" value="<?php echo $value->promotor;?>">
        <label>Sección</label>
          <input type="text" name="seccion" value="<?php echo $value->seccion;?>">
        <label>¿Asistió a Casilla para Votar?</label>
        <?php 
          switch ( $value->voto) {
            case '0':?>
              <label class="checkbox inline">
                <input type="radio" name="voto" value="1"> Sí
              </label>
              <label class="checkbox inline">
                <input type="radio" name="voto" value="0" checked="checked"> No
              </label>              
              <?php break;
            case '1':?>
              <label class="checkbox inline">
                <input type="radio" name="voto" value="1" checked="checked"> Sí
              </label>
              <label class="checkbox inline">
                <input type="radio" name="voto" value="0" > No
              </label>              
              <?php break;            
            default:
              # code...
              break;
          }
        ?>        
        <p><br>
        <label>Jefe de Manzana Asignado</label>
          <select name="id_jefe_manzana">
            <?php foreach ($get_all as $item ) : ?>
              
                <?php if ($value->id_jefe_manzana == $item->id_jefe_manzana) { ?>
                  <option value="<?php echo $item->id_jefe_manzana;?>" selected="selected"><?php echo $item->jefe_manzana;?></option>                            
                <?php } ?>                
              
            <?php endforeach; ?>
          </select>              
        <label>Promovidos Asignados</label>
          <input type="text" name="promovidos" value="<?php echo $value->promovidos;?>">
        <label>Promovidos que SI votaron</label>
          <input type="text" name="reales" value="<?php echo $value->reales;?>">
        <p>
        <br>
        <button type="submit" class="btn">Actualizar</button>
      </fieldset>
    </form>
  </div><!— /span8 —>
  <?php } ?>
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