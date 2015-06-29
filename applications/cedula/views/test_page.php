<html>
    <head>
        <title>Ajax sample (with CodeIgniter)</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
            
            var controller = 'ajax_sample';
            var base_url = '<?php echo base_url();?>';

            function load_data_ajax(type){
                $.ajax({
                    'url' : base_url + '/' + controller + '/get_list_view',
                    'type' : 'POST', //the way you want to send data to your URL
                    'data' : {'type' : type},
                    'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                        var container = $('#container'); //jquery selector (get element by id)
                        if(data){
                            container.html(data);
                        }
                    }
                });
            }
        </script>

    </head>
    <body>
        
        <div id="main">
<h1>Customers</h1>
<div id="t01"></div>
</div>
        
        <button onclick="load_data_ajax(1)">Load list (type 1)</button>
        <button onclick="load_data_ajax(2)">Load list (type 2)</button>

        <hr />
        
        <div id="container"></div>

        
<script>
var controller = 'ajax_sample';
var base_url = '<?php echo base_url(); //you have to load the "url_helper" to use this function ?>';
var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("t01").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET","<?php echo base_url();?>/actividades/get_list_view",true);
xmlhttp.send();
</script>        
        
    </body>
</html>