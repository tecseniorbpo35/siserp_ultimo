<?php

require_once 'models/musu.php';

$musu = new Musu();
$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu']:NULL;
$ndocusu = isset($_POST['ndocusu']) ? $_POST['ndocusu']:NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu']:NULL;
$idper = isset($_POST['idper']) ? $_POST['idper']:NULL;
$idfic = isset($_REQUEST['idfic']) ? $_REQUEST['idfic']:NULL;
$pasusu = isset($_POST['pasusu']) ? $_POST['pasusu']:NULL;
//$idcen = isset($_POST['idcen']) ? $_POST['idcen']:NULL;
$actusu = isset($_POST['actusu']) ? $_POST['actusu']:NULL;
$emausu = isset($_POST['emausu']) ? $_POST['emausu']:NULL;
$telcan = isset($_POST['telcan']) ? $_POST['telcan']:NULL;
$noca = isset($_POST['noca']) ? $_POST['noca']:NULL;
$fotcan = isset($_POST['fotcan']) ? $_POST['fotcan']:NULL;


$idficfil = isset($_REQUEST['idficfil']) ? $_REQUEST['idficfil']:NULL;
$nodocfil = isset($_REQUEST['nodocfil']) ? $_REQUEST['nodocfil']:80546098;

$foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name']:NULL;

$opera = isset($_REQUEST['opera']) ? $_REQUEST['opera']:NULL;
if($foto){
    $fotcan = opti($_FILES['foto'], $idusu, 'fcan', "");
}

$ips = isset($_POST['inico']) ? $_POST['inico']:NULL;
$fps = isset($_POST['finco']) ? $_POST['finco']:NULL;

$datOne = NULL;

if($pg<>1324){
	$pg = 1113;
}else{
	$idusu = $_SESSION["idusu"];
}


//echo $idusu."-".$ndocusu."-".$nomusu."-".$idper."-".$idfic."-".$pasusu."-".$idcen."-".$actusu."-".$opera;

$musu->setIdusu($idusu);
//Insertar
if($opera=="save"){
	$musu->setNdocusu($ndocusu);
	$musu->setNomusu($nomusu);
	$musu->setIdper($idper);
	$musu->setPasusu($pasusu);
	$musu->setEmausu($emausu);
	//$musu->setIdcen($idcen);
	$musu->setActusu($actusu);
	$musu->setFotcan($fotcan);
	$musu->setTelcan($telcan);
	$musu->setNoca($noca);
	if(!$idusu){
		$musu->save();
	}else{
		$musu->edi();
	}
	
}
//Actualizar
if($opera=="edit"){
	$datOne=$musu->getOne();
}
if($opera=="CamCon"){
	if($ips AND $fps){
		// $apr = $musu->selApren();
		// foreach ($apr as $ap) {
		// 	$pas = $ips.$ap['ndocusu'].$fps;
		// 	//echo $pas."<br>";
			$musu->updPasc($ips,$fps);
		// }
	}
	$idusu="";
}
//Actualizacion
if($opera=="InUP"){
    // se elimina los perfiles secundarios antes de todo
    if($idusu) $musu->delUxP();
    
    // solo se asignan nuevos perfiles si se ajusta
    if($idper) {
        foreach($idper AS $idx){
            if($idx){
                $musu->setIdper($idx);
                $musu->insUxP();
            }
        }
    }
    // se actualiza el perfil principal si es diferente
    $perfilPrincipal = isset($_POST['perfil_principal']) ? $_POST['perfil_principal'] : null;
    if($perfilPrincipal) {
        $musu->setIdper($perfilPrincipal);
        $musu->edi(); // se actualiza el perfil principal en la tabla usuario
    }
}

if($opera=="InUF"){
	if($idfic AND $idusu){
		$musu->ediUxF();
		$dtuxf = $musu->getFicUsuSec($idusu,$idfic);
		if(!$dtuxf) $musu->insUxF($idusu, $idfic);
	}
}
//Eliminar
if($opera=="Eliminar"&& $idusu)$musu->del();

if($opera=="duxf"){
	if($idfic AND $idusu) $musu->delUxPF($idusu,$idfic);
}

//mostrar todos los datos
$dat = NULL;
if($idficfil) $dat = $musu->getAll($idficfil);
if($nodocfil) $dat = $musu->getAll($nodocfil);
$dpe = $musu->getPerfil();
if($idusu){
	$datOne = $musu->getOne();
}


function modmulsel($id, $nom,$pg){
	$musu = new musu();
	$datmd = $musu->getMod();
	
	$html = '';
	$html .= '<div class="modal" id="muxp'.$id.'" tabindex="-1" role="dialog">';
		$html .= '<div class="modal-dialog">';
			$html .= '<form action="home.php?pg='.$pg.'" method="POST">';
				$html .= '<div class="modal-content">';
					$html .= '<div class="modal-header">';
						$html .= '<h3>Perfiles de Usuario</h3>';
						$html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
					$html .= '</div>';
					$html .= '<div class="modal-body">';
						$html .= '<h5>Usuario: '.$nom.'</h5>';
						$html .= '<div class="row">';
						//
							if($datmd){ foreach($datmd AS $dmd){
								$datpu = $musu->getPefus($dmd['idmod']);//por cada modulo se obtiene los perfiles que estan activos  
								$datup = $musu->getUsPe($dmd['idmod'],$id);// por cada modulo obtiene el perfil actual del usuario
								$html .= '<div class="form-group col-md-6">';
									$html .= '<label for="idper">'.$dmd['nommod'].'</label>';
									$html .= '<select name="idper[]" id="idper" class="form-select">';
										$html .= '<option value="0">Sin perfil</option>';
										if($datpu){ foreach($datpu AS $dp){
											$html .= '<option value="'.$dp['idper'].'" ';
											if(($datup AND $datup[0]['idper']==$dp['idper'])) $html .= 'selected';
											$html .= '>'.$dp['nomper'].'</option>';
										}}
									$html .= '</select>';
								$html .= '</div>';
							}}
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<div class="modal-footer">';
						$html .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
						$html .= '<input type="submit" class="btn btn-primary" value="Guardar">';
						$html .= '<input type="hidden" name="idusu" value="'.$id.'">';
						$html .= '<input type="hidden" name="opera" value="InUP">';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</form>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}

?>