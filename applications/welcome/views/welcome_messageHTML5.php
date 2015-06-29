<!DOCTYPE HTML>
<html>
    <head>
    <meta charset=utf-8>
    <title>Sistema de Cédulas</title>
    
    <script src="<?php base_url(); ?>js/modernizr-1.7.min.js"></script><!-- this is the javascript allowing html5 to run in older browsers -->
    
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/reset.css" media="screen" title="html5doctor.com Reset Stylesheet" />
    
    <!-- in the CSS3 stylesheet you will find examples of some great new features CSS has to offer -->
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/css3.css" media="screen" />
    
    <!-- general stylesheet contains some default styles, you do not need this, but it helps you keep a uniform style -->
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/general.css" media="screen" />
    
    <!-- grid's will help you keep your website appealing to your users, view 52framework.com website for documentation -->
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/grid.css" media="screen" />

    <!-- special styling for forms, this can be used as a form framework on its own -->
    <link rel="stylesheet" type="text/css" href="<?php base_url(); ?>css/forms.css" media="screen" />
    
    <!-- the following style is for demonstartion purposes only and is not needed for anything but inspiration -->
    <style>
        header {padding-top:25px; border-bottom:1px solid #ccc; padding-bottom:20px; background:#fff;}
        header .logo {font-size:3.52em;}
        header nav ul li {float:left; margin-top:12px;}
        header nav ul li a {display:block; padding:5px 15px; border-right:1px solid #eee; font-size:1.52em; font-family:Georgia, "Times New Roman", Times, serif; text-decoration:none;}
        header nav ul li a:hover {background-color:#eee; border-right:1px solid #ccc; text-shadow:-1px -1px 0px #fff;}
        header nav ul li.last a {border-right:none;}
        
        #css3 div > div {margin:0px 0px 50px 0px; padding:6px; border:1px solid #eee;}
        #grid div {text-align:center;  }
        #grid div > .col {border-bottom:1px solid #ccc; padding:10px 0px; outline:1px solid #eee;}
        
        h2 {border-bottom:1px dashed #ccc; margin-top:15px;}
        
        .documentation {display:block; background-color:#eee; padding:6px 13px; font-family:Georgia, "Times New Roman", Times, serif; color:#666; text-align:right; text-shadow:-1px -1px 0px #fff;}
        
        footer {text-align:center; color:#666; font-size:0.9em; padding:4px 0px; background:#fff;}

        body {background-image: url("http://10.1.17.10/ci21test/imagenes/Artesanias_Background_2048.jpg");}
    </style>
    </head>

<body>
<div class="row">
    <header>
        
        <div class="logo col_7 col"><img src="http://10.1.17.10/ci21test/imagenes/TURISMO_WEB.png" alt="Logo de Turismo" /></div><!-- logo col_7 -->
        
      <nav class="col_9 col">
            <ul>
                <li></li>
                <li></li>
                <li class="last"></li>
            </ul>
        </nav><!-- nav col_9 -->
      <div class="clear"></div><!-- clear -->
    </header>
</div><!-- row -->

<!-- this section shows you most of the styled elements from the general stylesheet -->
<section class="row" id="forms">
	<h1>Bienvenido al sistema de Gestión de Cédulas</h1>
     <article>            
            <blockquote class="left" style="width:550px;">

            </blockquote>
            
     </article> 

     <form class="col col_5">
    	<fieldset class="s_column">	
        	<legend>Acceder</legend>
            <div>
            	<label for="email">email</label>
                <input type="email" id="email" required="required" class="box_shadow"  />
            </div>
            
            <div>
            	<label for="name">name</label>
                <input type="text" id="name" class="box_shadow" />
            </div>
            
            <input type="submit" value="Acceder &rarr;" />
        </fieldset>
    </form>
     <div class="clear"></div>
     
</section><!-- row -->

<footer class="row">

    <div class="col_16 col">Secretaría de Turismo del Estado de Aguascalientes &copy; 2012 <a href="http://www.vivaaguascalientes.com">Viva Aguascalientes !!!</a> Dirección de Planeación, Estadística e Informática.</div>

</footer>
</body>
</html>
