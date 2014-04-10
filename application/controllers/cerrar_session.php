<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cerrar_session extends CI_Controller 
{
    public function index()
    {
        $this->session->sess_destroy();
        header('Location: /');
    }
}
?>
