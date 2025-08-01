<?php

// Obtiene el valor de "pg" de la URL o formulario (GET o POST)
$pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : NULL;

// Si no se ha enviado "pg" o si es igual a 1324
if (!$pg or $pg == 1324) {
    // Se establecen valores en la sesión (probablemente para el perfil del usuario)
    $_SESSION["idper"] = 5;              // Asigna un ID de perfil
    $_SESSION["pefnom"] = "Datos Básicos"; // Nombre del perfil
}

// Si no se envió "pg", se asigna un nombre de perfil genérico
if (!$pg) {
    $_SESSION["pefnom"] = "Módulos";
}
?>

<!-- Contenedor principal del banner del usuario -->
<div class="banusu">
    <div class="banint">
        <?php
        // Obtiene el nombre completo desde la sesión
        $nomcompleto = $_SESSION['nomusu'];

        // Divide el nombre completo en partes usando los espacios
        $partes = explode(" ", $nomcompleto);

        // Primer nombre (primera palabra)
        $prinom = $partes[0];        

        // Si el nombre tiene 3 palabras o menos, toma la segunda como apellido
        if (count($partes) <= 3) 
            $priape = $partes[1];                          
        else 
            // Si tiene más de 3 palabras, toma la tercera como apellido
            $priape = $partes[2];                                

        // Muestra en pantalla el primer nombre y el apellido seleccionado
        echo $prinom . " " . $priape;
        ?>        
        <br>
        <small>
            <!-- Muestra debajo el nombre del perfil (Datos Básicos o Módulos) -->
            <?= $_SESSION['pefnom']; ?>
        </small>
    </div>

    <?php 
    // Se vuelve a obtener el valor de pg (esto es redundante, ya se obtuvo arriba)
    $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : NULL; 
    ?>

    <!-- Icono de acceso a "Datos Personales" -->
    <div class="banint" style="margin-top: 5px; color: #ff8e31;">
        <a href="home.php?pg=1324" style="color: #ff8e31;">
            <i class="fa-solid fa-credit-card fa-2x" style="color: #ffffff;" title="Datos Personales"></i>
        </a>
    </div>

    <!-- Icono de "Salir" (cierra sesión) -->
    <div class="banint" style="margin-top: 5px; color: #ff8e31;">
        <a href="views/vsal.php" style="color: #ff8e31;">
            <i class="fa-solid fa-power-off fa-2x" style="color: #ffffff;" title="Salir"></i>
        </a>
    </div>
</div>
