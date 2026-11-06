<html>
<head>

	<style>
        body {
            background-color: rgb(100,70,70);
        }
		form {
            color: white;
			padding: 25px;
		}
		input {
			width: 50px;
		}
	</style>

</head>
<body>

<?php

$items = array(
	array('name'=>'Pasta','desc'=>"E' pasta dai",'price'=>1.00),
	array('name'=>'Pane','desc'=>"Pane fresco",'price'=>1.50),
	array('name'=>'Latte','desc'=>"Latte intero",'price'=>1.20),
	array('name'=>'Caffè','desc'=>"Moka 250g",'price'=>2.50),
	array('name'=>'Acqua','desc'=>"Naturale 1.5L",'price'=>0.40),
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$total = 0;
	echo "<h2>SCONTRINO</h2>";

	for ($i=0; $i<count($items); $i++) {
		$qnt = isset($_POST['qnt'][$i]) ? intval($_POST['qnt'][$i]) : 0;

		if ($qnt > 0) {
			$subtotal = $items[$i]['price'] * $qnt;
			$total += $subtotal;
			echo "<br>".$items[$i]['name']." x ".$qnt." = ".$subtotal."€";
		}
	}

	echo "<br><hr><b>TOTALE: ".$total."€</b>";
	echo "<br><br><a href='".$_SERVER['PHP_SELF']."'>Nuova spesa</a>";

} else {
	echo "<form method='POST' action='".$_SERVER['PHP_SELF']."'>";
	for ($i=0;$i<count($items);$i++) {
		if (isset($items[$i])) {
			echo "<br>Elemento: ".$items[$i]['name'];
			echo "<br>Descrizione: ".$items[$i]['desc'];
			echo "<br>Prezzo: ".$items[$i]['price']."€";
			echo "<br><input name='qnt[".$i."]' type='number' value='0' min='0'>";
			echo "<br>";
		}
	}
	echo "<br><input type='submit' value='Calcola'>";
	echo "</form>";
}

?>

</body>
</html>
