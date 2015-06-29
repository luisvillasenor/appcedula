<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Editar Cédula de Actividad</title>   
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
    
    <style>
table, th, td
{
border-collapse:collapse;
border:1px solid black;
}
th, td
{
padding:15px;
}
        th
{
background-color:#FE9042;
color:white;
}
</style>

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha_act" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( "#fecha_aut" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
      });
    });      
  </script>
</head>

<body>
<?php include 'include/nav_perfil.php';  ?>

<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
        <?php include 'include/nav_actividades.php';  ?>
        
        
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
        
        <div class="well"><h3>Actualizar Frecuencia de la Cédula</h3></div> 

        
<?php foreach ($get_one_act_edit as $act ) : ?>                 
      <?php echo form_open(base_url('actividades/actualizar_act'),'class="form-horizontal"'); ?>
        <fieldset>
          
          <table>
            <tr>
            <th rowspan="1">CÉDULA</th>
            <td>                
                <label>ID: <?php echo $act->id_act;?></label>
                <label><?php echo $act->actividad;?></label>
                <input id="id_act" name="id_act" type="hidden" value="<?php echo $act->id_act;?>">
                <input id="actividad" name="actividad" type="hidden" value="<?php echo $act->actividad;?>">
                <input id="descripcion" name="descripcion" type="hidden" value="<?php echo $act->descripcion;?>">
                <input id="justificacion" name="justificacion" type="hidden" value="<?php echo $act->justificacion;?>">
                <input id="id_categoria" name="id_categoria" type="hidden" value="<?php echo $act->id_categoria;?>">
                <input id="quienpropone" name="quienpropone" type="hidden" value="<?php echo $act->quienpropone;?>">
                <input id="empresa" name="empresa" type="hidden" value="<?php echo $act->empresa;?>">
                <input id="puesto" name="puesto" type="hidden" value="<?php echo $act->puesto;?>">
                <input id="domicilio" name="domicilio" type="hidden" value="<?php echo $act->domicilio;?>">
                <input id="telefono" name="telefono" type="hidden" value="<?php echo $act->telefono;?>">
                <input id="email" name="email" type="hidden" value="<?php echo $act->email;?>">
                <input id="web" name="web" type="hidden" value="<?php echo $act->web;?>">
                <input id="fecha_act" name="fecha_act" type="hidden" value="<?php echo $act->fecha_act;?>">
                <input id="fecha_aut" name="fecha_aut" type="hidden" value="<?php echo $act->fecha_aut;?>">
                <input id="costo_secture" name="costo_secture" type="hidden" value="<?php echo $act->costo_secture;?>">
                <input id="costo_publico" name="costo_publico" type="hidden" value="<?php echo $act->costo_publico;?>">
                <input id="is_costo_secture" name="is_costo_secture" type="hidden" value="<?php echo $act->is_costo_secture;?>">
                <input id="is_costo_publico" name="is_costo_publico" type="hidden" value="<?php echo $act->is_costo_publico;?>">
                <input id="id_coord" name="id_coord" type="hidden" value="<?php echo $act->id_coord;?>">
                <input id="status_act" name="status_act" type="hidden" value="<?php echo $act->status_act;?>">
                <input id="id_fc" name="id_fc" type="hidden" value="<?php echo $act->id_fc;?>">
                <input id="id_resp" name="id_resp" type="hidden" value="<?php echo $act->id_resp;?>">
                
            </td>
            </tr>                
            <tr>
            <th rowspan="1">CUANDO</th>
            <td>      
                
                <label>FRECUENCIA</label>
                
                <label class="checkbox inline">31 OCT</label>
                <?php switch ($act->d1) {
                            case '2014-10-31' :
                                echo form_checkbox('d1', '2014-10-31', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d1', '2014-10-31', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">1° NOV</label>
                <?php switch ($act->d2) {
                            case '2014-11-01' :
                                echo form_checkbox('d2', '2014-11-01', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d2', '2014-11-01', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">2 NOV</label>
                <?php switch ($act->d3) {
                            case '2014-11-02' :
                                echo form_checkbox('d3', '2014-11-02', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d3', '2014-11-02', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">3 NOV</label>
                <?php switch ($act->d4) {
                            case '2014-11-03' :
                                echo form_checkbox('d4', '2014-11-03', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d4', '2014-11-03', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">4 NOV</label>
                <?php switch ($act->d5) {
                            case '2014-11-04' :
                                echo form_checkbox('d5', '2014-11-04', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d5', '2014-11-04', FALSE);
                                break;
                } ?>                
                <p></p>
                <label class="checkbox inline">5 NOV</label>
                <?php switch ($act->d6) {
                            case '2014-11-05' :
                                echo form_checkbox('d6', '2014-11-05', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d6', '2014-11-05', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">6 NOV</label>
                <?php switch ($act->d7) {
                            case '2014-11-06' :
                                echo form_checkbox('d7', '2014-11-06', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d7', '2014-11-06', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">7 NOV</label>
                <?php switch ($act->d8) {
                            case '2014-11-07' :
                                echo form_checkbox('d8', '2014-11-07', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d8', '2014-11-07', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">8 NOV</label>
                <?php switch ($act->d9) {
                            case '2014-11-08' :
                                echo form_checkbox('d9', '2014-11-08', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d9', '2014-11-08', FALSE);
                                break;
                } ?>                
                <label class="checkbox inline">9 NOV</label>
                <?php switch ($act->d10) {
                            case '2014-11-09' :
                                echo form_checkbox('d10', '2014-11-09', TRUE);
                                break;                            
                            default:
                                echo form_checkbox('d10', '2014-11-09', FALSE);
                                break;
                } ?>                
                                
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Hora inicial</label>
                    <div class="controls">
                      <select class="span4" id="hora_ini" name="hora_ini">
                          <?php foreach ($get_horarios as $hora ) : 
                            if($act->hora_ini == $hora->horario){ ?>
                                <option value="<?php echo $hora->horario; ?>" selected><?php echo $hora->horario; ?></option>                                
                            <?php } else { ?>
                                <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
                            <?php } ?>
                          <?php endforeach; ?>   
                        </select>                
                    </div><p>
                    <label class="control-label" for="inputEmail">Hora Final</label>
                    <div class="controls">
                      <select class="span4" id="hora_fin" name="hora_fin">
                          <?php foreach ($get_horarios as $hora ) : 
                            if($act->hora_fin == $hora->horario){ ?>
                                <option value="<?php echo $hora->horario; ?>" selected><?php echo $hora->horario; ?></option>                                
                            <?php } else { ?>
                                <option value="<?php echo $hora->horario; ?>"><?php echo $hora->horario; ?></option>
                            <?php } ?>
                          <?php endforeach; ?>   
                        </select>                
                    </div>
                </div>
                
                
            </td>
            </tr>
            <th rowspan="1">DONDE</th>
            <td>                
                <label></label>
                <input class="input-xxlarge" id="ubicacion" name="ubicacion" type="text" value="<?php echo $act->ubicacion;?>">
            </td>
            
           </table>
          <p><br>
          <button type="submit" class="btn btn-primary">Actualizar Cédula</button>
        </fieldset>
      <?php echo form_close(); ?>
    
<?php endforeach; ?>        
        
    </div><!— /row span12 —>
    </div>   
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