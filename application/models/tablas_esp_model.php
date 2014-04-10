<?php
class Tablas_esp_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
    }
    function cargar_tabla_esp($variable) 
    {
        $SQL = "SELECT asignatura.asignatura, asignatura.semestre, tablas_esp.ciclo, ";
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
                $salida = $salida.'<td><a href="#" class="edit">Editar</a></td>';
                $salida = $salida.'<td><a href="#" class="delete">Borrar</a></td>';
                $salida = $salida.'</tr>';
            }
            
        }
        return $salida;
    }
}
?>
