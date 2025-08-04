<?php
// Definición de la clase Mmenu
class Mmenu {
    // Atributos privados
    private $idpag; // ID de la página
    private $idper; // ID del perfil

    // Métodos GET: devuelven los valores de los atributos
    function getIdpag() {
        return $this->idpag;
    }

    function getIdper() {
        return $this->idper;
    }

    // Métodos SET: asignan valores a los atributos
    function setIdper($idper) {
        $this->idper = $idper;
    }

    function setIdpag($idpag) {
        $this->idpag = $idpag;
    }

    // Método que obtiene el menú según el perfil (idper)
    public function getMen() {
        // Consulta SQL que trae las páginas visibles (mospas = 1) asignadas al perfil
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.icopag 
                FROM pagina AS p 
                INNER JOIN pagper AS j ON p.idpag = j.idpag 
                WHERE p.mospas = 1 AND j.idper = :idper 
                ORDER BY p.ordpag;";
        
        // Se crea una nueva conexión a la base de datos
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();

        // Preparación y ejecución de la consulta
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper(); // Obtiene el ID del perfil
        $result->bindParam(':idper', $idper); // Enlaza el parámetro idper
        $result->execute();

        // Se obtienen todos los resultados en formato asociativo
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res; // Se devuelve el resultado
    }

    // Método que obtiene los datos de una página específica según el perfil
    public function getVal() {
        // Consulta SQL que trae información de una página específica (por idpag y idper)
        $sql = "SELECT p.idpag, p.nompag, p.rutpag, p.icopag, p.mospas 
                FROM pagina AS p 
                INNER JOIN pagper AS g ON p.idpag = g.idpag 
                WHERE p.idpag = :idpag AND g.idper = :idper";
        
        // Se crea una nueva conexión a la base de datos
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();

        // Preparación y ejecución de la consulta
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper(); // Obtiene el ID del perfil
        $idpag = $this->getIdpag(); // Obtiene el ID de la página
        $result->bindParam(':idper', $idper); // Enlaza el parámetro idper
        $result->bindParam(':idpag', $idpag); // Enlaza el parámetro idpag
        $result->execute();

        // Se obtienen todos los resultados en formato asociativo
        $res = $result->fetchAll(PDO::FETCH_ASSOC);
        return $res; // Se devuelve el resultado
    }
}
?>
