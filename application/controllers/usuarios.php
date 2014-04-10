<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios  extends CI_Controller 
{
    public function index()
    {
        if ($this->session->userdata('nombre_usuario'))
        {
            //Si existe variable de session de nombre de usuario

            $this->load->model('Usuarios_model');
            $tabla = $this->Usuarios_model->cargar_usuarios();
            $datos_vista = array(
                'algun_error' =>  '',
                'tablas_esp'  =>  $tabla
            );
            //Cargar la variable que se pasará a la vista
            $this->load->view('v_usuarios',$datos_vista);
            //Llama vista
        }
        else
        {
            header('Location: /');
        }
    }
}
?>