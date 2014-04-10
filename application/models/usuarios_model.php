<?php
class Usuarios_model extends CI_Model 
{
   function __construct()
   {
      parent::__construct();
   }
   function checar_existe($correo)
   {
        $ssql = "SELECT * FROM usuarios WHERE correo = '".$correo."'";
        $query = $this->db->query($ssql);//Ejecuta el query
        if ($query->row_array())//Carga el registro en un arreglo
        {$retorno = true;}else {$retorno = false;}
        return $retorno;
   }
   function checar_contrasena($correo, $contrasena)
   {    
        $this->load->model('Encripta_model');
        $ssql = "SELECT * FROM usuarios WHERE correo = '".$correo."'";
        $query = $this->db->query($ssql);//Ejecuta el query
        $row = $query->row_array();//Carga el registro en un arreglo
        //echo($this->Encripta_model->encrypt($contrasena,'Bolichon0912'));
        if ($row['contrasena'] == $this->Encripta_model->encrypt($contrasena,'Bolichon0912'))
        {$retorno = true;}else {$retorno = false;}
        return $retorno;
   }
   function carga_usuario_session($correo)
   {
        $ssql = "SELECT * FROM usuarios WHERE correo = '".$correo."'";
        $query = $this->db->query($ssql);//Ejecuta el query
        $row = $query->row_array();//Carga el registro en un arreglo
        $this->session->set_userdata($row);//Se cargan los campos de la tabla en la session 
   }
   function cargar_usuarios()
   {
        $SQL = "SELECT * FROM usuarios";
        $query = $this->db->query($SQL);//Ejecuta el query
        $query = $this->db->query($SQL);//Ejecuta el query
        $salida='';
        if ($query->num_rows() > 0)
        {
            
            foreach ($query->result() as $row)
            {
                $salida = $salida.'<tr>';
                $salida = $salida.'<td>'.$row->id_usuarios.'</td>';
                $salida = $salida.'<td>'.$row->nombre_usuario.'</td>';
                $salida = $salida.'<td>'.$row->correo.'</td>';
                $salida = $salida.'<td>'.$row->nivel_acceso.'</td>';
                
                $salida = $salida.'<td><a href="#" class="edit">Editar</a></td>';
                $salida = $salida.'<td><a href="#" class="delete">Borrar</a></td>';
                $salida = $salida.'</tr>';
            }
            
        }
        return $salida;
    }
}
?>