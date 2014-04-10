<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tablas_esp  extends CI_Controller 
{
    public function index()
    {
        if ($this->session->userdata('nombre_usuario'))
        {
            //Si existe variable de session de nombre de usuario
            $this->load->model('Tablas_esp_model');
            $tablas_esp = $this->Tablas_esp_model->cargar_tabla_esp('asignatura');
            $datos_vista = array(
            'algun_error'=>  '',
            'tablas_esp'  =>  $tablas_esp
            );
            //Cargar la variable que se pasará a la vista
            $this->load->view('v_tablas_esp',$datos_vista);
            //Llama vista
        }
        else
        {
            header('Location: /');
        }
    }
}
?>
