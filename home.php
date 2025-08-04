<!-- seguridad de la página -->
<?php 
require_once ("models/seguridad.php"); // Verifica si el usuario ha iniciado sesión correctamente
$snomcc = isset($_SESSION["nomcc"]) ? $_SESSION["nomcc"] : NULL; // Obtiene el nombre del centro de costos desde la sesión
$ano = date("Y"); // Obtiene el año actual
?>
<!DOCTYPE html>
<html class="menu"> <!-- Clase para dar estilo personalizado al menú -->
<html lang="es"> <!-- Idioma español para el contenido -->

<head>
	<!-- Metadatos y configuración de compatibilidad -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CSS y JS desde CDN y local -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="shortcut icon" href="img/logosis.png">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

	<!-- DataTables para manejo de tablas -->
	<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

	<!-- jQuery UI para componentes adicionales -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- Íconos Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

	<!-- Bootstrap 3 (uso duplicado, poco recomendable) -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">

	<!-- Font Awesome duplicado -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />

	<!-- Script personalizado -->
	<script src="js/java.js"></script>

	<!-- DataTables con botones de exportación -->
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
	<script src="js/combobox.js"></script>

	<!-- Hojas de estilo para DataTables y Bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

	<!-- Fuentes de Google -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,700&display=swap" rel="stylesheet">

	<!-- Estilos personalizados -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/menu.css">

	<!-- Título dinámico con año -->
	<title>SisErp <?=$ano;?></title>
</head>

<body>
	<header>
		<?php
			// Zona horaria local
			date_default_timezone_set('America/Bogota');

			// Conexión a la base de datos
			require_once ('models/conexion.php');

			// Optimización de imagen del logo (responsivo)
			require_once ('controllers/optimg.php');

			// Envío de datos del controlador ccof
			require_once ('controllers/ccof.php');

			$nu = 2;
			$alto = "0px";
			$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : 1102; // Página actual o por defecto la 1102
			$pefid = isset($_SESSION["pefid"]) ? $_SESSION["pefid"] : NULL; // Perfil del usuario
			$ope = isset($_GET['ope']) ? $_GET['ope'] : false; // Operación get simple
			$opera = isset($_GET['opera']) ? $_GET['opera'] : false; // Operación alternativa

			// Carga del encabezado con sesión iniciada
			require_once ("views/header.php");

			// Espacio para mostrar errores
			echo '<div id="err"></div>';

			// Carga del menú lateral
			require_once ("views/vmenu.php");

			// Determina el contenedor a usar
			if($pg==1405) $cont='contenido2'; else $cont='contenido';
		?>
	</header>

	<!-- Sección principal de contenido -->
	<section class="<?=$cont;?>">
		<?php 
			$mos = 0; // Variable para mostrar ayuda o no
			$est = 0; // Estado de la vista (edición o visualización)
			$rut = validar($pg); // Valida la página solicitada

			if ($rut){
				$mos = $rut[0]['mospas']; // Define si se debe mostrar algo
		    	if($opera=="edi" OR $ope=="edi") $est=1; // Estado en modo edición
				echo ayuda($pg); // Muestra ayuda contextual
		    	echo "<script>err();</script>"; // Ejecuta función de errores en JS
				$icono = substr($rut[0]['icopag'],3); // Icono de la página
				require_once ($rut[0]['rutpag']); // Carga la vista correspondiente
			}else{
				// Si no es válida la página, redirige al home
				echo "<script>window.location='home.php?pg=1102';</script>";
			}
		?>
	</section>

	<footer>
		<!-- Espacio reservado para el pie de página -->
	</footer>
</body>

<!-- Scripts adicionales -->
<script src="js/valida.js"></script>
<script type="text/javascript">
	ocul(<?=$mos;?>,<?=$est;?>); // Ejecuta función para mostrar/ocultar elementos en función del estado
</script>
</html>
