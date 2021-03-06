<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo (isset($title)) ? $title : "Sistema de Control de Cédulas 1.0" ?> </title>
	<meta name="description" content="App Cédulas sobre Bootstrap 2.0">
  <meta name="author" content="Luis G. Villaseñor">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">    
  <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">    
  <link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet">    
  <link rel="stylesheet" href="<?php echo base_url('jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css'); ?>" />
  
    
  <style type="text/css">
    #subheader {
      background-color: #000;
      color: #CCC;
      margin: auto;
      height: 25px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }

    #subheader2 {
      background-color: #eee;
      margin: auto;
      height: 45px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }

    #subheader3 {
      background-color: #eee;
      color: red;
      margin: auto;
      height: 45px;
      width: 100%;
      text-align: center;
      word-spacing: normal;
      letter-spacing: normal;
      vertical-align: middle;
      white-space: normal;
      display: inline-block;      
    }

    #wrapper {
      background-color: transparent;
      margin-top: 70px;
      padding-top: 10px;
      padding-left: 10px;
      padding-right: 10px;
      
    }

    th
    {
    background-color:#FE9042;
    color:white;
    text-align: center;
    margin: auto;
    }
    h3{text-align:center;}
    .well2{
      background: #FFF;
      width: 100%;
      display: inline-block;      
      }

    #pesos{text-align: right;}
    #cantidad{text-align: center}
    #pesos_total{text-align: right; background-color: black; color: white; font-size: 16px;}
    #footer {

      position: fixed;
      bottom: 0;
      width: 100%;

    
      }
      #footer {
        background-color: #000;
      }
    /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }

    </style>

  <script>
    $(document).ready(function(){
      $(function() {
        $( "#fecha" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });
        $( ".datepicker" ).datepicker({ 
          dateFormat: 'yy-mm-dd', 
          showWeek: true, 
          firstDay:1
        });        
      });
      $("#leer").click(function(){
        $("div").hide();
      });        
    });    
  </script>

<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js">
  </script>
<![endif]-->    
</head>
<body>
<?php include 'include/nav_perfil.php';  ?>