<?php

namespace Anax\View;

/**
* Render content within an article.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>

<h1>Gissa mitt nummer!</h1>
<p>Gissa på ett nummer mellan 1 till 100, du har <?= $tries ?> kvar</p>

<form method="post">

    <input type="text" name="guess" class="text">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="btnGuess" class="guess" value="Gissa">
    <input type="submit" name="btnInit" value="Starta om">
    <input type="submit" name="btnCheat" value="Fuska" class="fusk">
</form>

<p><?= $number ?></p>

<?php if ($res) : ?>
    <p>Du gissning på <?= $guess ?> är <b><?= $res ?></b></p>
    <?php
    if ($res == "Rätt gissat!") {
        ?><p>Tryck starta om för att starta nytt spel</p>
        <style>
        .guess {
            display: none;
        }
        .fusk {
            display: none;
        }
        .text {
            display: none;
        }
        </style>
        <?php
    }

    if ($tries == 0) {
        ?><p>Slut på gissningar. <br> Tryck starta om för att starta nytt spel</p>
        <style>
        .guess {
            display: none;
        }
        .fusk {
            display: none;
        }
        .text {
            display: none;
        }
        </style>
        <?php
    }
    ?>

<?php endif; ?>


<?php if ($cheat) : ?>
    <p>FUSK: Det rätta numret är <?= $cheat ?></p>

<?php endif; ?>

<pre>
