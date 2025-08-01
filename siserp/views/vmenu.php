<?php include('controllers/cmenu.php'); ?> <!-- Se incluye el controlador que carga los datos del menú desde la base de datos -->
<!--menu lateral Izquierdo ya logeado dentro del modulo -->
<nav class="main-menu"> <!-- Comienza el menú lateral -->
	<div class="settings"> <!-- Encabezado del menú -->
		<div style="width: 300px;">
<!--			<i class="fa-solid fa-bus" style="display: inline-block;"></i> --> <!-- Ícono comentado -->
			<img src="/img/logosis.png" width="80px"> <!-- Logo del sistema -->
			<span class="timen">&nbsp;<?php if($val) echo $val[0]['titcof'] ?></span> <!-- Se imprime el título configurado dinámicamente desde la base de datos -->
		</div>
	</div>

	<div class="scrollbar" id="style-1"> <!-- Contenedor con scroll para los ítems del menú -->
		<ul> <!-- Lista principal del menú -->
			<li>  
				<!-- Enlace al módulo principal -->                                 
				<a href="mod.php">
					<!-- Ícono de inicio -->      
					<i class="fa fa-solid fa-home" style="top:10px;"></i>
					<span class="nav-text">Home</span> <!-- Texto del ítem -->
				</a>
			</li>   

			<?php 
			// Si hay datos en $dat (ítems del menú), se recorren para generar cada enlace dinámicamente
			if($dat){
				foreach ($dat as $dt) {
			?> 
					<li class="darkerli"> <!-- Ítem del menú -->
						<a href="home.php?pg=<?=$dt['idpag'];?>"> <!-- Enlace a la página correspondiente -->
							<i class="<?=$dt['icopag'];?>" style="top:10px;"></i> <!-- Ícono dinámico del menú -->
							<span class="nav-text"><?=$dt['nompag'];?></span> <!-- Nombre del ítem del menú -->
						</a>
					</li>
			<?php 
				}
			}
			?>
		</ul>

		<ul class="logout"> <!-- Lista separada para acciones como salir del sistema -->

<!-- Ítems comentados que podrían usarse en el futuro -->
<!--
			<li>                                 
				<a href="#">
					<i class="fa fa-solid fa-user"></i>
					<span class="nav-text">Usuario</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-solid fa-question-circle"></i>
					<span class="nav-text">Ayuda</span>
				</a>
			</li>
-->

			<li>
				<a href="views/vsal.php"> <!-- Enlace para cerrar sesión -->
					<i class="fa fa-solid fa-power-off"></i> <!-- Ícono de apagado/salida -->
					<span class="nav-text">Salir</span> <!-- Texto de la opción -->
				</a>
			</li>

			<li>
				<!-- pie de pagina menu desplegable -->
				<div class="pie2">
					<?php if($val) echo $val[0]['foocof'] ?> <!-- Se imprime el pie de página del menú desde la configuración en base de datos -->
					<!-- <br>Centro de Desarrollo Agroempresarial &copy; 2023. Chía - Cundinamarca 
					<br><small>Todos los derechos reservados.</small><br><br> --> <!-- Pie comentado alternativo -->
				</div>
			</li>
		</ul>
	</div>

	<div class="pie"> <!-- Espacio adicional para pie visual o decorativo -->
	</div>
</nav> <!-- Fin del menú lateral -->
