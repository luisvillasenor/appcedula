<div class="container-fluid">

    <div id="wrapper" class="row-fluid">
        
      <?php include 'include/nav_actividades.php';   ?>      
        
    
    <div class="row span10">              
    <!--Body content-->
      
        <div class="well"><h3>CRONOLOGÍA DE COMENTARIOS</h3></div>
        
        
        <?php foreach ($get_all_com as $comentarios ) : ?>
        <div class="well">                    
        <section>
            <header>
                <nav>
                    <strong>Cédula No. <?php echo $comentarios->id_act;?></strong> <a href="<?php echo base_url();?>actividades/comentarios_act/<?php echo $comentarios->id_act;?>" data-toggle="tooltip" title="Ver TODOS los Comentarios de la Cédula No. <?php echo $comentarios->id_act;?>"><i class="icon-comment"></i></a>
                </nav>
                <small>Fecha: <a><?php echo $comentarios->fecha_ult_com;?></a> | Publicado por: <a><?php echo $comentarios->usuario;?></a></small>
            </header>
            <p><?php echo $comentarios->comentarios;?></p>
        </section>        
        </div>
        <p>
        <?php endforeach; ?>
          
        </div><!— /span9 —>
        
        
    </div><!— /row —>

</div><!— /container —>
