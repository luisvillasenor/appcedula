<table class="table table-bordered">
                <thead>
                    <span class="label label-inverse">Total de Cédulas: 
                        <span class="badge badge-inverse">
                            <?php foreach ($get_reg as $categos ) :
                                echo $categos->tot; endforeach; ?>
                        </span>
                    </span>                    
                </thead>
                <tbody>
                  <tr>
                    <th colspan="1"><small>OPERACIONES</small></th>
                    <th><small>ID</small></th>
                    <th><small>EVENTO</small></th>
                    <th><small>CATEGORIA</small></th>
                    <th><small>RESPONSABLE</small></th>                
                    <th><small>COSTO EVENTO CON IVA</small></th>
                    
                    <th><small>STATUS</small></th>
                
                  </tr>