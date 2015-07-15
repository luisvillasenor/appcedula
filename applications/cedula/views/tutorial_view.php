<div class="container-fluid">
<!--CONTAINER content-->
    <div id="wrapper" class="row-fluid">
    <!--WRAPPER content-->
        <div class="span3 sidebar-nav">
          <!--Body content-->  
            <ul class="nav nav-list well affix">
              <li class="active">INDICE DEL TUTORIAL</li><hr>
              <li><a href="#howToNuevaCedula">¿Cómo Hago una Nueva Cédula? <i class="icon-chevron-right"></i></a></li>
              <li><a href="#howToBorrarCedula">¿Cómo Borrar una Cédula? <i class="icon-chevron-right"></i></a></li>
              <li><a href="#howToListarMisCedulas">¿Cómo Veo Mis Cédulas? <i class="icon-chevron-right"></i></a></li>
              <li><a href="#howToCalendario">El Calendario de Programación <i class="icon-chevron-right"></i></a></li>                
            </ul>    
        </div><!--Body content-->
        <div class="span9">
        <!--SPAN9 content-->
            
            <!-- Nueva Cédula ================================================== -->
            <section id="howToNuevaCedula">
                <div class="page-header">
                    <H1>Crear una Nueva Cédula</H1>                
                </div>
                <H2>Nueva Cédula<small> Agrege una nueva cédula</small></H2>
                <div class="row">
                    <div class="span3"><p><img width="70%" height="70%" src="<?php echo base_url(); ?>posada/15Actividades.png" class="img-rounded"></p></div>
                    <div class="span6"><pre>De click en la opcion de <strong>Nueva Cédula</strong> para iniciar la captura de la misma.</pre></div>
                </div>                
                <p>Cada campo contiene una breve leyenda de ayuda para orientarlo en la captura. Ver imagen.</p>
                <p><img src="<?php echo base_url(); ?>posada/SeccionCedula.png" class="img-rounded"></p>
                <p>Veamos un ejemplo a continuación:</p>
                <div class="bs-docs-example"><p><img src="<?php echo base_url(); ?>posada/SeccionCedulaCampos.png" class="img-rounded"></p></div>
                <p>El campo de selección de la Categoría de la Actividad permite clasificar dicha Cédula. Este campo de selección es importante ya que se utiliza para creación de <a href="#">Reportes</a> y <a href="#">Filtros</a>. Para conocer más en estos dos temas, vaya al menú y selecciones la opción correspndiente.</p>
                <H2>Sección Responsable<small> Responsable, Empresa, Puesto, Domicilio, Teléfono, Email, Sitio Web</small></H2>
                <p>La Sección Responsable tiene 7 campos como se ve en la imagen de abajo. Estos campos constituyen los datos del responsable de la Cédula, éste puede ser un director de área ó un proveedor.</p>
                <p><img src="<?php echo base_url(); ?>posada/SeccionResponsable.PNG" class="img-rounded"></p>
                <H2>Sección Cuando, Cuanto, Donde<small> Fechas, Costo, Ubicación</small></H2>
                <p>La Sección Cuando, cuanto y Donde tienen campos que constituyen los datos de los tiempos, costo y ubicación donde se llevará a cabo la actividad.</p>
                <p><img src="<?php echo base_url(); ?>posada/SeccionCuandoCuantoDonde.PNG" class="img-rounded"></p>
                <p>Finalmente para guardar la Cédula sólo utilice el boton <button class="btn btn-primary" type="button">Agregar Cédula</button></p>
                <br>
            </section>

            <!-- Borrar Cédula ================================================== -->
            <section id="howToBorrarCedula">
                <div class="page-header">
                    <h1>¿Cómo Borrar una Cédula?</h1>
                </div>
                <div class="bs-docs-example">
                    <div class="page-header">
                        <h2>Borrar una Cédula</h2>
                    </div>
                    <div class="container">
                        <div class="span8">
                        <h4>Una cédula puede eliminarse permanentemente siempre y cuando la cédula este en <STRONG>CEROS</STRONG>.</h4>
                        </div>                    
                    </div>
                </div>
                <div class="bs-docs-example">
                    <h4>La siguiente imagen muestra un ejemplo de una cédula en ceros:</h4>
                    <div class="bs-docs-example"><p><img src="<?php echo base_url(); ?>posada/cedulaCeros.jpeg" class="img-rounded"></p></div>    
                </div>
                <div class="container">
                    <div class="bs-docs-example">
                        <div class="span4"><h4>Edite la cédula usando el icono de "lapiz" <i class="icon-pencil"></i></h4></div>
                        <div class="span8"><img src="<?php echo base_url(); ?>posada/cedulaCerosEditar.jpeg" class="img-rounded"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="bs-docs-example">
                        <div class="span4"><h4>Elimine la cédula usando el boton de Borrar Cédula.</h4></div>
                        <div class="span8"><img src="<?php echo base_url(); ?>posada/cedulaCerosBorrar.jpeg" class="img-rounded"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="bs-docs-example">
                        <div class="span4"><h4>Confirme que desea eliminar permanentemente la cédula.</h4></div>
                        <div class="span8"><img src="<?php echo base_url(); ?>posada/cedulaCerosConfirmar.jpeg" class="img-rounded"></div>
                    </div>
                </div>                
                <br>
            </section>
            
            <!-- Listar Mis Cédula ================================================== -->
            <section id="howToListarMisCedulas">
                <div class="page-header">
                    <H1>¿Cómo Veo Mis Cédulas?</H1>                
                </div>
                <H2>Mis Cédulas<small> Lista las cédulas capturadas por el usuario.</small></H2>
                <div class="row">
                    <div class="span3"><p><img width="70%" height="70%" src="<?php echo base_url(); ?>posada/17-Actividades.PNG" class="img-rounded"></p></div>
                    <div class="span6"><pre>De click en la opcion de <strong>Mis Cédulas</strong> para ver un listado de todas sus cédulas capturadas.</pre></div>
                </div>
                <p>Cuando inicia sesion en el sistema, esta es la primer pantalla de información que verá y podrá ver las cédulas que Usted haya creado ó vaya a crear. Vea la imagen de ejemplo.</p>
                <p><img src="<?php echo base_url(); ?>posada/SeccionMisCedulas.PNG" class="img-rounded"></p>
                <p>Como puede ver en la imagen, en la primer columna llamada <strong>OPERACIONES</strong> cada icono representa una acción para trabajar con la cédula. Si pasa el mouse sobre cualquier icono, podra ver un pequeño mensaje de ayuda con la descripcion de la acción que representa ese icono.</p>
                <p>Más adelante veremos cada una de estas opciones.</p>
                <p>Adicional, las columnas <strong>ID</strong> y la columna <strong>CEDULA</strong> tienen la capacidad de ordenar la información de forma ascendente ó descendente según Usted lo requiera. Use los iconos <i class="icon-chevron-up"></i> y <i class="icon-chevron-down"></i> para tal efecto.</p>
                <p>Como se puede ir dando cuenta, el Sistema permite un Auto Aprendizaje Acelerado y con ello una mejor experienca al utilizarlo.</p>
            </section>
            
            <!-- Listar Mis Cédula ================================================== -->
            <section id="howToCalendario">
                <div class="page-header">
                    <H1>El Calendario de Programación</H1>                
                </div>
                <H2>Calendario<small> Lista la Programación de las cédulas.</small></H2>
                <div class="row">
                    <div class="span3"><p><img width="70%" height="70%" src="<?php echo base_url(); ?>posada/19-Actividades.PNG" class="img-rounded"></p></div>
                    <div class="span6"><pre>De click en la opcion <strong>Calendario</strong> del menú principal para ver un listado de todas las cédulas y su frecuencia diaria programada.</pre></div>
                </div>
                <p>En esta pantalla verá todas la cédulas con su programación y frecuencia diaria. Vea la imagen de ejemplo.</p>
                <p><img src="<?php echo base_url(); ?>posada/SeccionCalendario.PNG" class="img-rounded"></p>
                <p>Como puede ver en la imagen, hay dias donde no hay una marca (<i class="icon-ok"></i>) y otras en las que sí. Esto depende de cada responsable de cédula y la programación de frecuencia diaria. Esta información es importante ya que da pié a la elaboración del Programa de Festival de Calaveras (este tema no lo cubre este tutorial ni el sistema).</p>
                <p>Más adelante veremos como es que se calendariza la frecuencia diaria de una cédula</p>                
            </section>
        
        </div><!--SPAN9 content--> 
    </div><!--WRAPPER content-->    
</div><!--CONTAINER content-->
