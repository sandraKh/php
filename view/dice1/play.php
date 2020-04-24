<?php

namespace Anax\View;

?>

<h1>Spela tärningspel 100 v.2</h1>

<form method="post">

    <input type="submit" name="btnthrow" value="Kasta Tärningar" class="submit">
    <input type="submit" name="btnsave" value="Spara värden" class="submit">
    <input type="submit" name="btnInit" value="Starta om">

</form>

<?php if ($throw) :
    foreach ($throw as $key => $value) {
        ?>
        <p class="dice-utf8">
            <i class= "dice-<?=$value ?>"></i>
        </p>
        <?php
    }
endif;

if ($next != false) {
    ?>
    <p>Datorns tur... Datorn slog <?= $computercurr ?></p>
    <p>Din tur att slå</p>
    <?php
}
?>
<p>Summan för detta kastet är: <?= $sum ?></p>
<p>Totala summan: <?= $totalsum ?></p>
<?php
if ($savedsum >= 100) {
    ?>
    <p>Spelare vann!!!</p>
    <style>
    .submit {
        display: none;
    }
    </style>
    <?php
}
if ($computer >= 100) {
    ?>
    <p>Datorn vann!!!</p>
    <style>
    .submit {
        display: none;
    }
    </style>
    <?php
}
?>
<p>Resultat spelare: </p>
<p><?= $savedsum ?></p>
<p>Resultat dator:</p>
<p><?= $computer ?></p>

<p>Histogram För Spelare:</p>

<?php
if ($histogram != null) {
    for ($i = 0; $i < count($histogram); $i++) {
        ?><p>Tärning: <?= $i + 1 ?> . <?= $histogram[$i] ?></p>
        <?php
    }
}
?>
<p>Histogram För Dator:</p>
<?php
if ($histogramcomp != null) {
    for ($i = 0; $i < count($histogramcomp); $i++) {
        ?><p>Tärning: <?= $i + 1 ?> . <?= $histogramcomp[$i] ?></p>
        <?php
    }
}
