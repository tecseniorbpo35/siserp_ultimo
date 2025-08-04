<?php
class Mmod{
	private $idmod;
	private $nommod;
	private $imgmod;
	private $actmod;
	private $desmod;
	private $idper;

	private $idusu;

 	public function getIdmod(){
 		return $this->idmod;
 	}
 	public function getNommod(){
 		return $this->nommod;
 	}
	public function getImgmod(){
 		return $this->imgmod;
 	}
	public function getActmod(){
 		return $this->actmod;
 	}
	public function getDesmod(){
 		return $this->desmod;
 	}
 	public function getIdper(){
 		return $this->idper; 
 	}

 	public function getIdusu(){
 		return $this->idusu; 
 	}
   //Métodos Set 
 	public function setIdmod($idmod){
 		$this->idmod = $idmod;
 	}
 	public function setNommod($nommod){
 		$this->nommod = $nommod;
 	}
	public function setImgmod($imgmod){
 		$this->imgmod = $imgmod;
 	}
	public function setActmod($actmod){
 		$this->actmod = $actmod;
 	}
	public function setDesmod($desmod){
 		$this->desmod = $desmod;
 	}
 	public function setIdper($idper){
 		$this->idper = $idper;
 	}

 	public function setIdusu($idusu){
 		$this->idusu = $idusu; 
 	}

 	public function getAll(){
 		$sql = "SELECT m.idmod, m.idper, m.nommod, m.imgmod, m.actmod, m.desmod, p.nomper FROM modulo AS m LEFT JOIN perfil AS p ON m.idper=p.idper";
 		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
 	}

 	public function getAllMod(){
 		$sql = "SELECT p.idmod FROM usupef AS up INNER JOIN perfil AS p ON up.idper=p.idper WHERE up.idusu=:idusu";
 		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
 		$idusu = $this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
 	}

 	public function getAllModUsu(){
 		$sql = "SELECT p.idper, p.nomper, p.idpag FROM usupef AS up INNER JOIN perfil AS p ON up.idper=p.idper WHERE up.idusu=:idusu AND p.idmod=:idmod";
 		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
 		$idusu = $this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$idmod = $this->getIdmod();
		$result->bindParam(":idmod",$idmod);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
 	}

	public function getAllPer(){
		$sql = "SELECT p.idmod, p.idper, p.nomper, p.idpag FROM usupef AS up INNER JOIN perfil AS p ON up.idper=p.idper WHERE up.idusu=:idusu AND up.idper=:idper";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu = $this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$idper = $this->getIdper();
		$result->bindParam(":idper",$idper);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

 	public function getAllAct(){
 		$sql = "SELECT m.idmod, m.idper, m.nommod, m.imgmod, m.actmod, m.desmod, p.nomper, p.idpag FROM modulo AS m LEFT JOIN perfil AS p ON m.idper=p.idper WHERE m.actmod=1";
 		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
 	}

	public function getOne(){
		$sql = "SELECT m.idmod, m.idper, m.nommod, m.imgmod, m.actmod, m.desmod, p.nomper FROM modulo AS m LEFT JOIN perfil AS p ON m.idper=p.idper WHERE m.idmod=:idmod";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idmod = $this->getIdmod();
		$result->bindParam(':idmod',$idmod);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

 	public function ins(){
		try{
			$sql = "INSERT INTO modulo(nommod, imgmod, actmod, desmod, idper) VALUES (:nommod, :imgmod, :actmod, :desmod, :idper)";
	 		$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$nommod = $this->getNommod();
	 		$result->bindParam(":nommod",$nommod);
			$imgmod = $this->getImgmod();
	 		$result->bindParam(":imgmod",$imgmod);
			$actmod = $this->getActmod();
	 		$result->bindParam(":actmod",$actmod);
			$idper = $this->getIdper();
	 		$result->bindParam(":idper",$idper);
	 		$result->execute();
		}catch(Exception $e){
			ManejoError($e);
		}
	}


	public function getOneUsuPef(){
		$sql = "SELECT COUNT(u.idusu) As can FROM usupef AS u INNER JOIN perfil AS p ON u.idper=p.idper WHERE u.idusu=:idusu AND p.idmod=:idmod";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu = $this->getIdusu();
 		$result->bindParam(":idusu",$idusu);
		$idmod = $this->getIdmod();
 		$result->bindParam(":idmod",$idmod);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
	public function insUsuPef(){
		try{
			$sql = "INSERT INTO usupef(idusu, idper) VALUES (:idusu, :idper)";
	 		$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idusu = $this->getIdusu();
	 		$result->bindParam(":idusu",$idusu);
			$idper = $this->getIdper();
	 		$result->bindParam(":idper",$idper);
	 		$result->execute();
		}catch(Exception $e){
			ManejoError($e);
		}
	}

 	public function upd(){
		try{
	 		$sql = "UPDATE modulo SET nommod=:nommod, imgmod=:imgmod, actmod=:actmod, desmod=:desmod, idper=:idper WHERE idmod=:idmod";
	 		$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idmod = $this->getIdmod();
	 		$result->bindParam(":idmod",$idmod);
			$nommod = $this->getNommod();
	 		$result->bindParam(":nommod",$nommod);
			$imgmod = $this->getImgmod();
	 		$result->bindParam(":imgmod",$imgmod);
			$actmod = $this->getActmod();
	 		$result->bindParam(":actmod",$actmod);
			$desmod = $this->getDesmod();
	 		$result->bindParam(":desmod",$desmod);
			$idper = $this->getIdper();
	 		$result->bindParam(":idper",$idper);
	 		$result->execute();
		}catch(Exception $e){
			ManejoError($e);
		}
	}

 	public function editAct(){
		try{
	 		$sql = "UPDATE modulo SET actmod=:actmod WHERE idmod=:idmod"; 
	 		$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idmod = $this->getIdmod();
	 		$result->bindParam(":idmod",$idmod);
			$actmod = $this->getActmod();
	 		$result->bindParam(":actmod",$actmod);
	 		$result->execute();
		}catch(Exception $e){
			ManejoError($e);
		}
	}

 	public function getPerfil(){
 		$sql = "SELECT idper, nomper, idmod FROM perfil";
 		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
 	}

 	public function del(){
		try{
	        $sql ="DELETE FROM modulo WHERE idmod=:idmod";
	        $modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);
			$idmod = $this->getIdmod();
	        $result->bindParam(":idmod",$idmod);
	        $result->execute();
		}catch(Exception $e){
			ManejoError ($e);
	    }
	}

    public function getDom(){
        $sql ="SELECT iddom, nommod FROM dominio";
        $modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
    }

	function getMxp($idmod){
        $res = null;
        $modelo = new conexion();
        $sql = "SELECT COUNT(idmod) AS can FROM pagina WHERE idmod=:idmod";
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(':idmod',$idmod);
        $result->execute();
        $res = $result-> fetchall(PDO::FETCH_ASSOC);
        return $res;
    }
}
?>