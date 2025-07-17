<?php
require_once("models/mhdt.php");

$mhdt = new Mhdt();






$datPr = $mhdt->getAllPro();
$datEm = $mhdt->getAllEmp();
$datPe = $mhdt->getAllVal(2);
$datJo = $mhdt->getAllVal(1);
$datFi = $mhdt->getAllFic();
$datAll = $mhdt->getAll();
?>