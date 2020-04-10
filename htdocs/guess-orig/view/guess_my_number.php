
<h1>Gissa mitt nummer!</h1>
<p>Gissa på ett nummer mellan 1 till 100, du har <?= $object->tries() ?> kvar</p>
<form method="post">
    <input type="text" name="guess" class="text">
    <input type="hidden" name="number" value="<?= $object->number() ?>">
    <input type="hidden" name="tries" value="<?= $object->tries() ?>">
    <input type="submit" name="btnGuess" class="guess" value="Gissa">
    <input type="submit" name="btnInit" value="Starta om">
    <input type="submit" name="btnCheat" value="Fuska" class="fusk">
</form>

<?php if ($btnGuess) : ?>
<p>Du gissning på <?= $guess ?> är <b><?= $res ?></b></p>

<?php endif; ?>


<?php if ($btnCheat) : ?>
<p>FUSK: Det rätta numret är <?= $object->number() ?></p>

<?php endif; ?>

<pre>
