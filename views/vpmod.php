<?php require_once'controllers/cpmod.php'; ?>
<?php //include('controllers/ccanusu.php'); ?>
<?php //include('controllers/ctots.php'); ?>



<header class="headerxd">    
    <img src="<?php if($val) echo "img/".$val[0]['logcof'];?>" alt="" style="width: 39px; height: 39px; margin-right: 30px;">
    <h1 class="titpri"><?php if($val) echo $val[0]['titcof'];?></h1>    
</header>
<div class="home">
    <?php
    $contador = 0; 
    if ($datAll) {
        foreach ($datAll as $dt) {
            $key = array_search($dt['idmod'], $datMod);
            if ($key) {
                $mmod->setIdmod($datMd[$key - 1]["idmod"]);
                $datMus = $mmod->getAllModUsu();
                $mmod->setIdper($datMus[0]["idper"]);
                $datPer = $mmod->getAllPer();
                ?>
                <form action="mod.php" method="POST" class="formu">
                    <button class="btnmod" onclick="this.form.submit();">
                        <?php if (file_exists($dt['imgmod'])) { ?>
                            <img src="<?= $dt['imgmod']; ?>" width="100px">
                        <?php } ?>
                        <h5><?= $dt['nommod']; ?></h5>

                        <!-- MOSTRAR MOVIMIENTOS DE ENTRADA Y SALIDA PARA UN SUPERADMIN-->
                       <?php if ($dt['idmod'] == 2 && $datMus[0]['idper'] == 6) { ?>
                            <h4 class="card-title info" style="border: 2px solid #b2d8b2; background-color: #e6f5e6; padding: 10px; border-radius: 8px;">
                                <p><i class="fa-solid fa-user" style="color: #00af00;font-size: 21px;"></i> : <?= str_pad($S[0]['ctn'], 4, "0", STR_PAD_LEFT); ?></p>
                                <p><i class="fa-solid fa-user" style="color: red;font-size: 21px;"></i> : <?=str_pad($F[0]['ctn'], 4, "0", STR_PAD_LEFT);?></p>
                                </h4>
                        <?php } ?>


                        <!-- MOSTRAR MOVIMIENTOS DE ENTRADA Y SALIDA PARA UN PROFESOR-->
                        <?php if ($dt['idmod'] == 2 && $datMus[0]['idper'] == 8) { ?>

                                <?php 
                                // Inicializar contadores
                                $total_entradas = 0;
                                $total_salidas = 0;

                                if (!empty($movimientos)) {
                                    foreach ($movimientos as $mov) {
                                        if ($mov['tipmin'] == 'I') {
                                            $total_entradas++;
                                        } elseif ($mov['tipmin'] == 'F') {
                                            $total_salidas++;
                                        }
                                    }
                                }
                                ?>

                                <h4 class="card-title info" style="border: 2px solid #b2d8b2; background-color: #e6f5e6; padding: 10px; border-radius: 8px;">
                                    <p><i class="fa-solid fa-user" style="color: #00af00; font-size: 21px;"></i> : <?= str_pad($total_entradas, 4, "0", STR_PAD_LEFT); ?></p>
                                    <p><i class="fa-solid fa-user" style="color: red; font-size: 21px;"></i> : <?= str_pad($total_salidas, 4, "0", STR_PAD_LEFT); ?></p>
                                </h4>

                        <?php } ?>

                        <!-- MOSTRAR ESTUDAINTES QUE HAN LELGADO Y FALTAN POR LLEGAR PARA UN PROFESOR-->
                        <?php if ($dt['idmod'] == 3 && $datMus[0]['idper'] == 17) { ?>
                            <h4 class="card-title info" style="border: 2px solid #b2d8b2; background-color: #e6f5e6; padding: 10px; border-radius: 8px;">

                                <p> 
                                    <?= str_pad(cantUsuFichaById($_SESSION['idusu']), STR_PAD_LEFT); ?>
                                </p>
                                <p> 
                                    <?= str_pad(mostrarUsuariosFaltantes($_SESSION['idusu']), STR_PAD_LEFT); ?>
                                </p>
                            </h4>
                        <?php } ?>





                        <?php if ($dt['idmod'] == 3 && $datMus[0]['idper'] == 1) { ?>
                            <h4 class="card-title info" style="border: 2px solid #b2d8b2; background-color: #e6f5e6; padding: 10px; border-radius: 8px;">
                                <p><i class="fa-solid fa-users" style="color: #00af00;font-size: 21px;"></i> : <?php totUsus();?> </p>    
                                <p><i class="fa-solid fa-landmark" style="color: #00af00;font-size: 21px;"></i> : <?php totFics();?></p>
                                <p> <?php usuForFicsId($_SESSION['idusu']);?> </p>
                            </h4>
                        <?php } ?>

                    </button>
                    <input type="hidden" name="idmod" value="<?= $dt['idmod']; ?>">
                    <input type="hidden" name="pg" value="<?= $datPer[0]['idpag']; ?>">
                    <input type="hidden" name="idper" value="<?= $datPer[0]['idper']; ?>">
                    <input type="hidden" name="nomper" value="<?= $datPer[0]['nomper']; ?>">
                    <input type="hidden" name="ope" value="dircc">
                </form>
                <?php $contador++; ?>
            <?php } else { ?>
                <div class="btnmod2" style="display:none;">
                    <?php if (file_exists($dt['imgmod'])) { ?>
                        <img src="<?= $dt['imgmod']; ?>" width="100px">
                    <?php } ?>
                    <br>
                    <?= $dt['nommod']; ?>
                </div>
            <?php }
        }
    } ?>
</div>

<footer class="fot">
    <p>
        ...:::SISERP:::...
    <br>
        Desarrollado por: Ficha: 2879681 Análisis y Desarrollo de Software.<br>
        Aprendices:<br>
        Edith Lissette R. Ramírez - Manuel S. Moreno<br>
        Yeison Hernan O. Triviño - Gabriel G. de la Hoz<br>
        Luis Fernando M. Sanchez - Cesar Narváez<br>
        SENA Centro de Comercio y Servicios Regional Tolima - Virtual &copy; 2025. Todos los derechos reservados.<br>
        <?php if($val) echo $val[0]['foocof'];?>
        
    </p>
</footer>


<script>
    setTimeout(function () {
    const bloques = document.querySelectorAll(".info");
    bloques.forEach((el) => {
        el.style.opacity = "0";
        setTimeout(() => {
            el.style.display = "none";
        }, 1000);
    });
}, 20000);
</script>