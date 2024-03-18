<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.
include _ROOT_PATH.'/app/security/check.php';
// 1. pobranie parametrów
function getParams(&$x,&$y,&$z){
	$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;
}
// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
function validate(&$x,&$y,&$z,&$messages){
if ( ! (isset($x) && isset($y) && isset($z))) {
	return false;
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $x == "") {
	$messages [] = 'Nie podano kwoty';
}
if ( $y == "") {
	$messages [] = 'Nie podano ilości lat';
}
if ( $z == "") {
	$messages [] = 'Nie podano oprocentowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (count ( $messages ) != 0) return false; 
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
if (! is_numeric( $x )) {
	$messages [] = 'Kwota nie jest liczbą całkowitą';
}

if (! is_numeric( $y )) {
	$messages [] = 'Ilość lat nie jest liczbą całkowitą';
}
if (! is_numeric( $z )) {
	$messages [] = 'Oprocentowanie nie jest liczbą całkowitą';
}
	
if (count ( $messages ) != 0) return false;
	else return true;
}

// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$x,&$y,&$z,&$messages,&$result){
	global $role;
	
	//konwersja parametrów 
	$x = floatval($x);
	$y = floatval($y);
	$z = floatval($z);
	if ($z>10){
		if ($role == 'admin'){
				$oprocentowanie = $z/100;
				$kwotaop = ($x*$oprocentowanie);
				$cala_kwota = $kwotaop + $x;
				$miesiace = $y*12;
				$result = ($cala_kwota/$miesiace);
		} else {
			$messages [] = 'Tylko administrator może liczyc wysokie oprocentowanie !';
		}
				
		} else {
			$oprocentowanie = $z/100;
			$kwotaop = ($x*$oprocentowanie);
			$cala_kwota = $kwotaop + $x;
			$miesiace = $y*12;
			$result = ($cala_kwota/$miesiace);
		}
}
$x = null;
$y = null;
$z = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($x,$y,$z);
if ( validate($x,$y,$z,$messages) ) { // gdy brak błędów
	process($x,$y,$z,$messages,$result);
}

include 'calc_view.php';
