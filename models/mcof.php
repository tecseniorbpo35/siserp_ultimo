<?php
class Mcof { // Clase que maneja la configuración del sistema (probablemente logo, título y footer)
    
    // Atributos privados
    private $idcof;   // ID de la configuración
    private $titcof;  // Título de la configuración
    private $logcof;  // Logo de la configuración
    private $foocof;  // Footer de la configuración


    // MÉTODOS GET (obtener valores)

    public function getIdcof() {
        return $this->idcof;
    }
    public function getTitcof() {
        return $this->titcof;
    }
    public function getLogcof() {
        return $this->logcof;
    }
    public function getFoocof() {
        return $this->foocof;
    }

    // MÉTODOS SET (asignar valores)

    public function setIdcof($idcof) {
        $this->idcof = $idcof;
    }
    public function setTitcof($titcof) {
        $this->titcof = $titcof;
    }
    public function setLogcof($logcof) {
        $this->logcof = $logcof;
    }
    public function setFoocof($foocof) {
        $this->foocof = $foocof;
    }


    // Obtiene todos los registros (aún no implementado)

    public function getAll() {
        $modelo = new conexion(); // Crea la conexión, pero no ejecuta nada
    }


    // Obtiene un registro específico según el idcof

    public function getOne() {
        $sql = "SELECT idcof,titcof,logcof,foocof FROM configuracion WHERE idcof=:idcof"; 
        $modelo = new conexion(); // Crea un objeto de conexión
        $conexion = $modelo->get_conexion(); // Obtiene la conexión PDO
        $result = $conexion->prepare($sql); // Prepara la consulta

        $idcof = $this->getIdcof(); // Obtiene el idcof del objeto actual
        $result->bindparam(":idcof", $idcof); // Asigna el parámetro a la consulta
        $result->execute(); // Ejecuta la consulta
        $res = $result->fetchall(PDO::FETCH_ASSOC); // Obtiene todos los resultados como array asociativo

        return $res; // Retorna los datos encontrados
    }

    // Edita (actualiza) un registro en la tabla configuracion

    function edit() {
        try {
            $sql = "UPDATE configuracion SET ";
            
            //  Problema: $logcof no está definido aquí, debería ser $this->logcof
            if ($logcof) {
                $sql .= "logcof=:logcof,";
            }

            $sql .= "titcof=:titcof,foocof=:foocof WHERE idcof=:idcof";

            $modelo = new conexion(); // Crea el objeto conexión
            $conexion = $modelo->get_conexion(); // Obtiene la conexión
            $result = $conexion->prepare($sql); // Prepara la consulta

            $idcof = $this->getIdcof(); // Obtiene el ID actual
            $result->bindParam(":idcof", $idcof);

            if ($logcof) { //  Aquí también debería ser $this->getLogcof()
                $logcof = $this->getLogcof();
                $result->bindParam(":logcof", $logcof);
            }

            $titcof = $this->getTitcof(); // Obtiene el título
            $result->bindParam(":titcof", $titcof);

            $foocof = $this->getFoocof(); // Obtiene el footer
            $result->bindParam(":foocof", $foocof);

            $result->execute(); // Ejecuta la actualización
            $res = $result->fetchall(PDO::FETCH_ASSOC); //  fetchAll() no tiene sentido en UPDATE, debería omitirse
        } catch (Exception $e) {
            ManejoError($e); // Llama a una función externa para manejar el error
        }
        return $res; // Devuelve el resultado (aunque UPDATE no devuelve datos)
    }
}
