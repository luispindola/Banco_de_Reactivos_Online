<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	<head>            <meta charset="iso-8859-1">            <meta http-equiv="Content-type" content="text/html;" />            <title>Banco de Reactivos</title>            <link rel="stylesheet" href="/css/960.css" type="text/css" media="screen" charset="utf-8" />            <!--<link rel="stylesheet" href="css/fluid.css" type="text/css" media="screen" charset="utf-8" />-->            <link rel="stylesheet" href="/css/template.css" type="text/css" media="screen" charset="utf-8" />            <link rel="stylesheet" href="/css/colour.css" type="text/css" media="screen" charset="utf-8" />	</head>	<body>            <h1 id="head">Banco de Reactivos</h1>            <ul id="navigation">                <li><a href="/">Inicio</a></li>                <li><a href="/index.php/usuarios">Usuarios</a></li>                <li><a href="/index.php/tablas_esp">Tablas de Especificaciones</a></li>                <li><span class="active">Reactivos</span></li>                <li><a href="/index.php/cerrar_session">Cerrar sesi�n</a></li>            </ul>            <div id="content" class="container_16 clearfix">                <!--                <div class="grid_16">                        <p class="error">Error</p>                </div>                -->                <?php echo($algun_error); ?>                <div class="grid_4">                    <ul>                        <li>Reactivos</li>                        <li><a href="/index.php/reactivos/agregar_dTE">Agregar Tabla de Especificaciones</a></li>                        <li><a href="#">Agregar</a></li>                    </ul>                </div>                <div class="grid_12">                    <p>                        <table>                            <thead>                                <tr>                                    <th>Asignatura</th>                                    <th width="15%">Semestre</th>                                    <th width="15%">Ciclo Esc</th>                                    <th width="15%">Reactivos</th>                                    <th width="15%">Fecha</th>                                    <th colspan="2" width="10%">Actions</th>                                </tr>                            </thead>                            <tbody>                                <?php echo($reactivos); ?>                            </tbody>                        </table>                    </p>                </div>            </div>            <div id="foot">                <div class="container_16 clearfix">                    <div class="grid_16">                        <p align="center">					@Octubre 2013:</br>					: <a href="mailto:luispindola78@gmail.com">Ing. Luis Alejandro Sp?ndola R.</a>                        </p>                    </div>                </div>            </div>	</body></html>