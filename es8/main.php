<?php
$prezzo_menu = 25.00;

$antipasti = [
    "Bruschette al pomodoro",
    "Caprese",
    "Prosciutto e melone"
];

$primi = [
    "Pasta al pesto",
    "Lasagne al forno",
    "Penne al pomodoro"
];

$secondi = [
    "Cotoletta con patate",
    "Pollo arrosto",
    "Orata al forno"
];

$extra = [
    "Acqua" => 2.00,
    "Coca Cola" => 2.50,
    "Vino" => 4.00,
    "Caffe" => 1.50
];

$totale = $prezzo_menu;
$aggiunte = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $antipasto = $_POST['antipasto'] ?? '';
    $primo = $_POST['primo'] ?? '';
    $secondo = $_POST['secondo'] ?? '';

    foreach ($_POST['extra'] ?? [] as $scelta) {
        if (isset($extra[$scelta])) {
            $aggiunte[$scelta] = $extra[$scelta];
            $totale += $extra[$scelta];
        }
    }

    $inviato = true;
}
?>

<html>
<body>

<h2>Menu fisso (€ 25,00)</h2>

<form method="post">

<h3>Antipasti</h3>
<?php foreach ($antipasti as $piatto): ?>
    <input type="radio" name="antipasto" value="<?php echo $piatto; ?>" required>
    <?php echo $piatto; ?><br>
<?php endforeach; ?>

<h3>Primi</h3>
<?php foreach ($primi as $piatto): ?>
    <input type="radio" name="primo" value="<?php echo $piatto; ?>" required>
    <?php echo $piatto; ?><br>
<?php endforeach; ?>

<h3>Secondi</h3>
<?php foreach ($secondi as $piatto): ?>
    <input type="radio" name="secondo" value="<?php echo $piatto; ?>" required>
    <?php echo $piatto; ?><br>
<?php endforeach; ?>

<h3>Extra</h3>
<?php foreach ($extra as $nome => $prezzo): ?>
    <input type="checkbox" name="extra[]" value="<?php echo $nome; ?>">
    <?php echo $nome . " (+ € " . number_format($prezzo, 2, ',', '.') . ")"; ?><br>
<?php endforeach; ?>

<br>
<button type="submit">Calcola totale</button>

</form>

<?php if (isset($inviato)): ?>

<hr>
<h2>Riepilogo ordine</h2>

<p>Antipasto: <?php echo htmlspecialchars($antipasto); ?></p>
<p>Primo: <?php echo htmlspecialchars($primo); ?></p>
<p>Secondo: <?php echo htmlspecialchars($secondo); ?></p>

<h3>Extra selezionati</h3>

<?php foreach ($aggiunte as $nome => $prezzo): ?>
    <p><?php echo htmlspecialchars($nome); ?>: 
    € <?php echo number_format($prezzo, 2, ',', '.'); ?></p>
<?php endforeach; ?>

<h3>Totale: € <?php echo number_format($totale, 2, ',', '.'); ?></h3>

<?php endif; ?>

</body>
</html>
