<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
         
       <div class="span2 sidebar-nav">
        <div style="text-align:center; margin:0 auto;">
          <a href="<?php echo base_url('actividades/dashboard');?>">
            <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/sectureags.png" width="50%">
          </a>
        </div>
        <hr>
        <!--Body content-->
            <div class="col-md-3">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="<?php echo base_url('actividades/dashboard');?>"><i class="icon-home"></i> DASHBOARD</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_actividades');?>">Cedulas Autorizadas</a></li>
                <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>">Listado Clasificados</a></li>
                
              </ul>
            </div>
      </div><!--Sidebar content-->

        <div class="span10">
        <!--Body content-->
        <?php //include 'include/menu_filtros_pres.php';?> 
           
        
                    
            <table class="table table-bordered">
            <thead>
              <h2 class="text-center">LISTADO DE CLASIFICADOS</h2>
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="<?php echo base_url('actividades/dashboard_consolidados');?>">Todo</a>
                    </li>
                    <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/R/ ">Requisiciones</a></li>
                    <li><a href="<?php echo base_url('actividades/dashboard_consolidados');?>/F/ ">Facturas</a></li>
                    <li class="dropdown">
                      <a class="dropdown-toggle"
                         data-toggle="dropdown"
                         href="#">
                          Clasificacion
                          <b class="caret"></b>
                        </a>
                      <ul class="dropdown-menu">
                        <!-- links -->
                        <?php foreach ($get_groupby_clasificacion as $value) {
                          echo "<li>";
                          echo "<a href='".base_url('actividades/dashboard_consolidados').'/ /'.$value->clasificacion."'>$value->clasificacion</a>";
                          echo "</li>";
                        } ?>
                      </ul>
                    </li>
                  </ul>
            </thead>   
              <tr>                
                <th></th>
                <th>Cedula</th>
                <th>Tipo</th>
                <th>Clasificacion</th>
                <th>Proveedor</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio Unitario SIN IVA</th>
                <th>IVA</th>
                <th>Precio Total</th>
                <th>Status</th>
              </tr>
              <?php foreach ($get_all_cons_act as $cons_item ) : ?>
                  <tr>                    
                      <td><a href="<?php echo base_url('actividades/vista_previa_presupuesto').'/'.$cons_item->id_act;?>" type="button" class="btn btn-success"><?php echo $cons_item->id_con;?></a></td>
                      <td><?php echo $cons_item->id_act;?></td>
                      <td>
                              <?php switch ($cons_item->tipo) {
                                case 'R':
                                  echo "Requisición";
                                  break;
                                case 'F':
                                  echo "Factura";
                                  break;
                              } ?>
                      </td>
                      <td><?php echo $cons_item->clasificacion;?></td>
                      <td><?php echo $cons_item->proveedor;?></td>
                      <td><?php echo $cons_item->concepto;?></td>
                      <td><?php echo $cons_item->cantidad;?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->precio_unitario,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->iva,2,".",",");?></td>
                      <td id="pesos">$<?php echo number_format($cons_item->precio_total,2,".",",");?></td>
                      <td id="pesos"><?php echo $cons_item->status_cons;?></td>
                  </tr>                    
                 
              <?php endforeach; ?>
                
              
            </table>
          
          
        </div><!— /span10 —>

        

    </div><!— /row —>

</div><!— /container —>
