<?php
class Musu{

	private $idusu;
	private $ndocusu;
	private $nomusu;
	private $idper;
	private $pasusu;
	private $emausu;
	private $actusu;
	private $telcan;
	private $idfic;
	private $finc;
	private $idval;
	private $inic;

	// METODOS GET-------------------------

	public function getIdusu(){
		return $this->idusu;
	}
	public function getNdocusu(){
		return $this->ndocusu;
	}
	public function getNomusu(){
		return $this->nomusu;
	}
	public function getIdper(){
		return $this->idper;
	}
	public function getPasusu(){
		return $this->pasusu;
	}
	public function getEmausu(){
		return $this->emausu;
	}
	public function getActusu(){
		return $this->actusu;
	}
	public function getTelcan(){
		return $this->telcan;
	}
	public function getIdfic($idfic){
		return $this->$idfic;
	}
	public function getFinc($finc){
		return $this->$finc;
	}
	public function getInic($inic){
		return $this->$inic;
	}

	// Metodos set-----------------------

	public function setIdusu($idusu){
		$this->idusu=$idusu;
	}
	public function setNdocusu($ndocusu){
		$this->ndocusu=$ndocusu;
	}
	public function setNomusu($nomusu){
		$this->nomusu=$nomusu;
	}
	public function setIdper($idper){
		$this->idper=$idper;
	}
	public function setPasusu($pasusu){
		$this->pasusu=$pasusu;
	}
	public function setEmausu($emausu){
		$this->emausu=$emausu;
	}
	public function setActusu($actusu){
		$this->actusu=$actusu;
	}
	public function setTelcan($telcan){
		$this->telcan=$telcan;
	}
	public function setIdfic($idfic){
		$this->idfic=$idfic;
	}
	public function setFinc($finc){
		$this->finc=$finc;
	}
	public function setInic($inic){
		$this->inic=$inic;
	}

	public function getAll($idfic){
		$sql="SELECT u.idusu, u.ndocusu, u.nomusu, u.idper, p.nomper, u.pasusu, u.emausu, u.actusu, u.telcan FROM usuario AS u INNER JOIN perfil AS p ON u.idper=p.idper";
		if($idfic)
			$sql .=" WHERE u.ndocusu='".$idfic."' OR u.nomusu='".$idfic."' OR u.nomusu LIKE '%".$idfic."%'";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function getOne(){
		$sql = "SELECT u.idusu, u.ndocusu, u.nomusu, u.idper, p.nomper, u.pasusu, u.emausu, u.actusu, u.telcan FROM usuario AS u INNER JOIN perfil AS p ON u.idper=p.idper WHERE u.idusu=:idusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu=$this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
//ins($ndocusu, $nomusu, $idper, $idfic, $pasusu, $actusu);
	public function save($dt=1){
		try{
			$sql = "INSERT INTO usuario(idper, ndocusu, nomusu, pasusu, actusu, emausu, telcan) VALUES (:idper, :ndocusu, :nomusu, :pasusu, :actusu, :emausu, :telcan)";
			$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);

			$idper=$this->getIdper();
			$result->bindParam(":idper",$idper);

			$ndocusu=$this->getNdocusu();
			$result->bindParam(":ndocusu",$ndocusu);

			$nomusu=$this->getNomusu();
			$result->bindParam(":nomusu",$nomusu);

			$pasusu=$this->getPasusu();
			$pasusu = sha1(md5($pasusu));
			$result->bindParam(":pasusu",$pasusu);


			$actusu=$this->getActusu();
			$result->bindParam(":actusu",$actusu);

			$emausu=$this->getEmausu();
			$result->bindParam(":emausu",$emausu);

			$telcan=$this->getTelcan();
			$result->bindParam(":telcan",$telcan);

			$result->execute();
		}catch(Exception $e){
			if($dt==1) ManejoError($e);
			echo $e->getMessage();
		}
	}

	public function edi(){
		try{
		$pasusu=$this->getPasusu();
		$sql = "UPDATE usuario SET ndocusu=:ndocusu,nomusu=:nomusu,idper=:idper,";
		if($pasusu) $sql .= "pasusu=:pasusu,";
		$sql .= "actusu=:actusu, emausu=:emausu, telcan=:telcan WHERE idusu=:idusu";
		$modelo = new conexion();
			$conexion = $modelo->get_conexion();
			$result = $conexion->prepare($sql);

			$idusu=$this->getIdusu();
			$result->bindParam(":idusu",$idusu);

			$ndocusu=$this->getNdocusu();
			$result->bindParam(":ndocusu",$ndocusu);

			$nomusu=$this->getNomusu();
			$result->bindParam(":nomusu",$nomusu);

			$idper=$this->getIdper();
			$result->bindParam(":idper",$idper);
			if($pasusu){
				$pasusu = sha1(md5($pasusu));
				$result->bindParam(":pasusu",$pasusu);
			}

			$actusu=$this->getActusu();
			$result->bindParam(":actusu",$actusu);

			$emausu=$this->getEmausu();
			$result->bindParam(":emausu",$emausu);

			$telcan=$this->getTelcan();
			$result->bindParam(":telcan",$telcan);
			
			$result->execute();
		}catch(Exception $e){
            if(strpos($e->getMessage(), '1062'))
                echo '';//'<script>alert("Ficha existente");</script>';
        }
	}

	public function updPasc($ips,$fps){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "UPDATE usuario SET pasusu=sha(md5(concat('$ips',ndocusu,'$fps'))) WHERE idper NOT IN (1)";
		//echo $sql."<br>";
		$result = $conexion->prepare($sql);
		$result->execute();
	}
	public function updPascm($ips,$ndoc,$fps){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "UPDATE usuario SET pasusu=sha(md5(concat('$ips','$ndoc','$fps'))) WHERE idper NOT IN (1)";
		//echo $sql."<br>";
		$result = $conexion->prepare($sql);
		$result->execute();
	}

	public function del(){
		$sql = "DELETE FROM usuario WHERE idusu=:idusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu=$this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$result->execute();
	}

	public function getPerfil(){
		$sql = "SELECT idper, nomper FROM perfil";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function getMod(){
		$sql = "SELECT idmod, nommod, idper FROM modulo";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function getUsPe($idmod, $idusu){
		$sql = "SELECT s.idper FROM usupef AS s INNER JOIN perfil AS p ON s.idper=p.idper WHERE p.idmod=:idmod AND s.idusu=:idusu;";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":idmod",$idmod);
		$result->bindParam(":idusu",$idusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	
	public function getPefus($idmod){
		$sql = "SELECT idper, nomper FROM perfil WHERE idmod=:idmod";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":idmod",$idmod);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function insUxP(){
		$sql = "INSERT INTO usupef(idusu, idper) VALUES (:idusu, :idper)";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu=$this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$idper=$this->getIdper();
		$result->bindParam(":idper",$idper);
		$result->execute();
	}

	public function delUxP(){
		$sql = "DELETE FROM usupef WHERE idusu=:idusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu=$this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$result->execute();
	}

	public function insUxF($idusu, $idfic){
		$sql = "INSERT INTO usufic(idusu, idfic, actfic) VALUES (:idusu, :idfic, 1)";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":idusu",$idusu);
		$result->bindParam(":idfic",$idfic);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
	public function ediUxF(){
		$sql = "UPDATE usufic SET actfic=2 WHERE idusu=:idusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$idusu=$this->getIdusu();
		$result->bindParam(":idusu",$idusu);
		$result->execute();
	}

	public function delUxPF($idusu,$idfic){
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$sql = "DELETE FROM usufic WHERE idusu=:idusu AND idfic=:idfic";
		$result = $conexion->prepare($sql);
		$result->bindParam(":idusu",$idusu);
		$result->bindParam(":idfic",$idfic);
		$result->execute();
	}
	
	public function getFicUsu($idusu){
		$sql = "SELECT f.idfic, f.nomfic, f.jornada, f.mun, u.idusu, u.actfic FROM ficha AS f INNER JOIN usufic AS u ON f.idfic=u.idfic WHERE u.idusu=:idusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":idusu",$idusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function getFicUsuSec($idusu,$idfic){
		$sql = "SELECT f.idfic FROM ficha AS f INNER JOIN usufic AS u ON f.idfic=u.idfic WHERE u.idusu=:idusu AND u.idfic=:idfic";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":idusu",$idusu);
		$result->bindParam(":idfic",$idfic);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
	public function selectUsu(){
		$sql = "SELECT idusu, COUNT(*) as sum FROM usuario WHERE ndocusu=:ndocusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$ndocusu=$this->getNdocusu();
		$result->bindParam(":ndocusu",$ndocusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
	public function getUsu($ndocusu){
		$sql = "SELECT idusu, nomusu, ndocusu FROM usuario WHERE ndocusu=:ndocusu";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(":ndocusu",$ndocusu);
		$result->execute();
		$res=$result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>