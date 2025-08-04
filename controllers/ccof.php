<?php
require_once 'models/mcof.php'; // Incluye el archivo del modelo Mcof (probablemente maneja configuración del sistema)
$mcof = new Mcof(); // Crea una instancia de la clase Mcof

// Obtiene parámetros enviados por GET o POST y les asigna valores por defecto si no existen
$idcof = isset($_REQUEST['idcof']) ? $_REQUEST['idcof'] : 1; // ID de configuración (por defecto 1)
$logcof = NULL; // Variable para la imagen/logo
$titcof = isset($_POST['titcof']) ? $_POST['titcof'] : NULL; // Título de la configuración
$foocof = isset($_POST['foocof']) ? $_POST['foocof'] : NULL; // Footer de la configuración
$arcimg = isset($_FILES['arcimg']) ? $_FILES['arcimg'] : NULL; // Archivo de imagen enviado por formulario

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL; // Operación solicitada (ej. "saveCF")

$val = NULL; // Variable donde se guardará el resultado de la consulta

$dft = date("YmdHis"); // Genera un timestamp único (año-mes-día-hora-minuto-segundo)
if($arcimg) $logcof = opti($arcimg, "fotconf", "img", $dft); 
// Si se cargó una imagen, la optimiza y guarda usando la función opti()

$mcof->setIdcof($idcof); // Asigna el ID de configuración a la instancia del modelo

$val = $mcof->getOne(); // Obtiene los datos de la configuración actual

// Si la operación es guardar configuración (saveCF)
if($ope == "saveCF"){
    $mcof->setLogcof($logcof); // Asigna el logo
    $mcof->setTitcof($titcof); // Asigna el título
    $mcof->setFoocof($foocof); // Asigna el footer
    $mcof->edit(); // Guarda los cambios en la base de datos
}

// Si existe un ID de configuración, obtiene nuevamente la información actualizada
if($idcof) $val = $mcof->getOne();
?>
