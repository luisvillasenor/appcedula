<div class="container-fluid">
    <div id="wrapper" class="row-fluid">
      <?php include 'include/nav_presupuesto.php';  ?>
      <div class="span10">
      <!--Body content-->
      <?php include 'include/menu_filtros_pres.php';  ?>
      
<?php $arrayName = array('A'); ?>
<?php foreach ($arrayName as $key => $value) { ?>
  
          

      <div class="well">
            <button type="button" class="btn btn-inverse btn-block" data-toggle="collapse" data-target="#demo<?php echo $key ;?>">
              TITULO 
            </button>
            
                 
        <div id="demo<?php echo $key ;?>" class="collapse in"> 

                  <table class="table table-bordered table-responsive">
          <?php /*foreach ($get_all_actividades as $actividades ) : */?>
                <thead></thead>
              <tr>                
                <th>TITULO</th>
                <th>TITULO</th>
                <th>TITULO</th>
                <th>TITULO</th>
                <th>TITULO</th>
                <th colspan="2"></th>
              </tr>
              <tr>                  
              <?php $atributos = array('class' => 'navbar-form pull-left', 'name'=>'FormActualizaPres','id'=>'FormActualizaPres','onsubmit' => 'return validacion()'); 
              echo form_open(base_url().'actividades/dashboard_presupuestos', $atributos); ?>
                  <!-- AUTO ENVIO DEL FORMULARIO DESPUES DE 5 SEGUNDOS  
                  <script type="text/javascript">
                    var wait=setTimeout("document.FormActualizaPres.submit();",5000);
                  </script>
                  <script type="text/javascript">
                    $('#FormActualizaPres').submit(function(e){
                        e.preventDefault();
                    });
                  </script>
                  -->
                  
                  
                  <td>123456</td>
                  <td>ABCDEFG</td>

                  <input type="hidden" name="id_act" id="id_act" value="<?php /*echo $actividades->id_act;*/?>">                  
                  <input type="hidden" name="pres_soli" id="pres_soli" value="<?php /*echo $actividades->pres_soli;*/?>">
                  
                  <td><!-- COSTO TOTAL = SOLICITADO -->
                    <p style="padding: 10px; font-size:30px;" class="text-center">
                    <?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                    </p>                    
                  </td>                  
                  <td><!-- PRESUPUESTO AUTORIZADO -->
                      
                      <p style="padding: 10px; font-size:30px;" class="text-center">
                    <?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                  </td>

                  <td><!-- PRESUPUESTO EJERCIDO SE AUTOCALCULA-->
                    <?php /*if ( $actividades->pres_eje < 0 ) { */?>
                      
                    <?php /*}else{ */?>
                      
                    <?php /*}*/?>

                    
                      <p style="padding: 10px; font-size:30px;" class="text-center">
                    <?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                      
                  </td>
                  <td>
                    <!-- <button class="btn btn-sm btn-success btn-block" type="submit">Actualizar Calculo</button> -->
                    <button type="button" class="btn btn-inverse btn-block" data-toggle="collapse" data-target="#demoA3<?php echo $key ;?>">
                      Ver ESTO
                    </button>
                    <button type="button" class="btn btn-inverse btn-block" data-toggle="collapse" data-target="#demoA3A<?php echo $key ;?>">
                      Ver AQUELLO
                    </button>
                  </td>  

              <?php echo form_close(); ?>
              </tr>
            <?php /*endforeach; */?>
            </table>

            
           


            


        </div>
            




    </div>

     

<?php } ?>



      </div><!— /span10 —>
    </div><!— /row —>
</div><!— /container —>
