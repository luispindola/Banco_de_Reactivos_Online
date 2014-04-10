<?php
class Reactivos_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
    function cargar_reactivos($variable) 
    {
        $SQL = "SELECT asignatura.asignatura, reactivos.id_asignatura, asignatura.semestre, reactivos.ciclo, ";
        $SQL = $SQL."reactivos.f_creacion, COUNT(reactivos.id_reactivos) as reactivos ";
        $SQL = $SQL."FROM asignatura INNER JOIN reactivos ON asignatura.id_asignatura = reactivos.id_asignatura ";
        $SQL = $SQL."GROUP BY asignatura.asignatura, asignatura.semestre, reactivos.ciclo, ";
        $SQL = $SQL."reactivos.f_creacion";
        if (isset($variable))
        {$SQL = $SQL." ORDER BY ".$variable;}
        $query = $this->db->query($SQL);//Ejecuta el query
        $salida='';
        if ($query->num_rows() > 0)
        {
            $this->load->model('Fechas_model');
            foreach ($query->result() as $row)
            {
                $salida = $salida.'<tr>';
                $salida = $salida.'<td>'.$row->asignatura.'</td>';
                $salida = $salida.'<td>'.$row->semestre.'</td>';
                $salida = $salida.'<td>'.$row->ciclo.'</td>';
                $salida = $salida.'<td>'.$row->reactivos.'</td>';
                $salida = $salida.'<td>'.$this->Fechas_model->nicetime($row->f_creacion).'</td>';
                $salida = $salida.'<td><a href="/index.php/reactivos/editar_reactivos/'.$row->id_asignatura.'/'.$row->ciclo.'" class="edit">Editar Reactivos</a></td>';
                $salida = $salida.'<td><a href="#" class="delete">Borrar</a></td>';
                $salida = $salida.'</tr>';
            }
            
        }
        return $salida;
    }
    function cargar_tabla_esp($variable)
    {
        $SQL = "SELECT asignatura.asignatura, asignatura.id_asignatura, asignatura.semestre, tablas_esp.ciclo, ";
        $SQL = $SQL."tablas_esp.f_creacion, COUNT(tablas_esp.id_tablas_esp) as reactivos ";
        $SQL = $SQL."FROM asignatura INNER JOIN tablas_esp ON asignatura.id_asignatura = tablas_esp.id_asignatura ";
        $SQL = $SQL."GROUP BY asignatura.asignatura, asignatura.semestre, tablas_esp.ciclo, ";
        $SQL = $SQL."tablas_esp.f_creacion";
        if (isset($variable))
        {$SQL = $SQL." ORDER BY ".$variable;}
        $query = $this->db->query($SQL);//Ejecuta el query
        $salida='';
        if ($query->num_rows() > 0)
        {
            $this->load->model('Fechas_model');
            foreach ($query->result() as $row)
            {
                $salida = $salida.'<tr>';
                $salida = $salida.'<td>'.$row->asignatura.'</td>';
                $salida = $salida.'<td>'.$row->semestre.'</td>';
                $salida = $salida.'<td>'.$row->ciclo.'</td>';
                $salida = $salida.'<td>'.$row->reactivos.'</td>';
                $salida = $salida.'<td>'.$this->Fechas_model->nicetime($row->f_creacion).'</td>';
                $salida = $salida.'<td><a href="/index.php/reactivos/agregar_dTE/'.$row->id_asignatura.'/'.$row->ciclo.'" class="edit">Agregar Tabla de Esp.</a></td>';
                
                $salida = $salida.'</tr>';
            }
            
        }
        return $salida;
    }
    function cargar_en_bd_reactivos($id_asignatura, $ciclo)
    {
        $ciclo = str_replace('%20',' ',$ciclo);//Quitar caracteres de url
        $SQL = "SELECT * FROM tablas_esp WHERE ((id_asignatura = ".$id_asignatura.") AND (ciclo = '".$ciclo."'))";
        $SQL = $SQL." ORDER BY id_tablas_esp";
        $query = $this->db->query($SQL);//Ejecuta el query
        if ($query->num_rows() > 0)
        {
            $this->load->model('Reactivos_model');//BBuscar el id_reactivos
            $id_reactivos = $this->Reactivos_model->obtener_ultimo_id_reactivos();
            foreach ($query->result() as $row)
            {
                $id_reactivos++;
                $SQL = "INSERT INTO reactivos (id_reactivos, id_tablas_esp, id_asignatura, ciclo, parcial, bloque, ";
                $SQL = $SQL."secuencia, apr_indi_obj, saberes, dificultad, f_creacion, id_usuario) VALUES (";
                $SQL = $SQL.$id_reactivos.", ";
                $SQL = $SQL.$row->id_tablas_esp.", ";
                $SQL = $SQL.$row->id_asignatura.", ";
                $SQL = $SQL."'".$row->ciclo."', ";
                $SQL = $SQL."'".$row->parcial."', ";
                $SQL = $SQL."'".$row->bloque."', ";
                $SQL = $SQL."'".$row->secuencia."', ";
                $SQL = $SQL."'".$row->apr_indi_obj."', ";
                $SQL = $SQL."'".$row->saberes."', ";
                $SQL = $SQL."'".$row->dificultad."', ";
                $SQL = $SQL."'".date("Y-m-d H:i:s")."', ";
                $SQL = $SQL.$this->session->userdata('id_usuarios');
                $SQL = $SQL.");";
                $this->db->query($SQL);//Ejecuta el query
                //echo("x".$id_reactivos);
            }
        }
    }
    function obtener_ultimo_id_reactivos()
    {
         $ssql = "SELECT MAX(id_reactivos) AS max_id FROM reactivos";
         $query = $this->db->query($ssql);//Ejecuta el query
         $row = $query->row_array();//Carga el registro en un arreglo
         return $row['max_id'];
    }
    function existe($id_asignatura, $ciclo)
    {
        $ciclo = str_replace('%20',' ',$ciclo);//Quitar caracteres de url
        $SQL = "SELECT * FROM reactivos WHERE ((id_asignatura = ".$id_asignatura.") AND (ciclo = '".$ciclo."'))";
        $query = $this->db->query($SQL);//Ejecuta el query
        if ($query->num_rows() > 0)
        {return true;}else{return false;}
        echo $SQL;
    }
    function cargar_lista_reactivos($id_asignatura, $ciclo)
    {
        $SQL = "SELECT * FROM reactivos WHERE ((id_asignatura = ".$id_asignatura.") AND (ciclo = '".$ciclo."')) ";
        $SQL = $SQL."ORDER BY id_reactivos";
        //echo $SQL;
        $query = $this->db->query($SQL);//Ejecuta el query
        if ($query->num_rows() > 0)
        {
            $salida='';
            $this->load->model('Fechas_model');
            foreach ($query->result() as $row)
            {
                $salida = $salida.'<tr>';
                $salida = $salida.'<td>'.$row->id_reactivos.'</td>';
                $salida = $salida.'<td>'.$row->parcial.'</td>';
                $salida = $salida.'<td>'.$row->bloque.'</td>';
                $salida = $salida.'<td>'.$row->secuencia.'</td>';
                $salida = $salida.'<td>'.$row->apr_indi_obj.'</td>';
                //$salida = $salida.'<td>'.$row->saberes.'</td>';
                //$salida = $salida.'<td>'.$row->dificultad.'</td>';
                $salida = $salida.'<td>'.$row->a_revision.'</td>';
                if ($row->f_editor <> "0000-00-00 00:00:00")
                {$salida = $salida.'<td>'.$this->Fechas_model->nicetime($row->f_editor).'</td>';}
                else
                {$salida = $salida.'<td>Nunca</td>';}
                $salida = $salida.'<td><a href="/index.php/reactivos/editar_reactivo/'.$row->id_reactivos.'" class="edit">Editar</a></td>';
                $salida = $salida.'</tr>';
            }
        }
        return $salida;
    }
    function cargar_reactivo($id_reactivos)
    {
        $SQL = "SELECT * FROM reactivos WHERE id_reactivos = ".$id_reactivos;
        $query = $this->db->query($SQL);//Ejecuta el query
        return $query->row_array();//Carga el registro en un arreglo
    }
    function guardar_reactivo($id_reactivo, $datos)
    {
        $SQL = "UPDATE reactivos SET ";
        $SQL = $SQL."reactivo = '".str_replace('\\','999y999',$datos['reactivo'])."', ";
        $SQL = $SQL."opcion_a = '".str_replace('\\','999y999',$datos['opcion_a'])."', ";
        $SQL = $SQL."opcion_b = '".str_replace('\\','999y999',$datos['opcion_b'])."', ";
        $SQL = $SQL."opcion_c = '".str_replace('\\','999y999',$datos['opcion_c'])."', ";
        $SQL = $SQL."opcion_d = '".str_replace('\\','999y999',$datos['opcion_d'])."', ";
        $SQL = $SQL."opcion_correcta = '".$datos['opcion_correcta']."', ";
        $SQL = $SQL."mlog = ".$datos['mlog'].", ";
        $SQL = $SQL."a_revision = '".$datos['a_revision']."', ";
        $SQL = $SQL."f_editor = '".$datos['f_editor']."', ";
        $SQL = $SQL."id_usuario_editor = '".$datos['id_usuario_editor']."' ";
        $SQL = $SQL."WHERE id_reactivos = ".$id_reactivo;
        $query = $this->db->query($SQL);//Ejecuta el query
    }
}
?>
