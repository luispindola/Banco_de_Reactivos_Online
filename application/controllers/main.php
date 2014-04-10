<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller 
{
    public function index()
    {
        $this->load->model('Usuarios_model');
        //Cargo el modelo Usiarios
        if ($this->session->userdata('nombre_usuario'))
        {
            //Si existe variable de session de nombre de usuario
            $this->load->helper('url');
            
            header('Location: '.  site_url('principal'));
            //echo 'acceso concedido';
            //$this->session->sess_destroy();//Solo pruebas
        }
        else
        {
            //Si no existe variable de session, muestra formulario de inicio
            if (isset($_POST['correo']))
            {//Existe variable post
             //checando contraseña
                if ($this->Usuarios_model->checar_existe($_POST['correo']))
                {//El usuario existe
                    if ($this->Usuarios_model->checar_contrasena($_POST['correo'],$_POST['contrasena']))
                    {//Contraseña correcta
                        if ($this->session->userdata('captcha_text'))
                        {//Si existe capcha que verificar
                            if ((isset($_POST['captcha'])) && ($_POST['captcha'] == $this->session->userdata('captcha_text')))
                            {
                                //LA CONTRASEÑA ES CORRECTA JUNTO CON EL CAPTCHA
                                $formulario = 'La contraseña y el captcha es correcto';
                                $arreglo_borrar = array('captcha_text' => '', 'contador_intentos' => '');
                                $this->session->unset_userdata($arreglo_borrar);
                                $this->Usuarios_model->carga_usuario_session($_POST['correo']);
                                $this->load->helper('file');//Cargar Helper file
                                delete_files('img/temp/');//Borrar imagenes temporales de captchas
                                header("Location: /");//Se regresa a la pag inicio con variables de session asign
                            }
                            else
                            {//Capcha incorrecto
                                $formulario = "<FORM method='post'>";
                                $formulario = $formulario.'<p class="error">Los dígitos capturados de la imagen no son correctos</p>';
                                $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                                $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text" value="'.$_POST['correo'].'"/></p>';
                                $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" value="'.$_POST['contrasena'].'"/></p>';
                                $this->load->helper('captcha');//Leer helper para captchas
                                $this->load->helper('string');//Leer helper para string Random
                                $captcha_text = random_string('numeric', 6);//Generar texto aleatorio
                                $this->session->set_userdata('captcha_text',$captcha_text);//Guardarlo en variable de sess
                                $vals = array(
                                'word'	     => $captcha_text,
                                'img_path'   => '/home/spin100/public_html/SPIN/proBancoReact/img/temp/',
                                'img_url'    => 'http://probancoreact.spin100.com/img/temp/',
                                'font_path'  => 'C:/Users/LuisAlejandro/Documents/Proyectos/Banco de Reactivos/USB Web Server/root/img/font/icbmss25.ttf',
                                'img_width'  => '130',
                                'img_height' => 40,
                                'expiration' => 7200
                                );//Arreglo de conf captcha
                                $cap = create_captcha($vals);
                                $formulario = $formulario.'<p>Escribe los 6 dígitos contenidos en la siguiente imagen:<input id="captcha" name="captcha" size="16" type="text"/>'.$cap['image'].'</p>';                               
                                $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                                $formulario = $formulario."</FORM>"; 
                            }
                        }
                        else
                        {
                            //CONTRASEÑA ES CORRECTA
                            $formulario = 'La contraseña es correcta';
                            $this->Usuarios_model->carga_usuario_session($_POST['correo']);
                            header("Location: /");//Se regresa a la pag inicio con variables de session asign
                        }  
                    }
                    else
                    {//Contraseña incorrecta
                        if ($this->session->userdata('contador_intentos'))
                        {//Si existe variable
                            $contador_intentos = $this->session->userdata('contador_intentos') + 1;
                        }
                        else
                        {//No existe variable
                            $contador_intentos = 1;
                        }
                        $this->session->set_userdata('contador_intentos',$contador_intentos);
                        $formulario = "<FORM method='post'>";
                        if ($contador_intentos > 2)
                        {
                            $formulario = $formulario.'<p class="error">La contraseña ingresada no es correcta, intentos: '.$contador_intentos.'</p>';
                        }
                        else 
                        {
                            $formulario = $formulario.'<p class="error">La contraseña ingresada no es correcta</p>';
                        }
                        $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                        $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text" value="'.$_POST['correo'].'"/></p>';
                        $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" /></p>';
                        if ($contador_intentos >2)
                        {
                            $this->load->helper('captcha');//Leer helper para captchas
                            $this->load->helper('string');//Leer helper para string Random
                            $captcha_text = random_string('numeric', 6);//Generar texto aleatorio
                            $this->session->set_userdata('captcha_text',$captcha_text);//Guardarlo en variable de sess
                            $vals = array(
                            'word'	 => $captcha_text,
                            'img_path'	 => '/home/spin100/public_html/SPIN/proBancoReact/img/temp/',
                            'img_url'	 => 'http://probancoreact.spin100.com/img/temp/',
                            'font_path'	 => 'C:/Users/LuisAlejandro/Documents/Proyectos/Banco de Reactivos/USB Web Server/root/img/font/icbmss25.ttf',
                            'img_width'	 => '130',
                            'img_height' => 40,
                            'expiration' => 7200
                            );//Arreglo de conf captcha
                            $cap = create_captcha($vals);
                            $formulario = $formulario.'<p>Escribe los 6 dígitos contenidos en la siguiente imagen:<input id="captcha" name="captcha" size="16" type="text"/>'.$cap['image'].'</p>';
                        }
                        $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                        $formulario = $formulario."</FORM>";     
                    }
                }   
                else
                {//El correo electrónico no esta registrado
                    $formulario = "<FORM method='post'>";
                    $formulario = $formulario.'<p class="error">El correo electrónico ingresado no esta registrado en el sistema</p>';
                    $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                    $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text" value="'.$_POST['correo'].'"/></p>';
                    $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" /></p>';   
                    if ($this->session->userdata('contador_intentos'))
                    {
                        $contador_intentos = $this->session->userdata('contador_intentos');
                        if ($contador_intentos > 2)
                        {
                            $this->load->helper('captcha');//Leer helper para captchas
                            $this->load->helper('string');//Leer helper para string Random
                            $captcha_text = random_string('numeric', 6);//Generar texto aleatorio
                            $this->session->set_userdata('captcha_text',$captcha_text);//Guardarlo en variable de sess
                            $vals = array(
                            'word'	 => $captcha_text,
                            'img_path'	 => '/home/spin100/public_html/SPIN/proBancoReact/img/temp/',
                            'img_url'	 => 'http://probancoreact.spin100.com/img/temp/',
                            'font_path'	 => '/home/spin100/public_html/SPIN/proBancoReact/img/font/icbmss25.ttf',
                            'img_width'	 => '130',
                            'img_height' => 40,
                            'expiration' => 7200
                            );//Arreglo de conf captcha
                            $cap = create_captcha($vals);
                            $formulario = $formulario.'<p>Escribe los 6 dígitos contenidos en la siguiente imagen:<input id="captcha" name="captcha" size="16" type="text"/>'.$cap['image'].'</p>';
                        }
                    }
                    $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                    $formulario = $formulario."</FORM>";
                }           
            }
            else 
            {//No hay variable post
                if ($this->session->userdata('contador_intentos'))
                {//Si existe variable de intentos fallidos
                    $contador_intentos = $this->session->userdata('contador_intentos');
                    if ($contador_intentos > 2)
                    {
                        $formulario = "<FORM method='post'>";
                        $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                        $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text"/></p>';
                        $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" /></p>';
                        $this->load->helper('captcha');//Leer helper para captchas
                        $this->load->helper('string');//Leer helper para string Random
                        $captcha_text = random_string('numeric', 6);//Generar texto aleatorio
                        $this->session->set_userdata('captcha_text',$captcha_text);//Guardarlo en variable de sess
                        $vals = array(
                        'word'	 => $captcha_text,
                        'img_path'	 => '/home/spin100/public_html/SPIN/proBancoReact/img/temp/',
                        'img_url'	 => 'http://probancoreact.spin100.com/img/temp/',
                        'font_path'	 => '/home/spin100/public_html/SPIN/proBancoReact/img/font/icbmss25.ttf',
                        'img_width'	 => '130',
                        'img_height' => 40,
                        'expiration' => 7200
                        );//Arreglo de conf captcha
                        $cap = create_captcha($vals);
                        $formulario = $formulario.'<p>Escribe los 6 dígitos contenidos en la siguiente imagen:<input id="captcha" name="captcha" size="16" type="text"/>'.$cap['image'].'</p>';
                        $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                        $formulario = $formulario."</FORM>";     
                    }
                    else
                    {
                        $formulario = "<FORM method='post'>";
                        $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                        $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text" /></p>';
                        $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" /></p>';
                        $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                        $formulario = $formulario."</FORM>";
                    }
                }
                else
                {
                    $formulario = "<FORM method='post'>";
                    $formulario = $formulario.'<p>Ingrese sus datos de acceso:</p>';
                    $formulario = $formulario.'<p>Correo electrónico: <input id="correo" name="correo" size="16" type="text" /></p>';
                    $formulario = $formulario.'<p>Contraseña:<input id="contrasena" name="contrasena" type="password" /></p>';
                    $formulario = $formulario.'<p><input id="ok" name="ok" type="submit" value="Entrar" /></p>';
                    $formulario = $formulario."</FORM>";
                }
            }
            $datos_vista['formulario'] = $formulario;
            //Cargar la variable que se pasará a la vista
            $this->load->view('iniciosession',$datos_vista);
            //Llama vista
        }
    }
}