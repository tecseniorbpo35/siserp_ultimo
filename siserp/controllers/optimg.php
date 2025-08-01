<?php
// Función para optimizar o guardar imágenes, videos o archivos Excel subidos al servidor
function opti($pict, $nomimg, $rut, $pre){
    ini_set('memory_limit', '512M'); // Aumenta el límite de memoria para procesar imágenes grandes
    $nombre = '';
    if($pict){ // Si se recibe un archivo
        $max_ancho = 1024; // Ancho máximo permitido para la imagen
        $max_alto = 800;   // Alto máximo permitido para la imagen
        $docext = pathinfo($pict["name"], PATHINFO_EXTENSION); // Obtiene la extensión del archivo

        // Verifica si es una imagen válida
        if($docext=="png" or $docext=="jpg" or $docext=="jpeg" or $docext=="jfif"){
            $medidasimagen = getimagesize($pict['tmp_name']); // Obtiene el tamaño de la imagen

            // Si la imagen ya cumple con las dimensiones y tamaño (menor a 1MB), la guarda sin cambios
            if($medidasimagen[0]<=$max_ancho && $pict['size']<1048576){
                $nombre = $rut.'/'.$nomimg."_".$pre.".".$docext;
                move_uploaded_file($pict['tmp_name'], $nombre);
            }else{
                // Si la imagen es grande, se redimensiona
                $nombre = $rut.'/'.$nomimg."_".$pre.".".$docext;
                $rtOriginal=$pict['tmp_name'];

                // Crea la imagen original según su tipo
                if($pict['type']=='image/jpeg'){
                    $original = imagecreatefromjpeg($rtOriginal);
                }else if($pict['type']=='image/png'){
                    $original = imagecreatefrompng($rtOriginal);
                }else if($pict['type']=='image/gif'){
                    $original = imagecreatefromgif($rtOriginal);
                }

                // Calcula las nuevas dimensiones manteniendo la proporción
                list($ancho,$alto)=getimagesize($rtOriginal);
                $x_ratio = $max_ancho / $ancho;
                $y_ratio = $max_alto / $alto;

                if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
                    $ancho_final = $ancho;
                    $alto_final = $alto;
                }elseif (($x_ratio * $alto) < $max_alto){
                    $alto_final = ceil($x_ratio * $alto);
                    $ancho_final = $max_ancho;
                }else{
                    $ancho_final = ceil($y_ratio * $ancho);
                    $alto_final = $max_alto;
                }

                // Crea un lienzo con las nuevas dimensiones y copia la imagen redimensionada
                $lienzo=imagecreatetruecolor($ancho_final,$alto_final); 
                imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);

                // Guarda la imagen optimizada según el tipo
                if($pict['type']=='image/jpeg'){
                    imagejpeg($lienzo,$nombre);
                }else if($pict['type']=='image/png'){
                    imagepng($lienzo,$nombre);
                }else if($pict['type']=='image/gif'){
                    imagegif($lienzo,$nombre);
                }
            }
        }
        // Si es un video permitido
        elseif ($docext=="mp4" or $docext=="mov" or $docext=="avi") {
            if($pict['size']<100741824){ // Máx 97MB
                $nombre = $rut.'/'."Vid_".$nomimg."_".$pre.".".$docext;
                move_uploaded_file($pict['tmp_name'], $nombre);
            }else{
                echo "<script>alert('Los archivos de video debe tener un peso maximo de 97Mb');</script>";
            }	
        }
        // Si es un archivo de Excel
        elseif ($docext=="xls" or $docext=="xlsx") {
            if($pict['size']<1048576){ // Máx 1MB
                $nombre = $rut.'/'."fic_".$nomimg."_".$pre.".".$docext;
                move_uploaded_file($pict['tmp_name'], $nombre);
            }else{
                echo "<script>alert('Los archivos de Excel debe tener un peso maximo de 97Mb');</script>";
            }	
        }
        else{
            // Si la extensión no es permitida
            echo "<script>alert('Solo se permiten archivos de extensiones: png, jpg, jpeg, mp4, mov, avi.');</script>";
        }
    }
    return $nombre; // Retorna la ruta final del archivo
}

// Manejo de mensajes de error de MySQL según el código
function ManejoError($e){
    if(strpos($e->getMessage(),'1451')){
        echo '<script>err("No se puede eliminar este registro. Por que se encuentra relacionado en otra opción.");</script>';
    }elseif(strpos($e->getMessage(),'1062')){
        echo '<script>err("Registro duplicado. Intente nuevamente con otro número de identificación ó comuníquese con el administrador del sistema.");</script>';
    }else{
        echo '<script>err("Se generó un error comuníquese con el administrador del sistema.");</script>';
    }
}

// Convierte un arreglo de datos en una cadena de IDs separados por coma
function arrstr($dt){
    $txt = "";
    if($dt){ 
        foreach ($dt as $d) {
            $txt .= $d['idpag'].","; 
        }
    }
    return $txt;
}

// Funciones para generar títulos con botones para mostrar/ocultar contenido
function titulo($tx="Sin titulo"){ ... }
function titulo2($tx="Sin titulo",$mos=1){ ... }
function titulo3($tx="Sin titulo"){ ... }

// Genera un botón de ayuda con un enlace a una página de soporte
function ayuda($pg){ ... }

// Función para registrar visitas obteniendo la IP y país del usuario
function txtVisita(){ ... }

// Obtiene la IP del cliente verificando múltiples encabezados
function get_client_ip() { ... }

// Obtiene información geográfica de la IP desde geoplugin.net
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) { ... }

// Genera una tabla HTML que simula una firma digital
function firdig($nomusu, $idasi, $fec, $tip){ ... }
?>