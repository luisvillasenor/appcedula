<?php

class Ajax extends Controller {

  public function Ajax() {
  
    parent::Controller(); 
  }

  public function username_taken()
  {
    $this->load->model('users_model', '', TRUE);
    // Elimina espacios en blanco al inicio y final de la cadena username
    $email_address = trim($_POST['username']);
    // if the username exists return a 1 indicating true
    if ($this->users_model->username_exists($email_address)) {
      echo '1';
    }
  }

}

/* End of file ajax.php */
/* Location: ./system/application/controllers/ajax.php */