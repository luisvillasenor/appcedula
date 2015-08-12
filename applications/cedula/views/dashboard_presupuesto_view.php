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
              CONTROL PRESUPUESTO ( CEDULA - <?php /*echo $actividades->id_act;*/?><?php echo $value ;?>)
            </button>
            
                 
        <div id="demo<?php echo $key ;?>" class="collapse in"> 

                  <table class="table table-bordered table-responsive">
          <?php /*foreach ($get_all_actividades as $actividades ) : */?>
                <thead></thead>
              <tr>                
                <th>CEDULA</th>
                <th>DUEÑO</th>
                <th>COSTO CEDULA</th>
                <th>PRUSUPUESTO AUTORIZADO</th>
                <th>RESULTADO</th>
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
                  <td>Dueño de la cedula</td>

                  <input type="hidden" name="id_act" id="id_act" value="<?php /*echo $actividades->id_act;*/?>">                  
                  <input type="hidden" name="pres_soli" id="pres_soli" value="<?php /*echo $actividades->pres_soli;*/?>">
                  
                  <td><!-- COSTO TOTAL = SOLICITADO -->
                    <p style="padding: 10px; font-size:30px;" class="text-center">
                    $<?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                    </p>                    
                  </td>                  
                  <td><!-- PRESUPUESTO AUTORIZADO -->
                      
                      <p style="padding: 10px; font-size:30px;" class="text-center">
                    $<?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                  </td>

                  <td><!-- PRESUPUESTO EJERCIDO SE AUTOCALCULA-->
                    <?php /*if ( $actividades->pres_eje < 0 ) { */?>
                      
                    <?php /*}else{ */?>
                      
                    <?php /*}*/?>

                    
                      <p style="padding: 10px; font-size:30px;" class="text-center">
                    $<?php
                      /*echo number_format($actividades->costo_secture*1.16,2,".",",");*/
                    ?> 
                      
                  </td>
                  <td>
                    <!-- <button class="btn btn-sm btn-success btn-block" type="submit">Actualizar Calculo</button> -->
                    <button type="button" class="btn btn-inverse btn-block" data-toggle="collapse" data-target="#demoA3<?php echo $key ;?>">
                      Ver COSTO
                    </button>
                    <button type="button" class="btn btn-inverse btn-block" data-toggle="collapse" data-target="#demoA3A<?php echo $key ;?>">
                      Ver GASTO
                    </button>
                  </td>  

              <?php echo form_close(); ?>
              </tr>
            <?php /*endforeach; */?>
            </table>

            <div class="alert-success" id="demoA3<?php echo $key ;?>" class="collapse in">              
                    <table class="table table-bordered">              
                          <thead>
                              <h2>DETALLE COSTO CEDULA</h2>
                              
                          </thead>            
                            <tr>
                              <th colspan="1"></th>
                              <th>Necesidades, Descripción</th>
                              <th>Necesidades, Observaciones</th>
                              <th>Cantidad</th>
                              <th>Precio Unitario sin IVA</th>
                              <th>Precio Total sin IVA</th>
                              <th>Proveedor ó Encargado</th>
                              
                            </tr>
                            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                    
                 
                        </table>
            </div>
            <div class="alert-info" id="demoA3A<?php echo $key ;?>" class="collapse in"> 
                        <table class="table table-bordered">              
                          <thead>
                            <h2>CONCEPTOS PARA FACTURACION</h2>
                              
                              <div >
                                                                         
                                      <?php echo form_open('necesidades/#'); ?>
                                      <button type="submit" class="btn">Agregar Concepto</button>
                                      <?php echo form_close();?>                                      
                                  
                                  <a class="close" >Usar Precios SIN iva.</a>
                              </div>
                              
                          </thead>            
                            <tr>
                              <th colspan="1">Req-Factura</th>
                              <th>Concepto</th>
                              <th>Clasificacion</th>
                              <th>Cantidad</th>
                              <th>Precio Unitario sin IVA</th>
                              <th>Precio Total sin IVA</th>
                              <th>Proveedor</th>
                              
                            </tr>
                            
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>                    
                 
                        </table>
            </div>



            


        </div>
            




    </div>

     

<?php } ?>



      </div><!— /span10 —>
    </div><!— /row —>
</div><!— /container —>
