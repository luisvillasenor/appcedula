<div class="container-fluid">
    <div id="wrapper" class="row-fluid">

      <?php include 'include/nav_actividades.php';   ?>
    
    <div class="row-fluid span8 control-group warning">              
    <!--Body content-->
        <div class="well">
          <h3>COMPRADO</h3>
          <table class="table table-bordered">
          <?php foreach ($get_one_act_edit as $actividades ) : ?>
            <tr>
            <th rowspan="1">CÉDULA No. <?php echo $actividades->id_act;?></th>
              <td>
                  <?php echo $actividades->actividad;?> ( <?php echo $actividades->e_mail;?> ) <?php $pres_aut = number_format($actividades->pres_aut,2,".",",");?>
              </td>
            </tr>
          <?php endforeach; ?>
          </table>
          <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                  Nuevo Concepto
                </button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Registrar Detalle</h4>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="Documento">Documento</label>
                            <input type="text" class="form-control" id="Documento" placeholder="Documento">
                          </div>
                          <div class="form-group">
                            <label for="Proveedor">Proveedor</label>
                            <input type="text" class="form-control" id="Proveedor" placeholder="Proveedor">
                          </div>
                          <div class="form-group">
                            <label for="Cantidad">Cantidad</label>
                            <input type="text" class="form-control" id="Cantidad" placeholder="Cantidad">
                          </div>
                          <div class="form-group">
                            <label for="Concepto">Concepto</label>
                            <input type="text" class="form-control" id="Concepto" placeholder="Concepto">
                          </div>
                          <div class="form-group">
                            <label for="Precio">Precio</label>
                            <input type="text" class="form-control" id="Precio" placeholder="Precio">
                          </div>
                          <div class="checkbox">
                            <label class="radio-inline">
                            <input type="radio" name="" id="" value="option1"> Factura
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="" id="" value="option2"> Requisición
                            </label>
                          </div>                          
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>

          <table class="table table-bordered">              
            <tr>
              <th colspan="6"></th>
            </tr>
              <?php 
                $tot = 0; 
                $tot_iva = 0;
                $gran_tot = 0;
                foreach ($get_all_nec_act as $necesidades ) : ?>
                  <tr>                                       
                    <form class="form-inline">
                      <td>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Documento</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="exampleInputAmount">
                        </div>
                      </div>                      
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox1" value="option1"> Factura
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="inlineCheckbox2" value="option2"> Requisición
                        </label>                        
                      </td>                      
                      <td>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Proveedor</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="exampleInputAmount">
                        </div>
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Concepto</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="exampleInputAmount">
                        </div>
                      </div>
                      </td>
                      <td>
                      <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">Cantidad</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="exampleInputAmount">
                        </div>
                      </div>
                      </td>
                      <td>
                      <button type="submit" class="btn btn-default">Actualizar</button>
                      </td>
                    </form>                    
                </tr>                    
              <?php 
                    $tot += $necesidades->precio_total;
                    $tot_iva += $necesidades->iva;
                    $gran_tot = $tot + $tot_iva;
              ?>
              <?php endforeach; ?>            
          </table>

        </div>           
          

          <div class="well">
            <h3>COTIZADO</h3>
            <table class="table table-bordered">              
              <thead>
              </thead>            
                <tr>
                  <th colspan="1"></th>
                  <th>Concepto Cotizado</th>
                  <th>Concepto Facturado</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario sin IVA</th>
                  <th>Precio Total sin IVA</th>
                  <th>Proveedor (Factura)</th>
                </tr>
                  <?php 
                  $tot = 0; 
                  $tot_iva = 0;
                  $gran_tot = 0;

                  foreach ($get_all_nec_act as $necesidades ) : ?>
                    <tr>
                      <td>
                        <span><a href="<?php echo base_url();?>necesidades/edit_nec/<?php echo $necesidades->id_act;?>/<?php echo $necesidades->id_nec;?>" data-toggle="tooltip" title="Editar Necesidad No. <?php echo $necesidades->id_nec;?>"><i class="icon-pencil"></i></a></span>
                        <span><a href="<?php echo base_url();?>necesidades/is_borrar_nec/<?php echo $necesidades->id_act;?>/<?php echo $necesidades->id_nec;?>" data-toggle="tooltip" title="Borrar Necesidad No. <?php echo $necesidades->id_nec;?>"><i class="icon-trash"></i></a></span>
                      </td>
                      <td><?php echo $necesidades->descripcionec;?></td>
                      <td><?php echo $necesidades->observaciones;?></td>
                      <td><?php echo $necesidades->cantidad;?></td>
                      <td>$<?php echo number_format($necesidades->precio_unitario,2,".",",");?></td>
                      <td>$<?php echo number_format($necesidades->precio_total,2,".",",");?></td>
                      <td><?php echo $necesidades->encargado;?></td>
                    </tr>                    
                    <?php 
                      $tot += $necesidades->precio_total;
                      $tot_iva += $necesidades->iva;
                      $gran_tot = $tot + $tot_iva;
                    ?>
                  <?php endforeach; ?>            
            </table>
          </div>
          
        
          
        </div><!— /span8 —>

            <div class="span2 sidebar-nav"> 
            <ul class="nav nav-list well affix">
              <li class="active"><a>COTIZADO</a></li><br>        
              <li>
                  <a>
                     <?php foreach ($get_total_act as $tot ) : ?>
                        $<?php echo number_format($tot->total_act,2,".",","); ?>
                      <?php endforeach; ?>(Costo)
                  </a>                  
              </li>
              <li>
                  <a>
                     <?php foreach ($get_total_act as $tot2 ) : ?>
                        $<?php echo number_format($tot2->tot_iva,2,".",","); ?>
                      <?php endforeach; ?>(IVA)
                  </a>                  
              </li>
              <li>
                <a>
                    <?php foreach ($get_total_act as $tot3 ) : ?>
                      $<?php echo number_format($tot3->tot_tot,2,".",","); ?>
                    <?php endforeach; ?>(Total cédula)
                </a>
              </li>
              <hr>
              <li class="active"><a>FACTURADO</a></li><br>        
              <li>
                  <a>
                     <?php foreach ($get_total_act as $tot ) : ?>
                        $<?php echo number_format($tot->total_act,2,".",","); ?>
                      <?php endforeach; ?>(Costo)
                  </a>                  
              </li>
              <li>
                  <a>
                     <?php foreach ($get_total_act as $tot2 ) : ?>
                        $<?php echo number_format($tot2->tot_iva,2,".",","); ?>
                      <?php endforeach; ?>(IVA)
                  </a>                  
              </li>
              <li>
                <a>
                    <?php foreach ($get_total_act as $tot3 ) : ?>
                      $<?php echo number_format($tot3->tot_tot,2,".",","); ?>
                    <?php endforeach; ?>(Total cédula)
                </a>
              </li>
              <hr>
              <li>
                <span class="badge badge-success"><h3>$<?php echo number_format($pres_aut,2,".",","); ?></h3><small>(Presupuesto Autorizado)</small></span>
              </li>
                  <br>
                  <?php 
                  foreach ($get_total_act as $tot3 ) :                  
                        $total_cedula = number_format($tot3->tot_tot,2,".",",");                   
                  endforeach;
                  $total_resultado = $pres_aut - $total_cedula;
                    if ($total_resultado > 0) { ?>
                      <li>
                        <span class="badge badge-warning"><h3>$<?php echo number_format($total_resultado,2,".",",");?></h3><small>(Presupuesto Resultante)</small></span>
                      </li>
                      <?php } 
                      elseif ($total_resultado < 0) { ?>
                        <li>
                          <span class="badge badge-important"><h3>$<?php echo number_format($total_resultado,2,".",",");?></h3><small>(Presupuesto Resultante)</small></span>
                        </li>
                      <?php } ?> 
            </ul>
            
          </div>        
        
        
        
    </div><!— /row —>

</div><!— /container —>

