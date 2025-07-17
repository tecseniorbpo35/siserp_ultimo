<?php include('controllers/cmenu.php'); ?>

<nav class="main-menu">
	<div class="settings">
		<div style="width: 300px;">
<!--			<i class="fa-solid fa-bus" style="display: inline-block;"></i> -->
			<img src="/mercado/img/logosis.png" width="40px">
			<span class="timen">&nbsp;<?php if($val) echo $val[0]['titcof'] ?></span>
		</div>
	</div>
	<div class="scrollbar" id="style-1">
		<ul>
			<li>                                   
				<a href="mod.php">
					<i class="fa fa-solid fa-home" style="top:10px;"></i>
					<span class="nav-text">Módulos</span>
				</a>
			</li>   
<!--			<li class="darkerlishadow"> -->	 
			<?php 
			if($dat){
				foreach ($dat as $dt) {
			?> 
					<li class="darkerli">
						<a href="home.php?pg=<?=$dt['idpag'];?>">
							<i class="<?=$dt['icopag'];?>" style="top:10px;"></i>
							<span class="nav-text"><?=$dt['nompag'];?></span>
						</a>
					</li>
			<?php 
				}
			}
			?>
		</ul>
		<ul class="logout">
<!--			<li>                                 
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
			</li> -->
			<li>
				<a href="views/vsal.php">
					<i class="fa fa-solid fa-power-off"></i>
					<span class="nav-text">Salir</span>
				</a>
			</li>
			<li>
				<div class="pie2">
					<?php if($val) echo $val[0]['foocof'] ?>
					<!-- <br>Centro de Desarrollo Agroempresarial &copy; 2023. Chía - Cundinamarca 
					<br><small>Todos los derechos reservados.</small><br><br> -->
				</div>
			</li>
		</ul>
	</div>
	<div class="pie">
	</div>
</nav>
