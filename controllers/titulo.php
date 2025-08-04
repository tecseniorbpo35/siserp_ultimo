<?php
// Función que genera un bloque de título principal con un ícono y (opcionalmente) botones
function tit($ti, $ic, $arc, $pg, $alto, $tipo = 1) {
    $txt = ''; // Variable donde se irá armando el HTML
    $txt .= '<div class="err"></div>'; // Contenedor para mensajes de error (vacío por ahora)
    $txt .= '<div class="tit">'; // Contenedor principal con clase "tit"
        $txt .= '<div class="tita">'; // Subcontenedor para el ícono y el título
            $txt .= '<i class="'.$ic.'"></i>'; // Inserta un ícono usando la clase pasada como parámetro
            $txt .= ''.$ti; // Inserta el texto del título
            $txt .= '<hr class="hrtit">'; // Línea horizontal decorativa
        $txt .= '</div>'; // Cierre de .tita

        /* 
        Bloque comentado que podría definir si el texto del botón será "Nuevo" o "Nueva"
        según el valor de $tipo
        if($tipo==1)
            $tx = 'Nuevo';
        else
            $tx = 'Nueva';
        */

    $txt .= '<div style="text-align: center;">'; // Contenedor centrado para el título principal
        $txt .= '<h2>'.$ti.'</h2>'; // Muestra el título como encabezado <h2>

        /* 
        Bloque comentado que mostraba botones dinámicos:
        - Un botón para mostrar/ocultar un formulario (ocultar())
        - Un botón para cerrar que redirige a otra página

        if(isset($_GET["pg"])){
            if($_GET["pg"]!=290 AND $_GET["pg"]!=291 AND $_GET["pg"]!=212){
                $txt .= '<button id="mos" class="btn btn-dark" onclick="ocultar(1,\''.$alto.'\');" title="'.$tx.' '.$ti.'">';
                    $txt .= '<i class="'.$ic.'" style="color:#fff;"></i>';
                $txt .= '</button>';
            }
            $txt .= '<a href="'.$arc.'?pg='.$pg.'" id="ocu">';
                $txt .= '<input type="button" id="ocu" class="btn-close" title="Cerrar">';
            $txt .= '</a>';
        }
        */
    $txt .= '</div>'; // Cierre del contenedor centrado
    return $txt; // Devuelve el HTML generado
}

// (Bloque comentado) - Función que mostraba mensajes de error personalizados según el código MySQL
/*
function ManejoError($e){
    if(strpos($e->getMessage(),'1115')){
        echo '<script>err("No se puede eliminar este registro. Por que se encuentra relacionado en otra opcion.");</script>';
    } elseif(strpos($e->getMessage(),'1116')){
        echo '<script>err("Registro duplicado. Intente nuevamente con otro numero de identificacion o comuniquese con el administrador del sistema.");</script>';
    } else {
        echo '<script>err("Se genero un error comuniquese con el administrador del sistema.");</script>';
    }
}
*/

// Función que genera un subtítulo con un botón de cierre
function sbtit($ti, $ic, $arc, $pg, $alto, $cdvl, $tipo = 1) {
    $txt = ''; // Variable donde se arma el HTML
    $txt .= '<div>'; // Contenedor principal
        $txt .= '<h2>'.$ti.'</h2>'; // Inserta el subtítulo

        /* 
        Botón comentado que permitiría mostrar/ocultar contenido dinámicamente
        $txt .= '<button id="mos'.$cdvl.'" class="btn btn-dark mos" onclick="ocudt(1,\''.$alto.'\',\''.$cdvl.'\');" title="'.$ti.'">';
            $txt .= '<i class="'.$ic.'"></i>';
        $txt .= '</button>';
        */

        // Botón activo: cierra el contenedor llamando a la función JS ocudt()
        $txt .= '<button id="ocu'.$cdvl.'" class="btn-close ocu" onclick="ocudt(2,\'0px\',\''.$cdvl.'\');" title="Cerrar">';
            // Se podría agregar un ícono dentro, pero está comentado
            //$txt .= '<i class="'.$ic.'"></i>';
        $txt .= '</button>';
    $txt .= '</div>'; // Cierre del contenedor principal
    return $txt; // Devuelve el HTML generado
}
?>
