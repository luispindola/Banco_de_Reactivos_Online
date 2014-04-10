<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>

            <meta charset="iso-8859-1">

            <meta http-equiv="Content-type" content="text/html;" />

            <title>Banco de Reactivos</title>

            <link rel="stylesheet" href="/css/960.css" type="text/css" media="screen" charset="utf-8" />

            <!--<link rel="stylesheet" href="css/fluid.css" type="text/css" media="screen" charset="utf-8" />-->

            <link rel="stylesheet" href="/css/template.css" type="text/css" media="screen" charset="utf-8" />

            <link rel="stylesheet" href="/css/colour.css" type="text/css" media="screen" charset="utf-8" />

	</head>

	<body>

            <h1 id="head">Banco de Reactivos</h1>

            <ul id="navigation">

                <li><a href="/">Inicio</a></li>

                <li><span class="active">Usuarios</span></li>

                <li><a href="/index.php/tablas_esp">Tablas de Especificaciones</a></li>

                <li><a href="/index.php/reactivos">Reactivos</a></li>

                <li><a href="/index.php/cerrar_session">Cerrar sesión</a></li>

            </ul>

            <div id="content" class="container_16 clearfix">

                <!--

                <div class="grid_16">

                        <p class="error">Error</p>

                </div>

                -->

                <?php echo($algun_error); ?>

                <div class="grid_2">

                    <ul>

                        <li>Usuarios</li>

                        <li><a href="#">Agregar</a></li>

                    </ul>

                </div>

                <div class="grid_14">

                    <p>

                        <table>

                            <thead>

                                <tr>

                                    <th width="5%">Id</th>

                                    <th width="50%">Nombre</th>

                                    <th width="25%">Correo-e</th>

                                    <th width="15%">Nivel</th>

                                    <th colspan="2" width="10%">Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php echo($tablas_esp); ?>

                            </tbody>

                        </table>

                    </p>

                </div>

            </div>



            <div id="foot">

                <div class="container_16 clearfix">

                    <div class="grid_16">

                        <p align="center">

          
					@Octubre 2013:</br>

					: <a href="mailto:luispindola78@gmail.com">Ing. Luis Alejandro Sp?ndola R.</a>

                        </p>

                    </div>

                </div>

            </div>

	</body>

</html>