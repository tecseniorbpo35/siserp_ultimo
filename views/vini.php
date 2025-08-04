		<!-- formulario login -->
<form id="login1" tabindex="500" action="models/control.php" method="POST">
	<div class="logo mb-3" style="display: flex; justify-content: center;">
        <img src="img/logosis.png" alt="Logo Sisproe" style="width: 200px;">
    </div>
	<h3 style="text-align: center;">Ingreso</h3>
	<div class="mail" style="margin: 0 auto; width: 80%; text-align: left;">
		<label>Usuario</label>
		<input type="text" name="usu" required style="width: 100%;">
	</div>

	<div class="passwd" style="margin: 0 auto; width: 80%; text-align: left; margin-top: 15px;">
		<label>Contraseña</label>
		<input type="password" name="con" required style="width: 100%;">
	</div>
	<div class="submit" style="margin: 0 auto; width: 80%; text-align: left; margin-top: 15px">
		<button class="dark">Ingreso</button>
	</div>
 	<div class="mail" style="margin: 0 auto; width: 80%; text-align: left; margin-top: 15px">
		<a href="#" onclick="ingreso(3);">¿Olvido su contraseña?</a>
	</div>
	<?php
		$error = isset($_GET['error']) ? $_GET['error']:NULL;
		if($error=="ok"){
			echo "Datos invalidos. Vuelve a intentarlo.";
			echo "<script>alert('Datos invalidos. Vuelve a intentarlo.');</script>";
		}
	?>
</form>