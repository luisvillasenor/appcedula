<div id="noty" class="alert alert-block">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Nuevos Comentarios!</h4>
  Nuevo comentario Publicado por: <strong><span id="publicado"></span></strong> en cédula # <a id="p1"></a>
      
</div>

<script language="javascript">

        function Notificaciones() {            
            
            <?php foreach($get_all_com as $item) : ?>
            
                if('0' == <?php echo $item->status_com;?>){
                   
                   document.getElementById('noty').style.visibility='hidden';
                               
                }
    
                   document.getElementById('noty').style.visibility='visible';                  
                  
                  document.getElementById("publicado").innerHTML = "<?php echo $item->usuario;?>";
                  
                    addElement();
    
                   
            <?php endforeach ;?>            
    
        }
        
        function addElement () { 
  // create a new div element 
  // and give it some content 
  var newDiv = document.createElement("div"); 
  var newContent = document.createTextNode("Hi there and greetings!"); 
  newDiv.appendChild(newContent); //add the text node to the newly created div. 

  // add the newly created element and its content into the DOM 
  var currentDiv = document.getElementById("noty"); 
  document.body.insertBefore(newDiv, currentDiv); 
}
    
    
    
    </script>