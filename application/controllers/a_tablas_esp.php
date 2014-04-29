<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class A_tablas_esp  extends CI_Controller 
{
    public function index()
    {
        if ($this->session->userdata('nombre_usuario'))
        {
            if(isset($_POST['regresar'])){ header('Location: /index.php/tablas_esp'); }
            //Si existe variable de session de nombre de usuario
            $error = "";
            $this->load->model('Catalogos_model');
            if (isset($_POST['ok']))
            {//Se preciono el boton de cargar
                //echo("type: ".$_FILES["archivo"]["type"]);
                //echo("</br>"); jhddfgff
                //echo("name: ".$_FILES["archivo"]["name"]);
                //echo("</br>");
                //echo("size: ".$_FILES["archivo"]["size"]);
                //echo("</br>");
                if (strtoupper(substr($_FILES["archivo"]["name"],-3)) == 'XLS')
                {   
                    move_uploaded_file($_FILES["archivo"]["tmp_name"], "img/temp/temp.xls");
                    $error = $this->Catalogos_model->procesar_archivo($_POST['asignatura'],$_POST['ciclos']);
                    if ($error == "")
                    {header('Location: /index.php/tablas_esp');}
                }else
                {
                    $error = '<div class="grid_16">';
                    $error = $error. '<p class="error">El archivo no tiene extención correcta. Se requiere extención "xls"</p>';
                    $error = $error. '</div>';
                }
            }
            $datos_vista = array(
            'algun_error'       =>  $error,
            'carga_asignatura'  =>  $this->Catalogos_model->cargar_select_asignaturas(),
            'carga_ciclo'       =>  $this->Catalogos_model->cargar_select_ciclos()
            );
            //Cargar la variable que se pasará a la vista
            $this->load->view('v_a_tablas_esp',$datos_vista);
            //Llama vista
        }
        else
        {
            header('Location: /');
        }
    }
}
?>