<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>WARNING</title>   
	<meta name="description" content="Sistema sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>


<div class="container-fluid">
    <div id="wrapper" class="row-fluid"> 
        
              

                <?php foreach ($get_one_act_edit as $actividades ) : ?>
                <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  La cédula <?php echo $actividades->actividad;?> -- No. <?php echo $actividades->id_act;?>
                  <strong>NO SE ACTUALIZÓ</strong> 
                </div>
                <?php endforeach; ?>

        
        
    </div><!— /row —>
</div><!— /container —>


</body>
</html>