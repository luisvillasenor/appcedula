
<?php foreach ($get_one_act_edit as $actividades3 ) :  ?>

<div class="navbar">
<div class="navbar-inner">
<div class="container">
<div calss="span6">
    
<a class="brand">Gestión Presupuestal

<table>
<tr>


<td>


    
    <form class="form-inline">
  <input type="text" class="input-small" placeholder="Monto">
  
  <select >
    <option>Presupuesto Año Anterio</option>
      <option>Presupuesto Autorizado</option>
      <option>Presupuesto Ejercido</option>
  </select>
  <button type="submit" class="btn">Salvar</button>
</form>
    
</td>

</tr>
</table>
    
</a>

</div><!-- span6 -->
    
<div calss="span6">
    
<a class="brand">Modificaciones al Presupuesto Solicitado

<table>
<tr>

<td>
    <a href="#myModal" role="button" class="btn" data-toggle="modal">Movimientos</a>
</td>

</tr>
</table>
    
</a>

</div><!-- span6 -->
</div><!-- container -->
</div><!-- navbar-inner -->
</div><!-- navbar -->


<!-- Modal Ver Movomientos -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Movimientos Efectuados al Presupuesto</h3>
          </div>
          <div class="modal-body">
              
              <script>
                  $(document).ready(function(){                      
                      var PresAnt = 100;
                      var PresMod = PresAnt;
                      var PresMod2 = PresAnt;
                      
                      $("#plus").click(function(){
                          var dato1 = $("#datoPlus").val();
                          PresMod += Number(dato1);
                          alert(PresMod);
                      });
                      
                      $("#minus").click(function(){
                          var dato2 = $("#datoMinus").val();
                          PresMod2 += Number(dato2);
                          alert(PresMod2);
                      });
                      
                    });
              
              </script>
            
            <table>
                <tr>
                    <td>
                        <form id="plusForm" class="form-inline">
                            <input type="text" id="datoPlus" class="input-small" placeholder="Monto ">
                            <button class="btn"><i id="plus" class="icon-plus"></i></button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form id="minusForm" class="form-inline">
                            <input type="text" id="datoMinus" class="input-small" placeholder="Monto ">
                            <button class="btn"><i id="minus" class="icon-minus"></i></button>
                        </form>
                    </td>
                </tr>  
            </table>
            
            
              
            <table class="table table-bordered">
              <caption>Cédula.- <?php echo $actividades3->actividad;?></caption>
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Registrado por</th>
                  <th>Tipo de Movimiento</th>
                  <th>Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>01/09/2014</td>
                  <td>AAAAA</td>
                  <td>Aumentó</td>
                  <td>1,200.25</td>
                </tr>
                <tr>
                  <td>05/09/2014</td>
                  <td>AAAAA</td>
                  <td>Desminuyó</td>
                  <td>875.00</td>
                </tr>
              </tbody>
            </table>    
          </div>
          <div class="modal-footer">
            <small>Estos datos sólo son de ejemplo</small>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>    
          </div>
        </div>

<!-- Modal formulario VISTA AGREGAR -->
        <div id="myModalAgregar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <form class="form-inline">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Movimientos Efectuados al Presupuesto</h3>
          </div>
          <div class="modal-body">              
            
              <input type="text" class="input-small" placeholder="Monto">
                           
            
          </div>
          <div class="modal-footer">
            <small>Estos datos sólo son de ejemplo</small>
            <button type="submit" class="btn">Guardar</button>   
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>    
          </div>
              </form>  
        </div>

<?php endforeach; ?>



    