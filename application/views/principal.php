<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">	<head>		<meta charset="iso-8859-1">		<meta http-equiv="Content-type" content="text/html;" />		<title>Banco de Reactivos</title>		<link rel="stylesheet" href="/css/960.css" type="text/css" media="screen" charset="utf-8" />		<link rel="stylesheet" href="/css/template.css" type="text/css" media="screen" charset="utf-8" />		<link rel="stylesheet" href="/css/colour.css" type="text/css" media="screen" charset="utf-8" />		<!--[if IE]><![if gte IE 6]><![endif]-->		<script src="/js/glow/1.7.0/core/core.js" type="text/javascript"></script>		<script src="/js/glow/1.7.0/widgets/widgets.js" type="text/javascript"></script>		<link href="/js/glow/1.7.0/widgets/widgets.css" type="text/css" rel="stylesheet" />		<script type="text/javascript">			glow.ready(function(){				new glow.widgets.Sortable(					'#content .grid_5, #content .grid_6',					{						draggableOptions : {							handle : 'h2'						}					}				);			});		</script>		<!--[if IE]><![endif]><![endif]-->	</head>	<body>		<h1 id="head">Banco de Reactivos</h1>		<ul id="navigation">			<li><span class="active">Inicio</span></li>			<li><a href="/index.php/usuarios">Usuarios</a></li>			<li><a href="/index.php/tablas_esp">Tablas de Especificaciones</a></li>			<li><a href="/index.php/reactivos">Reactivos</a></li>                        <li><a href="/index.php/cerrar_session">Cerrar sesi�n</a></li>		</ul>			<div id="content" class="container_16 clearfix">				<div class="grid_5">					<div class="box">						<h2>Usuarios</h2>						<div class="utils">							<a href="#">Ver Mas:</a>						</div>						<p><?php echo($usuario); ?></p>					</div>				</div>				<div class="grid_6">					<div class="box">						<h2>Tablas de Especificaciones</h2>						<div class="utils">							<a href="#">Ver Mas</a>						</div>						<p><?php echo($t_especificaciones); ?></p>					</div>				</div>				<div class="grid_5">					<div class="box">						<h2>...</h2>						<div class="utils">							<a href="#">Ver Mas</a>						</div>						<p><?php echo($seccion3); ?></p>					</div>				</div>			</div>		<div id="foot">			<div class="container_16 clearfix">				<div class="grid_16">					<p align="center">					@Octubre 2013:</br>					: <a href="mailto:luispindola78@gmail.com">Ing. Luis Alejandro Sp?ndola R.</a>					</p>				</div>			</div>		</div>	</body></html>