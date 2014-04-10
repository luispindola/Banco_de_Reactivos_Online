<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Principal extends CI_Controller 
{
    public function index()
    {
        if ($this->session->userdata('nombre_usuario'))
        {
            //Si existe variable de session de nombre de usuario
                   
            
            $datos_vista = array(
            'usuario'             =>  '<p>Usuarios</p>',
            't_especificaciones'  =>  '<p>Tablas de Especificaciones</p>',  
            'seccion3'            =>  '<p>Seccion 3</p>'
            );
            //Cargar la variable que se pasará a la vista
            $this->load->view('principal',$datos_vista);
            //Llama vista
        }
        else
        {
            header('Location: /');
        }
    }
}
?>
