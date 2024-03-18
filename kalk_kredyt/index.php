<?php
require_once dirname(__FILE__).'/config.php'; /*_once ważne żebyna pewno definiować raz bo inaczej błąd. Jak wpiszemy pare razy z _once to nie wyskoczy błąd*/

//przekierowanie przeglądarki klienta (redirect)
//header("Location: "._APP_URL."/app/calc_view.php");

//przekazanie żądania do następnego dokumentu ("forward")
include _ROOT_PATH.'/app/calc_view.php'; //tu też mogłoby byc _once ale nie wpiujemy tego 2 razy to kalkulator, calk przekazuje na widok kalkulatora