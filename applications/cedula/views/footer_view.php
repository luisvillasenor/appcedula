<script src="<?php echo base_url('jquery-ui/js/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('jquery-ui/js/jquery-ui-1.10.2.custom.min.js'); ?>"></script>

<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-alert.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-button.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-collapse.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-dropdown.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-modal.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-popover.js');?>"></script>

<script src="<?php echo base_url('bootstrap/js/bootstrap-scrollspy.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-tab.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-tooltip.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-transition.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap-typeahead.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrapValidator.min.js');?>"></script>
<script src="<?php echo base_url('bootstrap/js/validator.js');?>"></script>




<script>
/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded
$(document).ready(function() {

  /* USERNAME VALIDATION */
  // use element id=username 
  // bind our function to the element's onblur event
  $('#username').blur(function() {

    // get the value from the username field                              
    var username = $('#username').val();
    
    // Ajax request sent to the CodeIgniter controller "ajax" method "username_taken"
    // post the username field's value
    $.post("<?php echo base_url('ajax/username_taken');?>",
      { 'username':username },

      // when the Web server responds to the request
      function(result) {
        // clear any message that may have already been written
        $('#bad_username').replaceWith('');
        
        // if the result is TRUE write a message to the page
        if (result) {
          $('#username').after('<div id="bad_username" style="color:red;">' +
            '<p>(That Username is already taken. Please choose another.)</p></div>');
        }
      }
    );
  });  

});
</script>

<!--
<div id="footer" class="text-center">
      <img class="img-rounded" src="<?php echo base_url();?>bootstrap/img/header_festival_2015_fondo_negro.png" width="24%">
</div>
-->

</body>
</html>