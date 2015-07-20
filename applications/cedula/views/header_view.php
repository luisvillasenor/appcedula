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
  
  <script src="<?php echo base_url('jquery-ui/js/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('jquery-ui/js/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
    
  <style type="text/css">
    #subheader {
      background-color: #CCC;
      margin: auto;
      height: 20px;
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
    }
    h3{text-align:center;}
    .well2{
      background: #FFF;
      width: 100%;
      display: inline-block;      
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
    
</head>
<body>
<?php include 'include/nav_perfil.php';  ?>