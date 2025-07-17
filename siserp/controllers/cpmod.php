<?php 
require_once 'models/mmod.php';

$mmod = new mmod();

$_SESSION["idper"] = NULL;
$_SESSION["pefnom"] = "Módulos";

$idmod = isset($_POST["idmod"]) ? $_POST["idmod"]:NULL;
$idper = isset($_POST["idper"]) ? $_POST["idper"]:NULL;
$nomper = isset($_POST["nomper"]) ? $_POST["nomper"]:NULL;
$pg = isset($_POST["pg"]) ? $_POST["pg"]:NULL;
$ope = isset($_REQUEST["ope"]) ? $_REQUEST["ope"]:NULL;

if($ope=="dircc"){
	$_SESSION["idper"] = $idper;
	$_SESSION["pefnom"] = $nomper;
	echo '<script>window.location=\'home.php?pg='.$pg.'\';</script>';
}


$datAll = $mmod->getAllAct();
$mmod->setIdusu($_SESSION["idusu"]);
if($datAll){
	foreach ($datAll as $dtm) {
		$mmod->setIdmod($dtm['idmod']);
		$doUP = $mmod->getOneUsuPef();
		if($doUP AND $doUP[0]['can']==0){
			if($mmod->getIdmod()==1){ $mmod->setIdper(4); $mmod->insUsuPef(); }
			if($mmod->getIdmod()==2){ $mmod->setIdper(8); $mmod->insUsuPef(); }
			//if($mmod->getIdmod()==3){ $mmod->setIdper(17); $mmod->insUsuPef(); }
			if($mmod->getIdmod()==4){ $mmod->setIdper(5); $mmod->insUsuPef(); }
		}
	}
}

$datMd = $mmod->getAllMod();
$datMod = limVec($datMd);


function limVec($vec){
	$dat = array("oo");
	if($vec){ foreach ($vec as $dt) {
		$dat[] = $dt["idmod"];
	}}
	return $dat;
}
?>