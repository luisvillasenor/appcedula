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
                    <th colspan="2">OPERACIONES</th>
                    <th>ID</th>
                    <th>CEDULA</th>
                    <th>CATEGORIA</th>
                    <th>RESPONSABLE</th>                
                    <th>PLANEADO SECTURE CON IVA</th>                    
                    <th>SALDO</th>                
                  </tr>